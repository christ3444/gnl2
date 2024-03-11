<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(LeadingGroupSeeder::class);
        $this->call(ActionSeeder::class);
        $this->call(RecordingTransactionSeeder::class);
        $this->call(WithdrawalRequestSeeder::class);
        $this->call(CodeTransferSeeder::class);
        $this->call(MarkSeeder::class);
    }
}
