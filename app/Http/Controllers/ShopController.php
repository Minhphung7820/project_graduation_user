<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->host = 'http://127.0.0.1:3000/';
    }
    public function index()
    {
        $urlImage =$this->host.'images';
        $urlLogo =$this->host.'logos';
        $productsShop = json_decode(Http::get($this->host.'api/allProductShop'),true);
        $categories = json_decode(Http::get($this->host.'api/allCateClient'),true);
        $brands = json_decode(Http::get($this->host.'api/allBrandClient'),true);
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
        $products=$productsShop['products'];
            return view('shop.index',compact('products','categories','brands','urlImage','infos','urlLogo'))->render();
    }
    public function menShop()
    {
        $urlImage =$this->host.'images';
        $urlLogo =$this->host.'logos';
        $productsMen = json_decode(Http::get($this->host.'api/allProductMen'),true);
        $categories = json_decode(Http::get($this->host.'api/allCateClientMen'),true);
        $brands = json_decode(Http::get($this->host.'api/allBrandClientMen'),true);
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
        $products=$productsMen['products'];
        return view('men.index',compact('products','categories','brands','urlImage','infos','urlLogo'))->render();
    }
    public function WomenShop()
    {
        $urlImage =$this->host.'images';
        $urlLogo =$this->host.'logos';
        $productsWomen = json_decode(Http::get($this->host.'api/allProductMen'),true);
        $categories = json_decode(Http::get($this->host.'api/allCateClientWomen'),true);
        $brands = json_decode(Http::get($this->host.'api/allBrandClientWomen'),true);
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
        $products=$productsWomen['products'];
        return view('women.index',compact('products','categories','brands','urlImage','infos','urlLogo'))->render();
    }
    public function shopDetail(Request $request){
        $slug = $request->slug;
        $urlLogo =$this->host.'logos';
        $urlImage =$this->host.'images';
        $detailCate = json_decode(Http::get($this->host.'api/singleCategrories/'.$request->slug));
        $products = json_decode(Http::get($this->host.'api/shop/'.$slug),true);;
        $categories = json_decode(Http::get($this->host.'api/allCateClient'),true);
        $brands = json_decode(Http::get($this->host.'api/allBrandClient'),true);
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
        $productsDetail=$products['products'];
        return view('shop.detail',compact('productsDetail','categories','brands','slug','urlImage','infos','urlLogo','detailCate'))->render();
    }
}
