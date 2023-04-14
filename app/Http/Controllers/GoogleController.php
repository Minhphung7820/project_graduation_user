<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class GoogleController extends Controller
{
    protected $host;

    public function __construct()
    {
        $this->host = 'http://127.0.0.1:3000/';
    }
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {


        $google_user = Socialite::driver('google')->stateless()->user();

        $login = json_decode(Http::post($this->host . 'api/auth/login-google', [
            'provider' => 'GOOGLE',
            'provider_id' => $google_user->id,
            'email' => $google_user->email,
            'name' => $google_user->name,
        ]));
        if ($login->status == 200) {
            session()->put('access_token_login', $login->token);
            $data = json_decode(Http::withToken($login->token)->get($this->host . 'api/myAccountClient'));
            session()->put('customer', $data);
            return redirect('/my-account');
        }
    }
}
