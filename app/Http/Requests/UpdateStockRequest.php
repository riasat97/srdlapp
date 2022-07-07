<?php

namespace App\Http\Requests;

use App\Models\Lab;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Stock;
use Illuminate\Http\Request;

class UpdateStockRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $urlArrCount=count(explode("/",$request->url()));
        $urlArr=explode("/",$request->url());
        $labId=$urlArr[$urlArrCount-1];
        $stockId=$urlArr[$urlArrCount-3];
        $lab= Lab::where('id',$labId)->with('stock')->first();
        if(in_array($lab->lab_type,['srdl_sof'])){
            $rules = [
                'contract' => 'required',
                'renovation' => 'required',
                'laptop' => 'required',
                'printer' => 'required',
                'scanner' => 'required',
                'router' => 'required',
                'network_switch' => 'required',
                'led_tv' => 'required',
                'webcam' => 'required',
                'networking' => 'required',
                'furniture' => 'required',
                'sof_contract' => 'required',
                'smart_board' => 'required',
                'desktop' => 'required',
                'industrial_router' => 'required',
                'attendance_reader' => 'required',
                'digital_id_card' => 'required'
            ];
        }
        elseif(in_array($lab->lab_type,['sof'])){
            $rules = [
                'sof_contract' => 'required',
                'smart_board' => 'required',
                'desktop' => 'required',
                'industrial_router' => 'required',
                'attendance_reader' => 'required',
                'digital_id_card' => 'required'
            ];
        }
        elseif (in_array($lab->lab_type,['srdl'])){
            $rules = [
                'contract' => 'required',
                'renovation' => 'required',
                'laptop' => 'required',
                'printer' => 'required',
                'scanner' => 'required',
                'router' => 'required',
                'network_switch' => 'required',
                'led_tv' => 'required',
                'webcam' => 'required',
                'networking' => 'required',
                'furniture' => 'required'
            ];
        }
        return $rules;
    }
}
