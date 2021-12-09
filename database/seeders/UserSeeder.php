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
        $moderator = Role::where('name', 'moderator')->value('id');
        $reader = Role::where('name', 'reader')->value('id');

        $user1 = new User();
        $user1->name = 'olga';
        $user1->email = 'moosbeere_O@mail.ru';
        $user1->password = Hash::make(123456);
        $user1->role_id = $moderator;
        $user1->save();

        $user2 = new User();
        $user2->name = 'vova';
        $user2->email = 'vova@mail.ru';
        $user2->password = Hash::make(123456);
        $user2->role_id = $reader;
        $user2->save();
    }
}
