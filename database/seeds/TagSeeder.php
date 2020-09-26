<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = \Spatie\Tags\Tag::findOrCreate('Sheikh Russel Digital Lab');
        $tag->setTranslation('name', 'bn', 'শেখ রাসেল ডিজিটাল ল্যাব');

        $tag->save();

        $tag = \Spatie\Tags\Tag::findOrCreate('Bangladesh Computer Council');
        $tag->setTranslation('name', 'bn', 'বাংলাদেশ কম্পিউটার কাউন্সিল');

        $tag->save();

        $tag = \Spatie\Tags\Tag::findOrCreate('Ministry of Education');
        $tag->setTranslation('name', 'bn', 'শিক্ষা মন্ত্রণালয়');
        $tag->save();

        $tag = \Spatie\Tags\Tag::findOrCreate('Directorate of Secondary and Higher Education');
        $tag->setTranslation('name', 'bn', 'মাধ্যমিক ও উচ্চশিক্ষা অধিদপ্তর');
        $tag->save();

        $tag = \Spatie\Tags\Tag::findOrCreate('Education Board');
        $tag->setTranslation('name', 'bn', 'শিক্ষা বোর্ড');
        $tag->save();

//        $tag = \Spatie\Tags\Tag::findOrCreate('NGO');
//        $tag->setTranslation('name', 'bn', 'এনজিও');
//        $tag->save();

//        $tag = \Spatie\Tags\Tag::findOrCreate('Local Government');
//        $tag->setTranslation('name', 'bn', 'স্থানীয় সরকার');
//        $tag->save();

        $tag = \Spatie\Tags\Tag::findOrCreate('Others');
        $tag->setTranslation('name', 'bn', 'অন্যান্য');
        $tag->save();
        // DB::table('tags')->insert([
        //     ['name' => 'Sheikh Rasel Digital Lab', 'name_bn'=>'শেখ রাসেল ডিজিটাল ল্যাব'],
        //     ['name' => 'Bangladesh Computer Council', 'name_bn'=>'বাংলাদেশ কম্পিউটার কাউন্সিল'],
        //     ['name' => 'Ministry of Education', 'name_bn'=>'শিক্ষা মন্ত্রণালয়'],
        //     ['name' => 'Directorate of Secondary and Higher Education', 'name_bn'=>'মাধ্যমিক ও উচ্চশিক্ষা অধিদপ্তর'],
        //     ['name' => 'Education Board', 'name_bn'=>'শিক্ষা বোর্ড'],
        //     ['name' => 'NGO', 'name_bn'=>'এনজিও'],
        //     ['name' => 'Local Government', 'name_bn'=>'স্থানীয় সরকার'],
        //     ['name' => 'Others', 'name_bn'=>'অন্যান্য']
        // ]);
    }
}
