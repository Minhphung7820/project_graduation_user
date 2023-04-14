<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

Carbon::setLocale('vi');
class BlogController extends Controller
{
    protected $host;
    protected $tag;
    public function __construct()
    {
        $this->host = 'http://127.0.0.1:3000/';
    }

    // ================================================


    public function all()
    {
        $urlImageBlog = $this->host . 'images/posts/';
        $data = json_decode(Http::get($this->host . "api/allBlogsClient"));
        $blogs = $data->result;
        $count = $data->count;
        $remaining = $count - count($blogs);
        $arrId = [];
        foreach ($blogs as $key => $value) {
            $arrId[] = $value->id;
        }
        $idMin = count($arrId) > 0 ? min($arrId) : '';
        $urlLogo = $this->host.'logos';
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
        return view('blog.all', compact('urlImageBlog', 'blogs', 'idMin', 'count', 'remaining','infos','urlLogo'));
    }

    // ================================================


    public function viewMoreBlog($min)
    {
        $output = '';
        $id = $min;
        $data = json_decode(Http::get($this->host . 'api/viewMoreBlog/' . $id));
        $result = $data->result;
        $count = $data->count;
        $remaining = $count - count($result);
        if (count($result) > 0) {
            $arrId = [];
            foreach ($result as $key => $value) {
                $arrId[] = $value->id;
            }
            $idMin = count($arrId) > 0 ? min($arrId) : '';
            foreach ($result as $key => $value) {
                $output .= ' <div class="col-lg-4 col-md-4 col-sm-6">';
                $image_1 = ($value->imagePosts != null) ? $this->host . 'images/posts/' . $value->imagePosts : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png';
                $output .= '      <div class="blog__item">
                     <div class="blog__item__pic large__item set-bg" data-setbg="' . $image_1 . '"></div>
                     <div class="blog__item__text">
                         <h6><a href="/blog/detail/' . $value->cate_posts->slugCatePost . '/' . $value->slugPosts . '.html">' . $value->titlePosts . '</a></h6>
                         <ul>
                             <li>đăng bởi <span>' . $value->author . '</span></li>
                             <li>' . Carbon::parse($value->created_at)->day . " " . Carbon::parse($value->created_at)->translatedFormat('F') . ", " . Carbon::parse($value->created_at)->year . '</li>
                         </ul>
                     </div>
                 </div>';
                $output .= ' </div>';
            }
            if ($count > 12) {
                $output .= '    <div class="col-lg-12 text-center box-tag-a-view-more-blog">
                                          <a href="#" data-id="' . $idMin . '" class="primary-btn load-btn a-btn-view-more-blog">Xem thêm ' . $remaining . ' bài viết</a>
                                </div>';
            }
            return response()->json(['status' => 200, 'msg' => $output]);
        } else {
            return response()->json(['status' => 202, 'msg' => null]);
        }
    }

    // ================================================

    public function viewMoreBlogNormal($min)
    {
        $output = '';
        $id = $min;
        $data = json_decode(Http::get($this->host . 'api/viewMoreBlogNormal/' . $id));
        $result = $data->result;
        $count = $data->count;
        $remaining = $count - count($result);
        if (count($result) > 0) {
            $arrId = [];
            foreach ($result as $key => $value) {
                $arrId[] = $value->id;
            }
            $idMin = count($arrId) > 0 ? min($arrId) : '';
            foreach ($result as $key => $value) {
                $output .= ' <div class="col-lg-4 col-md-4 col-sm-6">';
                $image_1 = ($value->imagePosts != null) ? $this->host . 'images/posts/' . $value->imagePosts : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png';
                $output .= '      <div class="blog__item">
                     <div class="blog__item__pic large__item set-bg" data-setbg="' . $image_1 . '"></div>
                     <div class="blog__item__text">
                         <h6><a href="/blog/detail/' . $value->cate_posts->slugCatePost . '/' . $value->slugPosts . '.html">' . $value->titlePosts . '</a></h6>
                         <ul>
                             <li>đăng bởi <span>' . $value->author . '</span></li>
                             <li>' . Carbon::parse($value->created_at)->day . " " . Carbon::parse($value->created_at)->translatedFormat('F') . ", " . Carbon::parse($value->created_at)->year . '</li>
                         </ul>
                     </div>
                 </div>';
                $output .= ' </div>';
            }

            if ($data->countMin > 12) {
                $output .= '    <div class="col-lg-12 text-center box-tag-a-view-more-blog">
                                          <a href="#" data-id="' . $idMin . '" class="primary-btn load-btn a-btn-view-more-blog">Xem thêm ' . $remaining . ' bài viết</a>
                                </div>';
            }
            return response()->json(['status' => 200, 'msg' => $output]);
        } else {
            return response()->json(['status' => 202, 'msg' => null]);
        }
    }

    // ==============================================


    public function detail($slug_cate, $slug_title)
    {
        $urlImageBlog = $this->host . 'images/posts/';
        $urlImageProd = $this->host . 'images/';
        $data = json_decode(Http::post($this->host . "api/detailsBlogClient", [
            'slug_cate' => $slug_cate,
            'slug_title' => $slug_title,
        ]));
        $cates = json_decode(Http::get($this->host . 'api/allCateBlogClient'));
        $blogs = json_decode(Http::get($this->host . "api/allBlogsClient"));
        $totalBlog = $blogs->count;
        if ($data->status == 404) {
            return abort(404);
        } else if ($data->status == 200) {
            $datas = $data->msg;
            $related = $data->related;
            $prods = $data->prods;
            $urlLogo = $this->host.'logos';
            $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
            return view('blog.details', compact('datas', 'urlImageBlog', 'cates', 'totalBlog', 'related', 'prods', 'urlImageProd','infos','urlLogo'));
        }
    }

    // ================================================


    public function getBlogByCate($slug = null)
    {
        if (!$slug) {
            return abort(404);
        }
        $urlImageBlog = $this->host . 'images/posts/';
        $data = json_decode(Http::post($this->host . 'api/getBlogByCate', [
            'slug_cate' => $slug
        ]));
        $dataCate = $data->detailC;
        $blogs = $data->result;
        $count = $data->count;
        $remaining = $count - count($blogs);
        $arrId = [];
        foreach ($blogs as $key => $value) {
            $arrId[] = $value->id;
        }
        $idMin = count($arrId) > 0 ? min($arrId) : '';
        $urlLogo = $this->host.'logos';
        $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
        return view('blog.blog-by-cate', compact('urlImageBlog', 'dataCate', 'blogs', 'idMin', 'count', 'remaining','infos','urlLogo'));
    }

    // ================================================


    public function viewMoreBlogByCate($cate,$id)
    {
        $output = '';
        $data = json_decode(Http::get($this->host . 'api/viewMoreBlogByCate/'.$cate.'/'.$id));
        $result = $data->result;
        $count = $data->count;
        $remaining = $count - count($result);
        if (count($result) > 0) {
            $arrId = [];
            foreach ($result as $key => $value) {
                $arrId[] = $value->id;
            }
            $idMin = count($arrId) > 0 ? min($arrId) : '';
            foreach ($result as $key => $value) {
                $output .= ' <div class="col-lg-4 col-md-4 col-sm-6">';
                $image_1 = ($value->imagePosts != null) ? $this->host . 'images/posts/' . $value->imagePosts : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png';
                $output .= '      <div class="blog__item">
                     <div class="blog__item__pic large__item set-bg" data-setbg="' . $image_1 . '"></div>
                     <div class="blog__item__text">
                         <h6><a href="/blog/detail/' . $value->cate_posts->slugCatePost . '/' . $value->slugPosts . '.html">' . $value->titlePosts . '</a></h6>
                         <ul>
                             <li>đăng bởi <span>' . $value->author . '</span></li>
                             <li>' . Carbon::parse($value->created_at)->day . " " . Carbon::parse($value->created_at)->translatedFormat('F') . ", " . Carbon::parse($value->created_at)->year . '</li>
                         </ul>
                     </div>
                 </div>';
                $output .= ' </div>';
            }
            if ($count > 12) {
                $output .= '    <div class="col-lg-12 text-center box-tag-a-view-more-blog-by-cate">
                                          <a href="#" data-id="' . $idMin . '" class="primary-btn load-btn a-btn-view-more-blog-by-cate">Xem thêm ' . $remaining . ' bài viết</a>
                                </div>';
            }
            return response()->json(['status' => 200, 'msg' => $output]);
        } else {
            return response()->json(['status' => 202, 'msg' => null]);
        }
    }
    

    // ================================================

    public function viewMoreBlogByCateNormal($cate,$id)
    {
        $output = '';
        $data = json_decode(Http::get($this->host . 'api/viewMoreBlogByCateNormal/'.$cate.'/'.$id));
        $result = $data->result;
        $count = $data->count;
        $remaining = $count - count($result);
        if (count($result) > 0) {
            $arrId = [];
            foreach ($result as $key => $value) {
                $arrId[] = $value->id;
            }
            $idMin = count($arrId) > 0 ? min($arrId) : '';
            foreach ($result as $key => $value) {
                $output .= ' <div class="col-lg-4 col-md-4 col-sm-6">';
                $image_1 = ($value->imagePosts != null) ? $this->host . 'images/posts/' . $value->imagePosts : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png';
                $output .= '      <div class="blog__item">
                     <div class="blog__item__pic large__item set-bg" data-setbg="' . $image_1 . '"></div>
                     <div class="blog__item__text">
                         <h6><a href="/blog/detail/' . $value->cate_posts->slugCatePost . '/' . $value->slugPosts . '.html">' . $value->titlePosts . '</a></h6>
                         <ul>
                             <li>đăng bởi <span>' . $value->author . '</span></li>
                             <li>' . Carbon::parse($value->created_at)->day . " " . Carbon::parse($value->created_at)->translatedFormat('F') . ", " . Carbon::parse($value->created_at)->year . '</li>
                         </ul>
                     </div>
                 </div>';
                $output .= ' </div>';
            }
            if ($data->countMin > 12) {
                $output .= '    <div class="col-lg-12 text-center box-tag-a-view-more-blog-by-cate">
                                          <a href="#" data-id="' . $idMin . '" class="primary-btn load-btn a-btn-view-more-blog-by-cate">Xem thêm ' . $remaining . ' bài viết</a>
                                </div>';
            }
            return response()->json(['status' => 200, 'msg' => $output]);
        } else {
            return response()->json(['status' => 202, 'msg' => null]);
        }
    }
    // ================================================


    public function blogByTag($tag = null, $id = null)
    {
        $data = json_decode(Http::post($this->host . 'api/tagBlog', [
            'slug' => $tag,
            'id' => $id,
        ]));
        if ($data->status == 404) {
            return abort(404);
        } elseif ($data->status == 200) {
            $urlImageBlog = $this->host . 'images/posts/';
            $datatag = $data->tag;
            $blogs = $data->blog;
            $count = $data->count;
            $remaining = $count - count($blogs);
            $arrId = [];
            foreach ($blogs as $key => $value) {
                $arrId[] = $value->id;
            }
            $idMin = count($arrId) > 0 ? min($arrId) : '';
            $urlLogo = $this->host.'logos';
            $infos = json_decode(Http::get($this->host.'api/infoShopClient'),true);
            return view('blog.tags', compact('urlImageBlog', 'datatag', 'blogs', 'idMin', 'count', 'remaining','infos','urlLogo'));
        }
    }

    // ================================================


    public function viewMoreBlogByTag($tag,$id)
    {
        $output = '';
        $data = json_decode(Http::get($this->host . 'api/viewMoreBlogByTag/'.$tag.'/'.$id));
        $result = $data->blog;
        $count = $data->count;
        $tagD = $data->tag;
        $remaining = $count - count($result);
        if (count($result) > 0) {
            $arrId = [];
            foreach ($result as $key => $value) {
                $arrId[] = $value->id;
            }
            $idMin = count($arrId) > 0 ? min($arrId) : '';
            foreach ($result as $key => $value) {
                $output .= ' <div class="col-lg-4 col-md-4 col-sm-6">';
                $image_1 = ($value->imagePosts != null) ? $this->host . 'images/posts/' . $value->imagePosts : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png';
                $output .= '      <div class="blog__item">
                     <div class="blog__item__pic large__item set-bg" data-setbg="' . $image_1 . '"></div>
                     <div class="blog__item__text">
                         <h6><a href="/blog/detail/' . $value->cate_posts->slugCatePost . '/' . $value->slugPosts . '.html">' . $value->titlePosts . '</a></h6>
                         <ul>
                             <li>đăng bởi <span>' . $value->author . '</span></li>
                             <li>' . Carbon::parse($value->created_at)->day . " " . Carbon::parse($value->created_at)->translatedFormat('F') . ", " . Carbon::parse($value->created_at)->year . '</li>
                         </ul>
                     </div>
                 </div>';
                 $output .= ' </div>';
            }
            if ($count > 12) {
                $output .= '    <div class="col-lg-12 text-center box-tag-a-view-more-blog-by-tag">
                                          <a href="#" data-tag="' . $tagD->id . '" data-id="' . $idMin . '" class="primary-btn load-btn a-btn-view-more-blog-by-tag">Xem thêm ' . $remaining . ' bài viết</a>
                                </div>';
            }
            return response()->json(['status' => 200, 'msg' => $output]);
        } else {
            return response()->json(['status' => 202, 'msg' => null]);
        }
    }

    // ===============================================================

    public function viewMoreBlogByTagNormal($tag,$id)
    {
        $output = '';
        $data = json_decode(Http::get($this->host . 'api/viewMoreBlogByTagNormal/'.$tag.'/'.$id));
        $result = $data->result;
        $count = $data->count;
        $tagD = $data->tag;
        $remaining = $count - count($result);
        if (count($result) > 0) {
            $arrId = [];
            foreach ($result as $key => $value) {
                $arrId[] = $value->id;
            }
            $idMin = count($arrId) > 0 ? min($arrId) : '';
            foreach ($result as $key => $value) {
                $output .= ' <div class="col-lg-4 col-md-4 col-sm-6">';
                $image_1 = ($value->imagePosts != null) ? $this->host . 'images/posts/' . $value->imagePosts : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png';
                $output .= '      <div class="blog__item">
                     <div class="blog__item__pic large__item set-bg" data-setbg="' . $image_1 . '"></div>
                     <div class="blog__item__text">
                         <h6><a href="/blog/detail/' . $value->cate_posts->slugCatePost . '/' . $value->slugPosts . '.html">' . $value->titlePosts . '</a></h6>
                         <ul>
                             <li>đăng bởi <span>' . $value->author . '</span></li>
                             <li>' . Carbon::parse($value->created_at)->day . " " . Carbon::parse($value->created_at)->translatedFormat('F') . ", " . Carbon::parse($value->created_at)->year . '</li>
                         </ul>
                     </div>
                 </div>';
                 $output .= ' </div>';
            }
            if ($data->countMin > 12) {
                $output .= '    <div class="col-lg-12 text-center box-tag-a-view-more-blog-by-tag">
                                          <a href="#" data-tag="' . $tagD->id . '" data-id="' . $idMin . '" class="primary-btn load-btn a-btn-view-more-blog-by-tag">Xem thêm ' . $remaining . ' bài viết</a>
                                </div>';
            }
            return response()->json(['status' => 200, 'msg' => $output]);
        } else {
            return response()->json(['status' => 202, 'msg' => null]);
        }
    }
}
