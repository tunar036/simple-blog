<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['About','Blog', 'Career','Sample Post'];
        $count=0;
        foreach ($pages as $page) {
            $count++;
          DB::table('pages')->insert([
              'title'=>$page,
              'slug'=> str::slug($page),
              'image'=>'https://miro.medium.com/max/8000/1*JrHDbEdqGsVfnBYtxOitcw.jpeg',
              'content'=>'There are many variations of passages of Lorem Ipsum available,
               but the majority have suffered alteration in some form, by injected humour,
                or randomised words which do not look even slightly believable. If you are 
                going to use a passage of Lorem Ipsum, you need to be sure there is not anything 
                embarrassing hidden in the middle of text.',
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=>now(),
          ]);
        }

    }
}
