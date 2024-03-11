<?php

use App\Models\Action;
use App\Models\Mark;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_ct = json_decode(file_get_contents("/var/www/globalnovalife-neogenstemcells.com/stuffs/old_platform_data/code_tranfers.json"), true);
        $data_rt = json_decode(file_get_contents("/var/www/globalnovalife-neogenstemcells.com/stuffs/old_platform_data/recording_transactions.json"), true);
        $data_wt = json_decode(file_get_contents("/var/www/globalnovalife-neogenstemcells.com/stuffs/old_platform_data/withdrawal_requests.json"), true);
        DB::table('marks')->delete();
        for ($i = 0; $i < count($data_rt); $i++) {
            $user_id = User::where('pseudo', $data_rt[$i]['payer_pseudo'])->value('id');
            if (!is_null($user_id)) {
                Mark::create([
                    'action_id' => Action::where('code', '#007')->value('id'),
                    'user_id' => $user_id,
                    'description' => $data_rt[$i]['payer_pseudo']. ' a ajouté le filleul ' .$data_rt[$i]['recorded_pseudo'],
                    'created_at' => $data_rt[$i]['created_at'],
                    'updated_at' => $data_rt[$i]['updated_at'],
                ]);
            }
        }

        for ($i = 0; $i < count($data_ct); $i++) {
            $user_id = User::where('pseudo', $data_ct[$i]['sender_pseudo'])->value('id');
            if (!is_null($user_id)) {
                Mark::create([
                    'action_id' => Action::where('code', '#002')->value('id'),
                    'user_id' => User::where('pseudo', $data_ct[$i]['sender_pseudo'])->value('id'),
                    'description' => $data_ct[$i]['sender_pseudo'] . ' a transféré ' . $data_rt[$i]['amount']. ' codes à '. $data_ct[$i]['recever_pseudo'] .' !',
                    'created_at' => $data_ct[$i]['created_at'],
                    'updated_at' => $data_ct[$i]['updated_at'],
                ]);
            }
        }

        for ($i = 0; $i < count($data_wt); $i++) {
            $user_id = User::where('pseudo', $data_wt[$i]['claimant_pseudo'])->value('id');
            if (!is_null($user_id)) {
                Mark::create([
                    'action_id' => Action::where('code', '#008')->value('id'),
                    'user_id' => User::where('pseudo', $data_wt[$i]['claimant_pseudo'])->value('id'),
                    'description' => $data_wt[$i]['claimant_pseudo'] . ' a formulé une demande de retrait !',
                    'created_at' => $data_wt[$i]['created_at'],
                    'updated_at' => $data_wt[$i]['updated_at'],
                ]);
            }
        }
    }
}
