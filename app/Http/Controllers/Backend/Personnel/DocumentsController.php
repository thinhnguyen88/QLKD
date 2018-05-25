<?php

namespace App\Http\Controllers\Backend\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
class DocumentsController extends Controller{

    public function getIndex(){
        $document = DB::table('document')->select('document_name','id','document_slug')->get();
        return view('backend.personnel.document',compact('document'));
    }

    public function getDetail($detail){
        $document_detail = DB::table('document')->where('document_slug',$detail)->select('document_content','document_name')->first();
        return view('backend.personnel.document_detail',compact('document_detail'));
    }

    public function getAdd(){
        return view('backend.personnel.add_document');
    }

    public function postAdd(Request $request){

        $validator = Validator::make($request->all(), ['document' => 'max:255|unique:document,document_name']);

        $validator->setAttributeNames([
            'document' => 'Tên biểu mẫu',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            DB::table('document')->insert(
                ['document_name' => $request->document, 'document_content' => $request->description,'document_slug' => str_slug($request->document)]
            );
            return redirect('admin/personnel/documents')->withFlashSuccess('Thêm biểu mẫu thành công.');
        }

    }

    public function getEdit(Request $request){
        $document_edit = DB::table('document')->where('id', $request->id)->first();
        return view('backend.personnel.edit_document',compact('document_edit'));
    }

    public function postEdit(Request $request){

        $validator = Validator::make($request->all(), ['document' => 'max:100|unique:document,document_name,'.$request->id]);

        $validator->setAttributeNames([
            'document' => 'Tên biểu mẫu',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            DB::table('document')->where('id',$request->id)->update(['document_name' => $request->document, 'document_content' => $request->description, 'document_slug' => str_slug($request->document)]);
            return redirect('admin/personnel/documents')->withFlashSuccess('Sửa biểu mẫu thành công.');
        }
    }

    public function getDelete(Request $request)
    {
        DB::table('document')->where('id', $request->id)->delete();
        return redirect('admin/personnel/documents');
    }

}