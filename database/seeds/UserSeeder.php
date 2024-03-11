<?php

use App\Jobs\BrowseGenealogy;
use App\Jobs\SetBonusesRecords;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('people')->delete();

        $this->productionWithOldPlatformDataSeed();
    }

    public function productionWithOldPlatformDataSeed()
    {
        $data = json_decode(file_get_contents("/var/www/globalnovalife-neogenstemcells.com/stuffs/old_platform_data/users_people.json"), true);

        for ($i = 0; $i < count($data); $i++) {
            $user = User::create([
                'pseudo' => $data[$i]['pseudo'],
                'email' => $data[$i]['email'],
                'password' => $data[$i]['password'],
                'role_id' => $data[$i]['role_id'],
                'godfather_id' => is_null($data[$i]['godfather_pseudo']) ? null : User::where('pseudo', $data[$i]['godfather_pseudo'])->value('id'),
                'created_at' => substr($data[$i]['created_at']['date'], 0, 19),
                'updated_at' => substr($data[$i]['updated_at']['date'], 0, 19),
            ]);
            Person::create([
                'first_name' => $data[$i]['first_name'],
                'last_name' => $data[$i]['last_name'],
                'country' => $data[$i]['country'],
                'transaction_password' => $data[$i]['transaction_password'],
                'user_id' => $user->id,
                'created_at' => substr($data[$i]['created_at']['date'], 0, 19),
                'updated_at' => substr($data[$i]['updated_at']['date'], 0, 19)
            ]);
        }
        
        for ($i = 0; $i < 8; $i++) {
            SetBonusesRecords::dispatch(config('util.logs_folder'), 'gnl_b' . ($i + 1), config('util.logs_files_format'));
            BrowseGenealogy::dispatch(config('util.logs_folder'), 'gnl_n' . ($i + 1), config('util.logs_files_format'));
            SetBonusesRecords::dispatch(config('util.logs_folder'), 'gnl_b' . ($i + 1), config('util.logs_files_format'));
        }
    }

    public function generateFakeData()
    {
        $data = array();
        $godfater_id = 0;

        for ($i=0; $i < 31; $i++) {
            if ($i % 2 == 1) {
                $godfater_id++;
            }
            $data = array_merge($data, [
                [
                    'pseudo' => 'Pseudo'. ($i+1),
                    'email' => 'email' . ($i + 1) .'@example.com',
                    'password' => 'password',
                    'role_id' => $i === 0 ? 3: rand(1, 3),
                    'godfather_id' => $i > 0 ? $godfater_id : null,
                    'first_name' => 'John '. ($i + 1),
                    'last_name' => 'Doe',
                    'level_label' => 'Niveau 0',
                    'level_number' => 0,
                    'country' => 'Benin',
                    'transaction_password' => 'transaction',
                    'user_id' => ($i+1)
                ]
            ]);
        }

        return $data;
    }

    public function testingSeed()
    {
        $data = $this->generateFakeData();
        for ($i = 0; $i < count($data); $i++) {
            User::create([
                'pseudo' => $data[$i]['pseudo'],
                'email' => $data[$i]['email'],
                'password' => $data[$i]['password'],
                'role_id' => $data[$i]['role_id'],
                'godfather_id' => $data[$i]['godfather_id']
            ]);
            Person::create([
                'first_name' => $data[$i]['first_name'],
                'last_name' => $data[$i]['last_name'],
                'level_label' => $data[$i]['level_label'],
                'level_number' => $data[$i]['level_number'],
                'country' => $data[$i]['country'],
                'transaction_password' => $data[$i]['transaction_password'],
                'user_id' => $data[$i]['user_id']
            ]);
        }
        for ($i = 0; $i < 8; $i++) {
            SetBonusesRecords::dispatch(config('util.logs_folder'), 'gnl_b' . ($i + 1), config('util.logs_files_format'));
            BrowseGenealogy::dispatch(config('util.logs_folder'), 'gnl_n' . ($i + 1), config('util.logs_files_format'));
            SetBonusesRecords::dispatch(config('util.logs_folder'), 'gnl_b' . ($i + 1), config('util.logs_files_format'));
        }
    }

    public function productionUserSeeder()
    {
        User::create([
            'pseudo' => 'MesGNLGbenAub',
            'email' => 'agbagbe1963@gmail.com',
            'password' => 'password_root&AGNAU91',
            'role_id' => 3
        ]);
        Person::create([
            'first_name' => 'Aubert',
            'last_name' => 'GBENAFA',
            'country' => 'Sénégal',
            'transaction_password' => 'transaction_root&AGNAU91',
            'user_id' => 1
        ]);
    }
}
