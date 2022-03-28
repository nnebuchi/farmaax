<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\VisitCount;
use Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agreement' => ['required']
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = substr(str_shuffle(str_repeat($pool, 7)), 0, 8);

        if (session('referral')) {

            $data['referral'] = session('referral');

            $parent_id = User::where('referral_code', session('referral'))->first()->id;
            if ($parent_id) {
                $visit = new VisitCount();
                $visit->user_id = $parent_id;
                $visit->visit_counts = 1;
                $visit->visit_counts = 1;
                $visit->save();
            }
        } else {

            $parent_id = 0;
        }

        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'wallet_id' => 'farmaax-' . $result,
            'password' => Hash::make($data['password']),
            'referral_code' => time() . Str::random(4),
            'parent' => $parent_id,
        ]);
    }
}
