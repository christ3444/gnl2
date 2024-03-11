<?php

use App\Models\RecordingTransaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents("/var/www/globalnovalife-neogenstemcells.com/stuffs/old_platform_data/recording_transactions.json"), true);
        DB::table('recording_transactions')->delete();
        for ($i = 0; $i < count($data); $i++) {
            $payer_id = User::where('pseudo', $data[$i]['payer_pseudo'])->value('id');
            $recorded_id = User::where('pseudo', $data[$i]['recorded_pseudo'])->value('id');
            if(!is_null($payer_id) && !is_null($recorded_id)) {
                RecordingTransaction::create([
                    'payer_id' => $payer_id,
                    'recorded_id' => $recorded_id,
                    'amount' => config('util.recording_transaction_amount'),
                    'month' => $data[$i]['month'],
                    'created_at' => $data[$i]['created_at'],
                    'updated_at' => $data[$i]['updated_at'],
                ]);
            }
        }
    }
}
