<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['HTML', 'CSS', 'Javascript', 'Vuejs', 'PHP', 'MySQL', 'Laravel', 'Symfony', 'ReactJS', 'NodeJS', 'UI/UX Design'];

        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->name = $tag;
            $new_tag->slug = Tag::generateSlug($tag);

            $new_tag->save();
        }
    }
}
