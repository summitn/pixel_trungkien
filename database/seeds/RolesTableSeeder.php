<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'created_at' => '2017-02-10 14:18:17',
                'updated_at' => '2017-02-10 14:18:17',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'user',
                'display_name' => 'Normal User',
                'created_at' => '2017-02-10 14:18:17',
                'updated_at' => '2017-02-10 14:18:17',
            ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'free user',
                    'display_name' => 'Free User',
                    'created_at' => '2017-02-10 14:18:17',
                    'updated_at' => '2017-02-10 14:18:17',
                ),
        ));
        
        
    }
}