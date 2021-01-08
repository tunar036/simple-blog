<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('configs')->insert([
            'title'=>"Blog Site",
            'created_at'=>now(),
            'updated_at'=>now(),
           ]);
    }
}
