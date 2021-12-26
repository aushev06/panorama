<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrcreate([
            User::ATTR_EMAIL => 'admin@admin.ru',
            User::ATTR_PASSWORD => Hash::make('11111111'),
            User::ATTR_NAME => 'Admin',
            User::ATTR_ROLE => User::ROLE_ADMIN,
            User::ATTR_EMAIL_VERIFY_AT => '2021-10-03 05:44:05',
            User::ATTR_PHONE_VERIFY_AT => '2021-10-03 05:44:05',

        ]);
    }
}
