<?php

use Illuminate\Database\Seeder;
use App\Settings;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::truncate()->create(
            [
                'key'   => 'aplication_name',
                'value' => 'BOS'
            ]
        );
    }
}
