<?php

use App\Models\Action;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actions')->delete();

        $actions = config('util.mark_actions');

        foreach ($actions as $action) {
            Action::create($action);
        }
    }
}
