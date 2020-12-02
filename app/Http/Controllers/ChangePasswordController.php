<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChangePasswordRequest;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.passwords.changePassword');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(CreateChangePasswordRequest $request)
    {
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return back()->with('success', 'পাসওয়ার্ডটি সফলভাবে পরিবর্তন করা হয়েছে ! ধন্যবাদ !');

    }
}
