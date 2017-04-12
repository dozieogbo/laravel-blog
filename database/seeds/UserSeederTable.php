<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User([
            'name' => 'Demo User',
            'email' => 'demo_user@gmail.com',
            'password' => 'password'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Demo User 02',
            'email' => 'demo_user02@gmail.com',
            'password' => 'password'
        ]);
        $user->save();
    }
}
