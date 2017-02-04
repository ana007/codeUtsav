<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "admin";
        $user->role = "Admin";
        $user->email = "pav@codeutsav.in";
        $user->password = bcrypt("welcome");
        $user->save();
    }
}
