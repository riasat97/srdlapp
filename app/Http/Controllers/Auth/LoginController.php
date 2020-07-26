<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'applications/apply';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//    public function login(Request $request)
//    {
//        // Check validation
//        $this->validate($request, [
//            'mobile' => 'required|regex:/[0-9]{10}/|digits:11',
//        ]);
//
//        // Get user record
//        $user = User::where('mobile', $request->get('mobile'))->first();
//
//        // Check Condition Mobile No. Found or Not
//        if($request->get('mobile') != $user->mobile_no) {
//            \Session::put('errors', 'Your mobile number not match in our system..!!');
//            return back();
//        }
//
//        // Set Auth Details
//        \Auth::login($user);
//
//        // Redirect home page
//        return redirect()->route('apply');
//    }

    public function loginWithOtp(Request $request){
        Log::info($request);
        $user  = User::where([['mobile','=',request('mobile')],['otp','=',request('otp')]])->first();
        if( $user){
            Auth::login($user, true);
           // User::where('mobile','=',$request->mobile)->update(['otp' => null]);
            User::where('mobile','=',$request->mobile);
            return redirect()->route('applications.terms');
        }
        else{
            return Redirect::back ();
        }
    }
    public function sendOtp(Request $request){

        $mobile= $request->mobile;
        $otp = rand(1000,9999);
        Log::info("otp = ".$otp);
        //$user = User::where('mobile','=',$request->mobile)->update(['otp' => $otp]);
        $user = User::firstOrNew(['mobile' => $mobile]);
        if ($user->exists) {
            // user already exists
        }
        $user->email= $mobile.'@gmail.com';
        $user->otp= $otp;
        $user->save();
        $status=$this->sendOtpToMobile($mobile,$otp);
        $user['OTP_STATUS']=$status;
        // send otp to mobile no using sms api
        return response()->json([$user],200);
    }

    public function sendOtpToMobile($mobile,$otp){
        $client = new Client(['base_uri' => 'https://api.mobireach.com.bd/SendTextMessage']);

//        $response = $client->request('GET', '', ['query' => ['Username' => 'srdl',
//            "Password" => "Doict97!","From"=>"SRDL","To"=>"8801672702437","Message"=>"Your OTP For SRDL is "]]);

        $response = $client->request('POST', '', ['form_params' => [
            'Username' => 'srdl',
            'Password' => 'Doict97!',
            'From'=>'SRDL',
            'To'=>$mobile,
            'Message'=>'Your OTP For SRDL APP is : '.$otp
        ]]);
        //echo $response->getBody();
        return $response->getStatusCode();
    }
}
