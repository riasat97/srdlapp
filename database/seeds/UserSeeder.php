<?php

use App\Models\Bangladesh;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districtCount=0;
        $upazilaCount=0;
        $districts=Bangladesh::distinct()->orderBy('division','asc')->orderBy('district','asc')->get(['district_en']);
        foreach ($districts as $district){
            $username = $this->getUserName($district->district_en,null);
            $user=User::create(['username'=> $username,'email'=>$username.'@mail.com']);
            $user->assignRole('district admin');
            $upazilas= Bangladesh::where('district_en',$district->district_en)->distinct()->get(['upazila_en','district_en']);
            foreach ($upazilas as $upazila){
                $username = $this->getUserName($upazila->district_en,$upazila->upazila_en);
                $user=User::create(['username'=> $username,'email'=>$username.'@mail.com']);
                $user->assignRole('upazila admin');
                //$upazila_en_domain= $this->getUpazilaEnDomain($upazila->upazila_en);
                //Bangladesh::where('district_en',$upazila->district_en)->where('upazila_en',$upazila->upazila_en)->update(['upazila_en_domain'=>$upazila_en_domain]);
                $upazilaCount++;
            }
            $districtCount++;
        }
        $str= $districtCount."
        ".$upazilaCount;
        echo nl2br($str);
    }

    /**
     * @return mixed
     */
    private function getUserName($district,$upazila)
    {

        if(empty($upazila))
        $username = strtolower(str_replace(' ', '', $district)).'_admin';
        else $username= strtolower(str_replace(' ', '', $upazila)).'_'.strtolower(str_replace(' ', '', $district)).'_admin';
        return $username;
    }
    private function getUpazilaEnDomain($upazila)
    {

        $upazilaEnDomain= strtolower(str_replace(' ', '', $upazila));
        return $upazilaEnDomain;
    }
    public function refreshDB()
    {
        $max = DB::table('users')->max('id') + 1;
        DB::statement("ALTER TABLE users AUTO_INCREMENT =  $max");
    }
}