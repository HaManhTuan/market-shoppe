<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductManagerController extends Controller
{
    public function index()
    {
        $getPro = Product::orderBy('created_at','DESC')->with('product_image','category','brand','user')->get();
        return view('superAdmin.product.list', compact('getPro'));
    }

    public function detailPro(Request $req)
    {
        $detailPro = Product::where('id', $req->id)->with('product_image','category','brand','user')->first();
        $body = '';
        $body .='
            <table class="table table-bordered">
                <tr>
                    <td style="width: 100px">Danh mục</td>
                    <td>'.$detailPro->category->name.'</td>
                </tr>
                <tr>
                    <td style="width: 100px">Hãng</td>';
        if($detailPro->brand_id == 0) {
            $body .=' <td>Không</td>';
        } else {
            $body .=' <td>'.$detailPro->brand->name.'</td>';
        }

        $body .=' </tr>
                <tr>
                    <td style="width: 100px">Lượt xem</td>
                    <td>'.$detailPro->count_view.'</td>
                </tr>';

        $body .= '
                <tr>
                    <td style="width: 100px">Gian hàng</td>
                    <td>'.$detailPro->user->name_display.'</td>
                </tr>
                <tr>
                    <td style="width: 100px">Trạng thái</td>
        ';
        if($detailPro->status = 1) {
            $body .= '<td><span class="badge badge-success">Hiện</span></td>';
        } else {
            $body .= '<td><span class="badge badge-danger">Ẩn</span></td>';
        }

        $body .='
                </tr>
            </table>
        ';
        $msg = array(
            'product_name'  => $detailPro->name,
            'body'  => $body,
          );

          return json_encode($msg);
    }
}
