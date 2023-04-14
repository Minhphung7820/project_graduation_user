<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->host = 'http://127.0.0.1:3000/';
    }
    public function index()
    {
        $urlLogo =$this->host.'logos';
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
        return view('about.index',compact('infos','urlLogo'));
    }
}
