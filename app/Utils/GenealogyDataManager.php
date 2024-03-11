<?php
namespace App\Utils;

use App\Repositories\BonusRepository;
use App\Repositories\LevelUserPivotRepository;
use App\Repositories\LevelRepository;
use App\Repositories\PersonRepository;
use App\Repositories\RecordingTransactionRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class GenealogyDataManager implements GenealogyDataManagerInterface {
    public $userRepository, $personRepository, $bonusRepository, $levelRepository,
        $recordingTransactionRepository, $levelUserRepository;

    public function __construct(
        UserRepository $userRepository,
        PersonRepository $personRepository,
        BonusRepository $bonusRepository,
        LevelRepository $levelRepository,
        LevelUserPivotRepository $levelUserRepository,
        RecordingTransactionRepository $recordingTransactionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->personRepository = $personRepository;
        $this->bonusRepository = $bonusRepository;
        $this->levelRepository = $levelRepository;
        $this->levelUserRepository = $levelUserRepository;
        $this->recordingTransactionRepository = $recordingTransactionRepository;
    }

    public function isUpgradable($user, &$log_array = null)
    {
        if ($user->person->level_label == config('util.stater_level_label')) {
            if (!is_null($log_array)) {
                $log_array['user_godsons_count'] = count($this->userRepository->getAGenerationGodsonsOfAGodfather($user->id, 1));
            }
            if (
                count($this->userRepository->getAGenerationGodsonsOfAGodfather($user->id, 1)) 
                == config('util.maximum_godsons_of_generation_one')
            ) {
                return true;
            } else {
                return false;
            }
        } else {
            $tree = $this->userRepository->getGodsonsTreeUntilAGenerationOfAGodfather($user->id, 3);            
            if ($this->isCompleteTree($tree, $log_array)) {
                $godsons_candidate = 0;
                foreach ($tree as $godson) {
                    if ($godson->person->level_number >= $user->person->level_number) {
                        $godsons_candidate++;
                    }
                }
                if (!is_null($log_array)) {
                    $log_array['godsons_candidates'] = $godsons_candidate;
                }
                if ($godsons_candidate == config('util.tree_count')) {
                    return true;
                } else {
                    return false;
                }
                
            } else {
                return false;
            }
        }
    }

    public function isCompleteTree($tree, &$log_array = null)
    {
        $generation_one_count = 0;
        $generation_two_count = 0;
        $generation_three_count = 0;
        foreach ($tree as $item) {
            if ($item->generation == 1) {
                $generation_one_count++;
            } else if ($item->generation == 2) {
                $generation_two_count++;
            } else if ($item->generation == 3) {
                $generation_three_count++;
            }
        }

        if (!is_null($log_array)) {
            $log_array['generation_one_count'] = $generation_one_count;
            $log_array['generation_two_count'] = $generation_two_count;
            $log_array['generation_three_count'] = $generation_three_count;
        }

        return $generation_one_count == config('util.maximum_godsons_of_generation_one') &&
               $generation_two_count == config('util.maximum_godsons_of_generation_two') &&
               $generation_three_count == config('util.maximum_godsons_of_generation_three');
    }

    public function browseAllGenalogy()
    {
        $genealogy_logs = [];
        $users = $this->userRepository->getAll();
        foreach ($users as $user) {
            $data = [];
            $data['user'] = $user->pseudo;
            $data['old_level_number'] = $user->person->level_number;
            $data['upgradable'] = $this->isUpgradable($user, $data);
            if ($this->isUpgradable($user, $data)) {
                if ($user->person->level_number < config('util.levels.seven')['number']) {
                    $level = $this->levelRepository->getByField('number', $user->person->level_number + 1);
                    $data['new_level_number'] = $level->number;
                    if ($this->levelUserRepository->isRecordDoesntExists($user->id, $level->id)) {
                        $this->levelUserRepository->store([
                            'user_id' => $user->id,
                            'level_id' => $level->id,
                            'created_at' => Carbon::now()->format('y-m-d H:i:s'),
                            'updated_at' => Carbon::now()->format('y-m-d H:i:s')
                        ]);
                        $this->personRepository->update($user->person->id, [
                            'level_number' => $level->number,
                            'level_label' => $level->label
                        ]);
                    }
                }
            }
            $genealogy_logs = array_merge($genealogy_logs, [$data]);
        }

        return $genealogy_logs;
    }

    public function setBonusesRecords($user)
    {
        $bonuses_logs = [];
        $data = [];
        $data['user'] = $user->pseudo;
        $data['level_number'] = $user->person->level_number;
        $tree = [];
        if ($user->person->level_label == config('util.stater_level_label')) {
            $tree = $this->userRepository->getGodsonsTreeUntilAGenerationOfAGodfather($user->id, 1); 
        } else {
            $tree = $this->userRepository->getGodsonsTreeUntilAGenerationOfAGodfather($user->id, 3);
        }
        
        $data['tree_count'] = count($tree);
        $data['godsons'] = [];
        $i = 0;

        foreach ($tree as $godson) {
            $data['godsons'][$i]['pseudo'] = $godson->pseudo;
            $data['godsons'][$i]['level_number'] = $godson->person->level_number;
            $level = $this->levelRepository->getByField('number', $godson->person->level_number + 1);
            $data['godsons'][$i]['level_concerned_number'] = $level->number;
            if (
                $user->person->level_number <= $godson->person->level_number 
                && 
                $this->bonusRepository->isRecordDoesntExistForThisGodson(
                    $user->id, $godson->id, $level->id
                )
            ) {
                $this->bonusRepository->store([
                    'beneficiary_id' => $user->id,
                    'level_id' => $level->id,
                    'godson_id' => $godson->id,
                    'amount' => $this->getLevelGenerationFieldBonus($level, $godson->generation)
                ]);
                $this->personRepository->updateBalance($user->id);
                $data['godsons'][$i]['level_concerned_amount'] = $this->getLevelGenerationFieldBonus($level, $godson->generation);
            }
            $bonuses_logs = array_merge($bonuses_logs, [$data]);
        }
        return $bonuses_logs;
    }

    public function getLevelGenerationFieldBonus($level, $generation)
    {
        switch ($generation) {
            case 1:
                return $level->generation_one_bonus_amount;
                break;
            case 2:
                return $level->generation_two_bonus_amount;
                break;
            case 3:
                return $level->generation_three_bonus_amount;
                break;
        }
    }

    public function getLevelStatsData()
    {
        return [
            'zero' => $this->personRepository->getCountByWhere([['level_label', 'Etape 0']]),
            'one' => $this->personRepository->getCountByWhere([['level_label', config('util.one.label')]]),
            'two' => $this->personRepository->getCountByWhere([['level_label', config('util.two.label')]]),
            'three' => $this->personRepository->getCountByWhere([['level_label', config('util.three.label')]]),
            'four' => $this->personRepository->getCountByWhere([['level_label', config('util.four.label')]]),
            'five' => $this->personRepository->getCountByWhere([['level_label', config('util.five.label')]]),
            'six' => $this->personRepository->getCountByWhere([['level_label', config('util.six.label')]]),
            'seven' => $this->personRepository->getCountByWhere([['level_label', config('util.seven.label')]]),
        ];
    }

    public function getRecordingStatsData()
    {
        return [
            $this->recordingTransactionRepository->getCountByWhere([['month', 1]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 2]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 3]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 4]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 5]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 6]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 7]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 8]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 9]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 10]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 11]]),
            $this->recordingTransactionRepository->getCountByWhere([['month', 12]]),
        ];
    }
}
