<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

         DB::table('users')->insert([
            'name' => 'Professor',
            'email' => 'professor@example.com',
            'password' => Hash::make('password1'),
            'role' => 'admin',
        ]);

        
        DB::table('users')->insert([
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password2'),
            'role' => 'user',
        ]);
    }
}
