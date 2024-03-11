<?php

use App\Models\LeadingGroup;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WithdrawalRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents("/var/www/globalnovalife-neogenstemcells.com/stuffs/old_platform_data/withdrawal_requests.json"), true);
        DB::table('withdrawal_requests')->delete();
        for ($i = 0; $i < count($data); $i++) {
            $claimant_id = User::where('pseudo', $data[$i]['claimant_pseudo'])->value('id');
            if (!is_null($claimant_id)) {
                WithdrawalRequest::create([
                    'claimant_id' => $claimant_id,
                    'leading_group_id' => LeadingGroup::where('name', $data[$i]['leading_group_name'])->value('id'),
                    'amount' => $data[$i]['amount'],
                    'processed' => true,
                    'processed_at' => $data[$i]['processed_at'],
                    'created_at' => $data[$i]['created_at'],
                    'updated_at' => $data[$i]['updated_at'],
                ]);
            }
        }
    }
}
