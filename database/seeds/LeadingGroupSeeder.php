<?php

use App\Models\LeadingGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadingGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents("/var/www/globalnovalife-neogenstemcells.com/stuffs/old_platform_data/leading_groups.json"), true);
        DB::table('leading_groups')->delete();
        for ($i = 0; $i < count($data); $i++) {
            LeadingGroup::create($data[$i]);
        }
    }
}
