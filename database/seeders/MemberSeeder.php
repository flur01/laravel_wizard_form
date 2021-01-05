<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'firstname' => 'Mike',
            'lastname' => 'Bruno',
            'birthdate' => '1980-06-01',
            'report_subject' => 'Angular',
            'email' => 'MikeBruno@gmail.com',
            'country' => 'USA',
            'phone' => '+1 (894) 471-5354',
        ]);

        DB::table('members')->insert([
            'firstname' => 'William ',
            'lastname' => 'Barr',
            'birthdate' => '1950-04-23',
            'report_subject' => 'Vue',
            'email' => 'WilliamBarr@gmail.com',
            'country' => 'USA',
            'phone' => '+1 (478) 923-0149',
        ]);
    }
}
