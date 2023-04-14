<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;

    class HomeController extends Controller
    {
        public function __construct()
        {
            $this->host = 'http://127.0.0.1:3000/';
        }
        public function index()
        {
            $urlImage = $this->host.'images';
            $urlSliders = $this->host.'sliders';
            $urlLogo = $this->host.'logos';
            $urlCate = $this->host.'category';
            $products = json_decode(Http::get($this->host.'api/products1'),true);
            $productsHomeFilter = json_decode(Http::get($this->host.'api/productsHomeFilter'),true);
            $productsHotTrend = json_decode(Http::get($this->host.'api/productsHotTrend'),true);
            $productsBestSeller = json_decode(Http::get($this->host.'api/productsBestSeller'),true);
            $productsFeature = json_decode(Http::get($this->host.'api/productsFeature'),true);
            $sliders = json_decode(Http::get($this->host.'api/allSlider'),true);
            $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
            $categories = json_decode(Http::get($this->host.'api/allCateClient'),true);
            $cateHomeClientTop_1 = json_decode(Http::get($this->host.'api/getCateHomeTopClient_1'),true);
            $cateHomeClientTop_4 = json_decode(Http::get($this->host.'api/getCateHomeTopClient_4'),true);
            $productModal = json_decode(Http::get($this->host.'api/getProducModal'),true);
            $productsHome = $productsHomeFilter['products'];
            return view('home.index',compact('cateHomeClientTop_1','cateHomeClientTop_4','sliders','productModal','infos','products','productsHotTrend','productsBestSeller','productsFeature','categories','productsHome','urlImage','urlSliders','urlLogo','urlCate'))->render();
        }
    }
?>