<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tag = new Tag();
        $tag->name = "Tutorial";
        $tag->save();

        $tag = new Tag();
        $tag->name = "Fiction";
        $tag->save();

        $tag = new Tag();
        $tag->name = "News";
        $tag->save();
    }
}
