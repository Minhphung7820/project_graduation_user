<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->host = 'http://127.0.0.1:3000/';
    }
    public function index()
    {
        $products = json_decode(Http::get($this->host.'api/products1'),true);
        $sliders = json_decode(Http::get($this->host.'api/allSlider'));
        $urlLogo = $this->host.'/logos';
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'));
        // var_dump($products);
        return view('home.index',compact('products','sliders','infos','urlLogo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {

        // return view('products.index',compact('products'));
        // var_dump($products);
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        // if(Session::has('email')){
        //     echo Session::get('email');
        // }
        $urlLogo = $this->host.'logos';
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
        return view('products.cart',compact('infos','urlLogo'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request,$i)
    {
        $slug = $i;
        $result = json_decode(Http::get($this->host.'api/singleProd/'.$slug),true);
        $product=$result['product'];
        $relate=$result['relate'];
        $images=$result['images'];
        $storages=$result['storage'];
        $sizes=[];
        $colors=[];
        foreach($storages as$key=> $value){
            
            if(isset($sizes[$value['sizename']])){
                continue;
            }
             if(isset($colors[$value['color']])){
                continue;
            }
            $colors[$value['color']]=['id'=>$value['id'],'color'=>$value['color']];
            $sizes[$value['sizename']]=['id'=>$value['id'],'sizename'=>$value['sizename']];
            
        }
        $image= $images[0];
        $urlLogo = $this->host.'logos';
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'));
        return view('products.single',compact('product','relate','sizes','colors','images','image','infos','urlLogo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
