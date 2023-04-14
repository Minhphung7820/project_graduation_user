<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class FacebookController extends Controller
{
    protected $host;

    public function __construct()
    {
        $this->host = 'http://127.0.0.1:3000/';
    }
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        $facebook_user = Socialite::driver('facebook')->stateless()->user();
        $login = json_decode(Http::post($this->host . 'api/auth/login-facebook', [
            'provider' => 'FACEBOOK',
            'provider_id' => $facebook_user->id,
            'email' => $facebook_user->email,
            'name' => $facebook_user->name,
        ]));

        if ($login->status == 200) {
            session()->put('access_token_login', $login->token);
            $data = json_decode(Http::withToken($login->token)->get($this->host . 'api/myAccountClient'));
            session()->put('customer', $data);
            return redirect('/my-account');
        }
    }
}
