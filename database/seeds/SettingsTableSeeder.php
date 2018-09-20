<?php

use Illuminate\Database\Seeder;
use App\web\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate()->create(
            [
                'key'   => 'aplication_name',
                'value' => 'BOS'
            ]
        );
    }
}
