<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('roles')->insert([
            'code' => bcrypt('mod'),
            'name' => 'mod',
            'display_name' => 'Moderator',
            'order' => 1,
        ]);
        DB::table('roles')->insert([
            'code' => bcrypt('admin'),
            'name' => 'admin',
            'display_name' => 'Admin',
            'order' => 2,
        ]);
    }
}
