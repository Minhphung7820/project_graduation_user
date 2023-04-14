<?php

namespace App\Http\Controllers;

use App\Mail\ActiveAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class Customer extends Controller
{
    protected $host;
    public function __construct(Request $request)
    {
        $this->host = 'http://127.0.0.1:3000/';
    }
    public function login()
    {
        $urlLogo = $this->host . 'logos';
        $infos = json_decode(Http::get($this->host . 'api/infoShopClient'), true);
        return view('customer.login', compact('infos', 'urlLogo'));
    }
    public function _login(Request $request)
    {
        $login = json_decode(Http::post($this->host . 'api/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]));
        if ($login->status == 202) {
            return response()->json(['status' => 202, 'msg' => $login->msg]);
        } elseif ($login->status == 200) {
            session()->put('access_token_login', $login->token);
            $data = json_decode(Http::withToken($login->token)->get($this->host . 'api/myAccountClient'));
            session()->put('customer', $data);
            return response()->json(['status' => 200, 'msg' => $login->msg, 'token' => $login->token]);
        } elseif ($login->status == 204) {
            return response()->json(['status' => 204, 'msg' => $login->msg]);
        }
    }

    public function my_account(Request $request)
    {
        $data = json_decode(Http::withToken(session()->get('access_token_login'))->get($this->host . 'api/myAccountClient'));
        if (session()->has('customer')) {
            $result = json_decode(json_encode(session()->get('customer')), true);
            $email = $result['email'];
            $provider_id = $result['provider_id'];
        }
        $host = $request->getHttpHost();
        $result = Http::post('http://127.0.0.1:3000/api/getUserBills', ['host' => $request->getHttpHost(), 'email' => $email, 'provider_id' => $provider_id]);
        $bills = json_decode($result, true);
        $urlLogo = $this->host . 'logos';
        $infos = json_decode(Http::get($this->host . 'api/infoShopClient'), true);
        return view('customer.account')->with(compact('bills', 'infos', 'urlLogo'));
    }

    public function logout()
    {
        session()->forget('access_token_login');
        session()->forget('customer');
        $logout = json_decode(Http::get($this->host . 'api/auth/logout'));
        if ($logout->status == 200) {
            return redirect('/login');
        }
    }

    public function register()
    {
        $urlLogo = $this->host . 'logos';
        $infos = json_decode(Http::get($this->host . 'api/infoShopClient'), true);
        return view('customer.register', compact('urlLogo', 'infos'));
    }

    public function _register(Request $request)
    {
        $register = json_decode(Http::post($this->host . 'api/auth/register', $request->all()));
        if ($register->status == 202) {
            return response()->json(['status' => 202, 'msg' => $register->msg]);
        } elseif ($register->status == 204) {
            return response()->json(['status' => 204, 'msg' => $register->msg]);
        } elseif ($register->status == 200) {

            return response()->json(['status' => 200, 'msg' => $register->msg]);
        }
    }
    public function activated($hash_email = null)
    {
        if (!$hash_email) {
            return abort(404);
        }
        $active = json_decode(Http::post($this->host . 'api/client/acitve', [
            'hash_email' => $hash_email,
        ]));
        if ($active->status == 404) {
            return abort(404);
        } elseif ($active->status == 200) {
            session()->put('access_token_login', $active->token);
            $data = json_decode(Http::withToken($active->token)->get($this->host . 'api/myAccountClient'));
            session()->put('customer', $data);
            return redirect('/my-account');
        }
    }

    public function change_password(Request $request)
    {
        $change = json_decode(Http::post($this->host . 'api/ChangePasswordCustomer', $request->all()));
        if ($change->status == 200) {
            return response()->json(['status' => 200, 'msg' => $change->msg]);
        } elseif ($change->status == 202) {
            return response()->json(['status' => 202, 'msg' => $change->msg]);
        } elseif ($change->status == 204) {
            return response()->json(['status' => 204, 'msg' => $change->msg]);
        }
    }
    public function forgot(Request $request)
    {
        $check = json_decode(Http::post($this->host . 'api/forgotPasswordCustomer', $request->all()));
        if ($check->status == 200) {
            return response()->json(['status' => 200, 'msg' => $check->msg]);
        } elseif ($check->status == 202) {
            return response()->json(['status' => 202, 'msg' => $check->msg]);
        } elseif ($check->status == 204) {
            return response()->json(['status' => 204, 'msg' => $check->msg]);
        }
    }

    public function reset_pass($hashE = null)
    {
        if (!$hashE) {
            return abort(404);
        }
        $urlLogo = $this->host . 'logos';
        $infos = json_decode(Http::get($this->host . 'api/infoShopClient'), true);
        return view('customer.reset-password', compact('urlLogo', 'infos', 'hashE'));
    }
    public function _reset_pass(Request $request)
    {
        $reset = json_decode(Http::post($this->host . 'api/reset_passwordCustomer', $request->all()));
        if ($reset->status == 404) {
            return response()->json(['status' => 404, 'msg' => $reset->msg]);
        } elseif ($reset->status == 200) {
            return response()->json(['status' => 200, 'msg' => $reset->msg]);
        } elseif ($reset->status == 202) {
            return response()->json(['status' => 202, 'msg' => $reset->msg]);
        }
    }
}
