<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Model\Events;
use App\Model\Category;
use Illuminate\Http\Request;

class EventManagerController extends Controller
{
    public function getDataSelect($parent_id = 0, $char = '', $current_id = '')
    {
        $category_data = Category::orderBy('id', 'asc')->get();
        $data_select = '';
        foreach ($category_data as $category_item)
        {
            if ($category_item['parent_id'] == $parent_id)
            {
                if ($current_id != "")
                {
                    if ($category_item['id'] == $current_id || $category_item['parent_id'] == $current_id)
                    {
                        $selected = "selected='selected'";
                    }
                    else
                    {
                        $selected = "";
                    }
                }
                else
                {
                    $selected = "";
                }
                $data_select .= '<option value="' . $category_item['id'] . '" ' . $selected . '>';
                $data_select .= $char . $category_item['name'];
                $data_select .= '</option>';
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $data_select .= $this->getDataSelect($category_item['id'], $char . "|---", $current_id);
            }
        }
        return $data_select;
    }
    public function index()
    {
        $data_event = Events::orderBy('created_at','DESC')->get();
        $data_select = $this->getDataSelect(0);
        $data_send = [
            'data_event' => $data_event,
            'categoryData' => $data_select,
        ];
         return view('superAdmin.event.view')->with($data_send);
    }

    public function add(Request $req)
    {
        $events = Events::create([
            'description' => $req->description ? $req->description : null,
            'category_id' => $req->category_id ? $req->category_id : null,
            'discount' => $req->discount ? $req->discount : null,
            'start_date' => $req->start_date ? $req->start_date : null,
            'end_date' => $req->end_date ? $req->end_date : null
        ]);
        if($events) {
            return redirect('manager/events/view-events')->with('flash_success', 'Thêm thành công');
        } else {
            return redirect('manager/events/view-events')->with('flash_error', 'Lỗi. Vui lòng thử lại');
        }
    }
    public function change($id)
    {
        $data_comment = Events::where('id', $id)->first();
        if($data_comment->status == 1){
            $data_comment->status = 0;
            $data_comment->save();
            return redirect('manager/events/view-events');
        } else {
            $data_comment->status = 1;
            $data_comment->save();
            return redirect('manager/events/view-events');
        }
    }
}
