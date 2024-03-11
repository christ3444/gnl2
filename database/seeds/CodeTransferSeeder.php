<?php

use App\Models\CodeTransfer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodeTransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents("/var/www/globalnovalife-neogenstemcells.com/stuffs/old_platform_data/code_tranfers.json"), true);
        DB::table('code_transfers')->delete();
        for ($i = 0; $i < count($data); $i++) {
            $sender_id = User::where('pseudo', $data[$i]['sender_pseudo'])->value('id');
            $recever_id = User::where('pseudo', $data[$i]['recever_pseudo'])->value('id');
            if (!is_null($sender_id) && !is_null($recever_id)) {
                CodeTransfer::create([
                    'sender_id' => $sender_id,
                    'recever_id' => $recever_id,
                    'amount' => $data[$i]['amount'],
                    'created_at' => $data[$i]['created_at'],
                    'updated_at' => $data[$i]['updated_at'],
                ]);
            }
        }
    }
}
