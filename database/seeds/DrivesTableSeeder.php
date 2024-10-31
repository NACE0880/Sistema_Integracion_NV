<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DrivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drives')->insert(['ID_DRIVE' => 1,  'ID_CASA' => 1, 'LIGA' => 'https://drive.google.com/drive/folders/1ooG_cYUvjzEfAVSkKlqK3MoDcZJM_eWL']);
        DB::table('drives')->insert(['ID_DRIVE' => 2,  'ID_CASA' => 2, 'LIGA' => 'https://drive.google.com/drive/folders/1ac2Wj9BncIUr3dazGbc84j058uXzrQbJ?usp=sharing']);
        DB::table('drives')->insert(['ID_DRIVE' => 3,  'ID_CASA' => 3, 'LIGA' => 'https://drive.google.com/drive/folders/1pIl3o1aThzh_Xlbt9jrYybkFGUXSKnPu?usp=sharing']);
        DB::table('drives')->insert(['ID_DRIVE' => 4,  'ID_CASA' => 4, 'LIGA' => 'https://drive.google.com/drive/folders/1gIziLzQxe4St4qk7liUhEbtXMt2armGm?usp=sharing']);
        DB::table('drives')->insert(['ID_DRIVE' => 5,  'ID_CASA' => 5, 'LIGA' => 'https://drive.google.com/drive/folders/1CXKlzQdnJKQO532JpOuCVZxriUwH1dUt?usp=sharing']);
        DB::table('drives')->insert(['ID_DRIVE' => 6,  'ID_CASA' => 6, 'LIGA' => 'https://drive.google.com/drive/folders/1gkg_uYNQudMkFs6jJA3Wc_Mmb5TCO9q7?usp=sharing']);
        DB::table('drives')->insert(['ID_DRIVE' => 7,  'ID_CASA' => 7, 'LIGA' => 'https://drive.google.com/drive/folders/1CvIS1PYY4nlMOU8L4Swx3WvynBvLP4OY?usp=sharing']);
        DB::table('drives')->insert(['ID_DRIVE' => 8,  'ID_CASA' => 8, 'LIGA' => 'https://drive.google.com/drive/folders/1Bi9SJv9S2it_GSmA34kWNB8PyTfqjAYu?usp=sharing']);
        DB::table('drives')->insert(['ID_DRIVE' => 9,  'ID_CASA' => 9, 'LIGA' => 'https://drive.google.com/drive/folders/17LVuWtuM8XvP8pLRSj2qmaPyr92ORnoj']);
        DB::table('drives')->insert(['ID_DRIVE' => 10,  'ID_CASA' => 10, 'LIGA' => 'https://drive.google.com/drive/folders/1FZY7y6yfkzcuTNJ2T7OhqRRTWCJfy90Z?usp=sharingg']);

    }
}
