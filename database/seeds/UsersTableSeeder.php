<?php

use Illuminate\Database\Seeder;
use App\web\Models\User;
use App\web\Models\User_group;
use App\web\Models\Group_access;
use App\web\Models\Group_member;
use App\web\Models\Log;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group_member::truncate()->create(
            [
                'group_id' => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
                'user_id'  => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91'
            ]
        );

        Group_access::truncate()->create(
            [
                'group_id'  => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
                'module'    => 'user_account',
                'hierarchy' => '["master","user","user_account"]',
                'actions'   => '["detail","create","edit","delete"]'
            ],
            [
                'group_id'  => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
                'module'    => 'user_group',
                'hierarchy' => '["master","user","user_group"]',
                'actions'   => '["create","edit","delete"]'
            ]
        );

        Log::truncate()->create(
            [
                'id'          => '6d9998e0-bb4a-11e8-a3bb-e7dd7f926dae',
                'in_url'      => 'authentication',
                'action'      => 'login',
                'step'        => 0,
                'progress'    => 0,
                'open_from'   => 'web apps',
                'description' => 'login authentication',
                'input'       => '',
                'reason'      => '',
                'ref_type'    => 'Illuminate\Auth\Events\Login',
                'ref_id'      => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
                'ref_sub_id'  => 0,
                'isFIle'      => 0,
                'user_id'     => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
                'ip_address'  => '::1',
                'created_at'  => '2018-09-18 13:54:57',
                'updated_at'  => '2018-09-18 13:54:57',
            ],
            [
                'id'          => '6d9998e0-bb4a-11e8-a3bb-e7dd7f926dae',
                'in_url'      => 'authentication',
                'action'      => 'login',
                'step'        => 0,
                'progress'    => 0,
                'open_form'   => 'web apps',
                'description' => 'login authentication',
                'input'       => '',
                'reason'      => '',
                'ref_type'    => 'Illuminate\Auth\Events\Login',
                'ref_id'      => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
                'ref_sub_id'  => 0,
                'isFIle'      => 0,
                'user_id'     => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
                'ip_address'  => '::1',
                'created_at'  => '',
                'updated_at'  => '',
            ]
        );

        User::truncate()->create(
            [
                'id'          => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
                'username'    => 'admin',
                'email'       => 'julfi.upi@gmail.com',
                'fullname'    => 'Administrator',
                'phone'       => '08115806589',
                'id_card'     => '',
                'address'     => '',
                'last_login'  => '2018-09-19 14:40:06',
                'last_logout' => '2018-09-19 16:40:06',
                'type'        => 'user',
                'level'       => 'admin',
                'password'    => bcrypt('admin1')
            ]
        );

        User_group::truncate()->create(
            [
                'id'        => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
                'name'      => 'Super Admin',
                'img_type'  => 1,
                'img_group' => '1.jpg'
            ]
        );


    }
}
