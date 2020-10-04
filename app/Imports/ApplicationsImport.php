<?php

namespace App\Imports;

use App\Models\Application;
use App\Models\ApplicationAttachment;
use App\Models\Bangladesh;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ApplicationsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $count=0;
        foreach ($rows as $row)
        {
            $application= Application::create([
                'lab_type' => getResult(lab_type(),$row['lab_type']),
                'institution_type' => getResult(institution_type(),$row['institution_type']),
                'institution_bn' => $row['institution_bn'],
                'division' => $row['division'],
                'district' => $row['district'],
                'upazila' => $row['upazila'],
                'seat_type' => $this->getSeatInfo($row['seat_no_en'],'seat_type'),
                'parliamentary_constituency' => $this->getSeatInfo($row['seat_no_en'],'parliamentary_constituency'),
                'seat_no' => $this->getSeatInfo($row['seat_no_en'],'seat_no'),
                'listed_by_deo' => "YES"
            ]);
            $attachment= new ApplicationAttachment();
            $attachment->member_name= $row['member_name'];
            if(!empty($row['list_attachment_file_path']))
            $attachment->list_attachment_file_path= $row['list_attachment_file_path'];
            $application->attachment()->save($attachment);
            $count++;
        }
        echo nl2br("Successfully imported! no of rows: ".$count);
    }

    private function getSeatInfo($seat_no_en,$value){

        $bd=Bangladesh::where('seat_no_en',$seat_no_en)->first();

        if(!empty($bd) && $value=="seat_no")
            return $bd->seat_no;
        elseif(empty($bd) && $value=="seat_no"){
            $reserved_seats=ReservedSeats();
            foreach ($reserved_seats as $reserved_seat){
                if($reserved_seat['seat_no_en']== $seat_no_en){
                    return $reserved_seat['seat_no'];
                }
            }
            return "";
        }
        elseif (!empty($bd) && $value=="parliamentary_constituency")
            return $bd->parliamentary_constituency;
        elseif (empty($bd) && $value=="parliamentary_constituency"){
            $reserved_seats=ReservedSeats();
            foreach ($reserved_seats as $reserved_seat){
                if($reserved_seat["seat_no_en"]== $seat_no_en){
                    return $reserved_seat['parliamentary_constituency'];
                }
            }
            return "";
        }
        elseif ($value=="seat_type" && intval($seat_no_en) < 301){
            return 'general';
        }
        elseif ($value=="seat_type" && intval($seat_no_en) >= 301){
            return 'reserved';
        }

        else{
            return "";
        }

    }
}
