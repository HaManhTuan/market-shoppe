<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductImage;
use App\Model\Brand;
use App\Http\Requests\StoreProduct;
use Auth;
class ProductController extends Controller
{
    public function viewpro()
    {
        if (!Gate::allows('add_product') || !Gate::allows('edit_product') || !Gate::allows('delete_product'))
        {
            return view('backend.errors.401');
        }
        $products = Product::with('category')->orderBy('created_at', 'asc')
            ->get();
        $data_send = ['products' => $products];
        return view('backend.product.list')->with($data_send);
    }
    public function add()
    {
        if (!Gate::allows('add_product'))
        {
            return view('backend.errors.401');
        }
        $dataBrand = Brand::get();
        $categoryController = new CategoryController();
        $data_select = $categoryController->getDataSelect(0, '', '');
        $data_send = ['categoryData' => $data_select,'dataBrand' => $dataBrand ];
        return view('backend.product.add')->with($data_send);
    }
    public function addpro(StoreProduct $req)
    {
        if (!Gate::allows('add_product'))
        {
            return view('backend.errors.401');
        }
        $validated = $req->validated();
        $request = $req->all();
        //print_r($request);
        $request['name'] = $req->name;
        $slug = Str::slug($req->name, '-');
        $request['url'] = $slug;
        $request['category_id'] = $req->category_id;
        $request['description'] = $req->description;
        $request['content'] = $req->content;
        $price = (int)preg_replace("/[\,\.]+/", "", $req->price);
        $promotional_price = (int)preg_replace("/[\,\.]+/", "", $req->promotional_price);
        $request['sale'] = parent::sale($promotional_price, $price);
        $request['price'] = $price;
        $request['author_id'] = Auth::id();
        $request['promotional_price'] = $promotional_price;
        $request['stock'] = $req->stock;
        $request['brand_id'] = $req->brand_id;
        $request['status'] = $req->has('status') ? '1' : '0';
        $target_save = "public/uploads/images/products/";

        if ($req->hasFile('file'))
        {
            $file = $req->file('file');
            $name = $file->getClientOriginalName();
            $image = Str::random(4) . "_" . $name;
            while (file_exists("public/uploads/images/products/" . $image))
            {
                $image = Str::random(4) . "_" . $name;
            }
            $file->move("public/uploads/images/products", $image);
            $request['image'] = $image;
        }
        else
        {
            $request['image'] = "";
        }

        //$query = Product::create($request);
        if (Product::create($request))
        {
            return redirect('admin/product/view-product')->with('flash_message_success', 'Bạn đã thêm mới sản phẩm thành công');
        }
        else
        {
            return redirect('admin/product/view-product')
                ->with('flash_message_error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }
    public function delpro(Request $req)
    {
        $id = $req->id;
        $img_product = ProductImage::where(['product_id' => $id])->get()
            ->toArray();
        if (isset($img_product))
        {
            $DeleteImages = ProductImage::where(['product_id' => $id])->delete();
            foreach ($img_product as $value)
            {
                unlink('public/uploads/images/products/' . $value['img']);
            }
        }
        
        $avatar = Product::where(['id' => $id])->first();
        if ($avatar->image != "")
        {
            if (file_exists('public/uploads/images/products/' . $avatar->image))
            {
                unlink('public/uploads/images/products/' . $avatar->image);
            }
        }

        if (Product::destroy($id))
        {
            $msg = array(
                'status' => '_success',
                'msg' => 'Một mục đã được xóa',
            );
            return json_encode($msg);
        }
        else
        {
            $msg = array(
                'status' => '_error',
                'msg' => 'Có lỗi xảy ra. Vui lòng thử lại',
            );
            return json_encode($msg);
        }
    }
    public function editpro(Request $req, $url)
    {
        if (!Gate::allows('edit_product'))
        {
            return view('backend.errors.401');
        }
        $dataBrand = Brand::get();
        $product_detail = Product::where(['url' => $url])->first();
        $categoryController = new CategoryController();
        $data_select = $categoryController->getDataSelect(0, '', $product_detail->category_id);
        $category_detail = Category::where(['id' => $product_detail
            ->category_id])
            ->first();
        $category_name = $category_detail->name;
        $data_send = ['product_detail' => $product_detail, 'category_name' => $category_name, 'data_select' => $data_select,'dataBrand' => $dataBrand];
        if ($req->isMethod('post'))
        {
            //print_r($req->all());
            $request = $req->all();
            $request['name'] = $req->name;
            $slug = Str::slug($req->name, '-');
            $request['url'] = $slug;
            $request['category_id'] = $req->category_id;
            $request['description'] = $req->description;
            $request['content'] = $req->content;
            $request['stock'] = $req->stock;
            $price = (int)preg_replace("/[\,\.]+/", "", $req->price);
            $promotional_price = (int)preg_replace("/[\,\.]+/", "", $req->promotional_price);
            $request['sale'] = parent::sale($promotional_price, $price);
            $request['price'] = $price;
             $request['brand_id'] = $req->brand_id;
            $request['promotional_price'] = $promotional_price;
            $request['status'] = $req->has('status') ? '1' : '0';
            $target_save = "public/uploads/images/products/";
            if ($req->hasFile('file'))
            {
                $file = $req->file('file');
                $name = $file->getClientOriginalName();
                $image = Str::random(4) . "_" . $name;
                while (file_exists("public/uploads/images/products/" . $image))
                {
                    $image = Str::random(4) . "_" . $name;
                }
                $file->move("public/uploads/images/products", $image);
                $request['image'] = $image;
                if (file_exists($req->old_file) && $req->old_file != '')
                {
                    unlink("public/uploads/images/products/" . $req->old_file);
                }

            }
            else
            {
                $request['image'] = $req->old_file;
            }
            $request['author_id'] = Auth::id();
            //$query = $product_detail->update($request);
            if ($product_detail->update($request))
            {
                return redirect('admin/product/view-product')->with('flash_message_success', 'Bạn đã sửa sản phẩm thành công');
            }
            else
            {
                return redirect('admin/product/view-product')
                    ->with('flash_message_error', 'Có lỗi xảy ra vui lòng thử lại');
            }

        }
        return view('backend.product.edit')
            ->with($data_send);
    }
    public function addimg(Request $req, $url)
    {
        $product_detail = Product::where(['url' => $url])->first();
        $id = $product_detail->id;
        if ($req->isMethod('post'))
        {
            $data = $req->all();
            if ($req->hasFile('file'))
            {
                $files = $req->file('file');
                foreach ($files as $file)
                {
                    // Upload Images after Resize
                    $image = new ProductImage();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $file->move("public/uploads/images/products", $fileName);
                    $image->img = $fileName;
                    $image->product_id = $id;
                    $image->save();
                }
            }
            return redirect('admin/product/add-image/' . $url)->with('flash_message_success', 'Ảnh sản phẩm đã được thêm');
        }
        $product_img = ProductImage::where(['product_id' => $id])->orderBy('id', 'DESC')
            ->get();
        $data_send = ['product_detail' => $product_detail, 'product_img' => $product_img];
        return view('backend.product.img')->with($data_send);
    }
    public function deimg(Request $req)
    {
        $id = $req->id;
        $length = $req->length;
        $id_array = explode(",", $id);
        $img_del_qr = ProductImage::whereIn('id', $id_array)->first();

        if (ProductImage::destroy($id_array))
        {
            unlink("public/uploads/images/products/" . $img_del_qr->img);
            $msg = ['status' => '_success', 'msg' => $length . ' mục đã được xóa.'];
            return response()->json($msg);
        }
        else
        {
            $msg = ['status' => '_error', 'msg' => 'Có lỗi xảy ra. Vui lòng thử lại.'];
            return response()->json($msg);
        }
    }
}

