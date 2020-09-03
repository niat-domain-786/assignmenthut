<?php

use Illuminate\Database\Seeder;

use App\User;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $role = Role::create(['name' => 'admin']);

        User::create([
            'name' => 'admin',
            'email' => 'admin@assignmenthut.com',
            'isAdmin' => '1',
            'password' => bcrypt('secret'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('admin');

        User::create([
            'name' => 'customer',
            'email' => 'customer@assignmenthut.com',
            'phone' => '001234567890',
            'password' => bcrypt('secret'),
            'email_verified_at' => Carbon::now()
            
        ]);
   

    }
}
