<?php

use App\Models\Reference;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member=Reference::create(
            ['ref_type'=>'মাননীয় সংসদ সদস্য']
        );
        $gov_officer=Reference::create(
            ['ref_type'=>'সরকারি কর্মকর্তা']
        );
        $famous_person=Reference::create(
            ['ref_type'=>'প্রখ্যাত ব্যক্তিত্ব']
        );
        $others=Reference::create(
            ['ref_type'=>'অন্যান্য']
        );
    }
}
