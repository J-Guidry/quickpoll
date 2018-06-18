<?php

use Illuminate\Database\Seeder;

class quickpollTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('polls')->insert([
            'poll_name' => 'Is it good?',
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('polls')->insert([
            'poll_name' => 'How was it?',
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('poll_options')->insert([
            'option_name' => 'yes',
            'poll_id' => 1,
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('poll_options')->insert([
            'option_name' => 'no',
            'poll_id' => 1,
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('poll_options')->insert([
            'option_name' => 'alright',
            'poll_id' => 2,
            'vote_count' => 12,
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('poll_options')->insert([
            'option_name' => 'poor',
            'poll_id' => 2,
            'vote_count' => 5,
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('poll_options')->insert([
            'option_name' => 'nice',
            'poll_id' => 2,
            'vote_count' => 25,
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('poll_options')->insert([
            'option_name' => 'was boring',
            'poll_id' => 2,
            'vote_count' => 17,
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('poll_options')->insert([
            'option_name' => 'great!',
            'poll_id' => 2,
            'vote_count' => 1,
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);

        DB::table('poll_options')->insert([
            'option_name' => 'terrible',
            'poll_id' => 2,
            'vote_count' => 35,
            'created_at' => '2018-06-13 20:00:00',
            'updated_at' => '2018-06-13 20:00:00'
        ]);


    }
}
