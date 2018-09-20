<?php

use Illuminate\Database\Seeder;
use App\web\Models\User;
use App\web\Models\User_group;
use App\web\Models\Group_access;
use App\web\Models\Group_member;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
