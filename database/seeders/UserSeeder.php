<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moderator = Role::where('name', 'moderator');
        $reader = Role::where('name', 'reader');


        $user1 = new User;
        $user1->name = 'Olga';
        $user1->email = 'moosbeere_O@mail.ru';
        $user1->password = Hash::make(123456);
        $user1->role_id = 1;
        $user1->save();

        $user2 = new User;
        $user2->name = 'Vova';
        $user2->email = 'vova@mail.ru';
        $user2->password = Hash::make(123456);
        $user2->role_id = 2;
        $user2->save();
        
    }
}
