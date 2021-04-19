<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Contact;
class ContactController extends Controller
{
  public function view()
  {
    $dataContact = Contact::orderBy('id','ASC')->get();
    return view('backend.contact.list', compact('dataContact', $dataContact));
  }
  public function modal(Request $req)
  {
    $id = $req->id;
    $contact_data = Contact::where('id', $id)->first();
    $data = '
      <div class="form-group mb-3">
        <label for="title" class="control-label">Tên <font color="#a94442">(*)</font></label>
        <input type="text" class="form-control" id="title" readonly name="title" value="' . $contact_data->name . '" />
      </div>
      <div class="form-group mb-3">
        <label for="title" class="control-label">Số điện thoại <font color="#a94442">(*)</font></label>
        <input type="text" class="form-control" id="title" readonly name="title" value="' . $contact_data->phone . '" />
      </div>
      <div class="form-group mb-3">
        <label for="title" class="control-label">Email <font color="#a94442">(*)</font></label>
        <input type="text" class="form-control" id="title" readonly name="title" value="' . $contact_data->email . '" />
      </div>
      <div class="form-group mb-3">
        <label for="title" class="control-label">Message  <font color="#a94442">(*)</font></label>
        <textarea name="" class="form-control" readonly>' . $contact_data->message . '</textarea>
        
      </div>
      ';
        $msg = array(
            'body' => $data,
        );

        return json_encode($msg);
  }
}
