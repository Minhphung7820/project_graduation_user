<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RatingProduct extends Controller
{
    protected $host;
    public function __construct()
    {
        $this->host = 'https://api.trungthanhweb.com/';
    }

    public function addRating(Request $request)
    {
           $data = json_decode(Http::post($this->host.'api/addRating',$request->all()));
           return response()->json($data);
    }
}
