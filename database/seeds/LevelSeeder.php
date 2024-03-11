<?php

use Illuminate\Database\Seeder;
use App\Models\Level;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->delete();

        $levels = config('util.levels');

        foreach ($levels as $key => $level) {
            Level::create($level);
        }
    }
}
