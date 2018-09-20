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
              'id'          => '87404ff0-b962-11e8-8ffe-af0db858398b',
              'group_id'    => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
              'module'      => 'item',
              'hierarchy'   => '["master","item"]',
              'actions'     => '["create","edit","delete"]',
            ],
            [
              'id'          => '87406df0-b962-11e8-921a-f31c11338bde',
              'group_id'    => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
              'module'      => 'unit',
              'hierarchy'   => '["master","unit"]',
              'actions'     => '["create","edit","delete"]'
            ],
            [
              'id'          => '87408650-b962-11e8-aa95-8952dd850b4b',
              'group_id'    => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
              'module'      => 'account',
              'hierarchy'   => '["master","account"]',
              'actions'     => '["detail","create","edit","delete"]'
            ],
            [
              'id'          => '87409f10-b962-11e8-ac9b-e7e489ef4dfc',
              'group_id'    => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
              'module'      => 'user_account',
              'hierarchy'   => '["master","user","user_account"]',
              'actions'     => '["detail","create","edit","delete"]'],
            [
              'id'          => '8740b870-b962-11e8-a5f1-01525f7d323e',
              'group_id'    => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
              'module'      => 'user_group',
              'hierarchy'   => '["master","user","user_group"]',
              'actions'     => '["create","edit","delete"]'
            ]
        );

        // Log::truncate()->create(
        //     [
        //         'id'          => '6d9998e0-bb4a-11e8-a3bb-e7dd7f926dae',
        //         'in_url'      => 'authentication',
        //         'action'      => 'login',
        //         'step'        => 0,
        //         'progress'    => 0,
        //         'open_from'   => 'web apps',
        //         'description' => 'login authentication',
        //         'input'       => '',
        //         'reason'      => '',
        //         'ref_type'    => 'Illuminate\Auth\Events\Login',
        //         'ref_id'      => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
        //         'ref_sub_id'  => 0,
        //         'isFIle'      => 0,
        //         'user_id'     => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
        //         'ip_address'  => '::1',
        //         // 'created_at'  => '2018-09-18 13:54:57',
        //         // 'updated_at'  => '2018-09-18 13:54:57',
        //     ],
        //     [
        //         'id'          => 'd82cb910-bbd6-11e8-af5d-b10eb0ef1f69',
        //         'in_url'      => 'authentication',
        //         'action'      => 'login',
        //         'step'        => 0,
        //         'progress'    => 0,
        //         'open_form'   => 'web apps',
        //         'description' => 'login authentication',
        //         'input'       => '',
        //         'reason'      => '',
        //         'ref_type'    => 'Illuminate\Auth\Events\Login',
        //         'ref_id'      => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
        //         'ref_sub_id'  => 0,
        //         'isFIle'      => 0,
        //         'user_id'     => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
        //         'ip_address'  => '::1',
        //         'created_at'  => '',
        //         'updated_at'  => '',
        //     ]
        // );
        //
        // User::truncate()->create(
        //     [
        //         'id'          => 'b96acfa0-b7fd-11e8-ab0a-57ae119f6d91',
        //         'username'    => 'admin',
        //         'email'       => 'julfi.upi@gmail.com',
        //         'fullname'    => 'Administrator',
        //         'phone'       => '08115806589',
        //         'id_card'     => '',
        //         'address'     => '',
        //         'last_login'  => '2018-09-19 14:40:06',
        //         // 'last_logout' => '2018-09-19 20:40:01',
        //         'type'        => 'user',
        //         'level'       => 'admin',
        //         'password'    => bcrypt('admin1'),
        //         // 'created_at'  => '0000-00-00 00:00:00',
        //         // 'updated_at'  => '0000-00-00 00:00:00',
        //     ]
        // );
        //
        // User_group::truncate()->create(
        //     [
        //         'id'        => 'b96c80c0-b7fd-11e8-bac2-41b7703c830b',
        //         'name'      => 'Super Admin',
        //         'img_type'  => 1,
        //         'img_group' => '1.jpg'
        //     ]
        // );


    }
}
