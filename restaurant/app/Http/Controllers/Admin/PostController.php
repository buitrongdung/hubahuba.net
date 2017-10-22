<?php

namespace App\Http\Controllers\Admin;

use Dropbox\Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\News;
use DB, Hash;
use Input, Auth, File;

class PostController extends Controller
{
    public function __construct()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $this->middleware('auth');
    }
    public function listNews () {
        $news = News::select('id', 'alias', 'title', 'summary', 'content', 'created_at')->orderBy('created_at', 'desc')->get();
        return view('admin.news.listNews', compact('news'));
    }
    public function createNews () {
        return view('admin.news.createNews');
    }
    function sanitizeTitle($string) {
        if(!$string) return false;
        $utf8 = array(
                'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'd'=>'đ|Đ',
                'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
                'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                );
        foreach($utf8 as $ascii=>$uni) $string = preg_replace("/($uni)/i",$ascii,$string);
        $string = $this->utf8Url($string);
        return $string;
    }
 
    function utf8Url($string){        
        $string = strtolower($string);
        $string = str_replace( "ß", "ss", $string);
        $string = str_replace( "%", "", $string);
        $string = preg_replace("/[^_a-zA-Z0-9 -]/", "",$string);
        $string = str_replace(array('%20', ' '), '-', $string);
        $string = str_replace("----","-",$string);
        $string = str_replace("---","-",$string);
        $string = str_replace("--","-",$string);
        return $string;
    }    
    public function storeNews (Request $request) {
        $this->validate ($request, [
            'title' => 'required',
            'content' => 'required'
            ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'content.required' => 'Vui lòng nhập nội dung bài viết'
        ]);
        $logo = $request->file('image');
        $upload = 'images/post';
        $filename = $logo->getClientOriginalName();
        $success = $logo->move($upload,$filename);

        $news = new News();
        $news->title = $request->title;
        $news->image = $filename;
        $news->alias = $this->sanitizeTitle($request->title);
        $news->summary = $request->summary;
        $news->content = $request->content;
        $news->tag = $request->tag;
        $news->show_hide = 1;
        $news->type_id = $request->type_id;
        $news->save();
        return redirect()->route('admin.post.listNews');
    }
    public function edit ($id) {
        $new = News::where('id', $id)->firstOrFail();
        return view('admin.news.editNews', compact('new'));
    }
    public function update (Request $request, $id) {
        $title = Input::get('title');
        $summary = Input::get('summary');
        $content = Input::get('content');
        $alias = $this->sanitizeTitle(Input::get('title'));
        try {
            News::where('id', $id)->update(['alias' => $alias, 'title' => $title, 'summary' => $summary, 'content' => $content]);
            return redirect()->route('admin.post.listNews');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
    }
    public function destroy ($id) {
        $newImg = News::find($id);
        File::delete('images/post/' . $newImg['image']);
        News::where('id', $id)->delete();
        return redirect()->route('admin.post.listNews');
    }

}
