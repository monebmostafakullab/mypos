<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\Admin::create([
            'first_name'=>'super',
            'last_name'=>'admin',
            'email'=>'superadmin@app.com',
            'mobile'=>'0599570709',
            'password'=>bcrypt('123456'),
        ]);
        $admin->attachRole('super_admin');
    }
}
