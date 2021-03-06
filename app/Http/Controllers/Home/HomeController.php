<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductImage;
use App\Model\Province;
use App\Model\District;
use App\Model\Ward;
use App\Model\Contact;
use App\Model\Media;
use App\User;
use App\Model\Comment;
use App\Model\Brand;
use App\Model\Events;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use View;

class HomeController extends Controller
{
    public function __construct()
    {
        $dataBrand = Brand::orderBy('created_at','ASC')->get();
        View::share(['dataBrand' => $dataBrand]);
    }

    public function index()
    {
        $media = Media::find(1);
        $recomendPro = Product::where('status', 1)->with('product_image')->orderBy('created_at','DESC')->get();
        $salePro = Product::where('status', 1)->with('product_image')->where('sale','!=', 0)->orderBy('created_at','DESC')->get();
        $productNew = Product::where('status', 1)->orderBy('created_at','DESC')->paginate(15);
        $EventNew = Events::where('status', 1)->orderBy('created_at','DESC')->whereDate('start_date','>=',Carbon::now())->whereDate('end_date','>=',Carbon::now())->get();
        return view('frontend.home')->with(['productNew' => $productNew,'recomendPro' => $recomendPro, 'salePro' => $salePro, 'media' => $media,'EventNew'=>$EventNew]);
    }

    public function product ($url)
    {

        $dataTop4News = Product::orderBy('created_at','ASC')->paginate(4);
        $dataNews = Product::orderBy('created_at','ASC')->paginate(16);
        $dataPro = Product::where('url',$url)->with('user','brand')->first();
        $dataCmt = Comment::where('product_id', $dataPro->id)->where('status', 1)->with('customer')->get();
        $author_id = $dataPro->user->id;
        $countPro =  Product::where('author_id', $author_id)->count();
        $dataPro->increment('count_view');
        $nameCate = Category::where('id',$dataPro->category_id)->first();
        $dataCate = Category::with('categories')->where('id',$nameCate->id)->first();
        $dataImage = ProductImage::where('product_id',$dataPro->id)->get();
        $dataReleast = Product::where('category_id',$nameCate->id);
        $data_send = ['countPro' => $countPro,'nameCate' => $nameCate, 'dataPro' => $dataPro,'dataCate' => $dataCate,'dataTop4News' => $dataTop4News, 'dataImage' => $dataImage, 'dataReleast' => $dataReleast, 'dataNews' => $dataNews, 'dataCmt' => $dataCmt];
        return view('frontend.detail')->with($data_send);
    }

    public function category($url){
        $dataCate = Category::with('categories')->where('url',$url)->first();
        return view('frontend.category', compact('dataCate', $dataCate));
    }

    public function filter(Request $req, $url){
        $cate_data = Category::where('url', $url)->first();
        $idin[]    = $cate_data->id;
        $cate_in   = Category::where('parent_id', $cate_data->id)->get();
        foreach ($cate_in as $item) {
            if (in_array($item->id, $idin) == false) {
                $idin[] = $item->id;
            }
        }
        $query = Product::whereIn('category_id', $idin);
         if(isset($req->minimum_price, $req->maximum_price) && !empty($req->minimum_price) && !empty($req->maximum_price)){
          $query = $query->whereBetween('price',[$req->minimum_price, $req->maximum_price]);
         }
         if(isset($req->brand) && !empty($req->brand)){
          $query = $query->where('brand_id',$req->brand);
         }
        $query = $query->get();
        $output = '';
        $script = '';
        $item = count($query);
        if (count($query) > 0) {
              $script .='<script>
              jQuery(document).ready(function($) {
                  $("#myList li:lt(9)").show();
                  var items =  '.$item.';
                  $("#loadMore").click(function () {
                      shown = $("#myList li:visible").size()+9;
                      if(shown< items) {$("#myList li:lt("+shown+")").show();}
                      else {
                      $("#myList li:lt("+items+")").show();
                      $("#loadMore").hide();
                     }
                  });
              });
              </script>';
        }

        if (count($query) > 0) {

          foreach($query as $row)
          {
           $output .= '<li class="col-sx-12 col-sm-4" id="loadmore" style="display: none;">
                                <div class="product-container">
                                    <div class="left-block">
                                        <a href="'.url('san-pham').'/'.''.$row->url.'">
                                            <img class="img-responsive" alt="product" src="'.asset('uploads/images/products/').'/'.''.$row['image'].'" />
                                        </a>
                                        <div class="add-to-cart">
                                            <a title="Add to Cart" class="addTocart" data-id="'.$row['id'].'" data-name="'.$row['name'].'" data-quantity="1"
                                            ';
                                            if($row['promotional_price'] > 0 ){
                                                $output .='data-price="'.$row['promotional_price'].'"';
                                            } else {
                                                $output .='data-price="'.$row['price'].'"';
                                            }
                                            $output .='
                                             data-avatar="'.$row['image'].'" data-url="'.$row['url'].'" data-product_id="'.$row['id'].'" data-action="'.url('/add-cart').'">Mua ngay</a>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <h5 class="product-name"><a href="'.url('san-pham').'/'.''.$row->url.'">'.$row['name'].'</a></h5>
                                        <div class="content_price">';
                                        if ($row['promotional_price'] > 0) {
                                            $output .= '<span class="price product-price">'.number_format($row['promotional_price']).'</span>';
                                            $output .= '<span class="price old-price">'.number_format($row['price']).'</span>';
                                        }
                                        else{
                                            $output .= '<span class="price product-price">'.number_format($row['price']).'</span>';
                                        }
                                        $output .= '</div>
                                    </div>
                                </div>
                            </li>
                           ';
          }

        }
        else
       {
        $output = '<h3 style="text-align: center; margin-top:25px; ">Kh??ng c?? d??? li???u</h3>';
       }
       $data_send = ['output' => $output, 'script' => $script];
        return response()->json($data_send);
       }

    public function contactProduct()
    {
       $provine = Province::all();
       return view('frontend.signup_product', compact('provine'));
    }

    public function getDistrict($id)
    {

        $output = '';
        $output .= '<option value="" selected disabled>--Ch???n Qu???n/Huy???n--</option>';
        $district = District::where('province_id', $id)->get();
        if (count($district) > 0) {
            foreach($district as $row)
            {
             $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
        }
        $data_send = ['body' => $output,'id' => $district];
        return response()->json($data_send);
    }

    public function getWard($id)
    {

        $output = '';
        $output .= '<option value="" selected disabled>--Ch???n Ph?????ng/X??--</option>';
        $district = Ward::where('district_id', $id)->get();
        if (count($district) > 0) {
            foreach($district as $row)
            {
             $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
        }
        $data_send = ['body' => $output,'id' => $district];
        return response()->json($data_send);
    }

    public function postSignUpPro(Request $req)
    {
        $checkEmail = User::where('email', $req->email)->count();
        if ($checkEmail > 0) {
          $msg = [
            'status' => '_error',
            'msg'    => 'Email n??y ???? t???n t???i. Vui l??ng nh???p email kh??c
            '
          ];
          return response()->json($msg);
        } else {
            $user = new User();
            $user->name = $req->name_re;
            $user->email = $req->email_re;
            $user->phone = $req->phone;
            $user->password = Hash::make($req->password);
            $user->address = $req->address;
            $user->admin = 0;
            $user->province_id = $req->province_id;
            $user->district_id = $req->district_id;
            $user->ward_id = $req->ward_id;
            if ($user->save()) {
                $msg = [
                'status' => '_success',
                'msg'    => '????ng k?? t??i kho???n th??nh c??ng
                '
                ];
                return response()->json($msg);
            } else {
                $msg = [
                'status' => '_error',
                'msg'    => 'L???i
                '
                ];
                return response()->json($msg);
            }
        }
    }

    public function search(Request $req)
    {
       $key = $req->key;
       $id_cate = [];
       $dataSearch = Product::where('name','LIKE','%'.$req->key.'%')->paginate(12);
       if($dataSearch && count($dataSearch) == 0) {
         $idCate = Category::where('name','LIKE','%'.$req->key.'%')->pluck('id')->toArray();
         foreach ($idCate as $value) {
            $id_cate [] = $value;
         }

         //array_push($id_cate, $idCate);
         $dataCate = Category::whereIn('id', $idCate)->with('categories')->get();
         if(isset($dataCate)) {
            foreach($dataCate as $value){
                if(count($value->categories) > 0){
                    foreach($value->categories as $item) {
                        if (in_array($item->id, $id_cate) == false) {
                            $id_cate[] = $item->id;
                        }
                    }
                }
            }
            $dataSearch = Product::whereIn('category_id', $id_cate)->paginate(12);
         }
       }
       $data_send = ['dataSearch' => $dataSearch,
       'key' => $req->key];
       return view('frontend.search')->with($data_send);
    }

    public function shop($id)
    {
        $userData = User::find($id);
        $dataPro = Product::where('author_id', $id)->with('user')->paginate(24);
        return view('frontend.shop', compact('dataPro','userData'));
    }

    public function contact()
    {
       return view('frontend.contact');
    }
    public function contactpost(Request $req){
       $query = Contact::create($req->all());
       if ( $query) {
          $msg = [
           'status' => '_success',
           'msg'    => 'C???m ??n b???n ???? li??n h??? v???i ch??ng t??i
           '
         ];
         return response()->json($msg);
       }
       else
       {
          $msg = [
           'status' => '_error',
           'msg'    => 'L???i. Vui l??ng th??? l???i sau
           '
         ];
         return response()->json($msg);
       }
    }

    public function comment(Request $req)
    {
        $cmt = Comment::create(
            [
                'product_id' => $req->product_id,
                'customer_id' => $req->customer_id,
                'content' => $req->content
            ]
            );

        if($cmt ) {
            return redirect('san-pham/'.$req->product_url);
        }
        else {
            return redirect('san-pham/'.$req->product_url);
        }
    }
}
