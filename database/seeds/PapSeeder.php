<?php

use App\Models\Bangladesh;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $districtCount = 0;
        $upazilaCount = 0;
        $districts = Bangladesh::distinct()->orderBy('division', 'asc')->orderBy('district', 'asc')->get(['district_en']);
        foreach ($districts as $district) {
            $username = $this->getUserName($district->district_en, null);
            $user = User::create(['name' => $district->district_en . ' District Admin', 'username' => $username, 'email' => $username . '@mail.com', 'password' => Hash::make("12345678")]);
            $user->assignRole(['district admin','district']);
            $upazilas = Bangladesh::where('district_en', $district->district_en)->distinct()->get(['upazila_en', 'district_en']);
            foreach ($upazilas as $upazila) {
                $username = $this->getUserName($upazila->district_en, $upazila->upazila_en);
                $user = User::create(['name' => $upazila->upazila_en . ' Upazila Admin', 'username' => $username, 'email' => $username . '@mail.com', 'password' => Hash::make("12345678")]);
                $user->assignRole(['upazila admin','upazila']);
                $upazilaCount++;
            }
            $districtCount++;
        }
        $str = $districtCount . "
        " . $upazilaCount;
        echo nl2br($str);
    }

    /**
     * @return mixed
     */
    private function getUserName($district, $upazila)
    {
        if (empty($upazila))
            $username = strtolower(str_replace(' ', '', $district)) . '_programmer';
        else $username = strtolower(str_replace(' ', '', $upazila)) . '_' . strtolower(str_replace(' ', '', $district)) . '_ap';
        return $username;
    }

}
