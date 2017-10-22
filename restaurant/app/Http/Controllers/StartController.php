<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Message;
use App\Models\TypeMenu;
use App\Models\Menu;
use App\Models\Combo;
use App\Models\News;
use App\Models\Comments;

class StartController extends Controller
{
	public function khuyenmai() {
		$news = News::where('type_id', '=', 1)->paginate(1);
        return view('start/khuyenmai', compact('news'));
    }
	public function getHome()
	{
		return view('layout/index');
	}
	public function getMenu()
	{
		$menus = Menu::select('id', 'name', 'content', 'image', 'price')->where(empty('content'))->paginate(4)
					->where(!empty('content'))->paginate(4);
		return view('start.menu', compact('menus'));
	}
	public function danhsachmonan($id)
	{
		$menus = Menu::select('id', 'name', 'content', 'image', 'price', 'id_type')->where('id_type', $id)->paginate(6);
					
		//$combo = Combo::select('id', 'name', 'image', 'content', 'price')->paginate(4);
		//return view('start.menu', ['menus'=>$menus, 'combo' => $combo]);
		return view('start.menu', compact('menus'));
	}
	public function getIntro()
	{
		$news = News::where('type_id', '=', 2)->paginate(1);
		return view('start/intro', compact('news'));
	}
	public function getMessage() 
	{
		return view('layout.index');
	}
	public function postMessage (Request $request)
	{
		$this->validate($request, [
			'name'=>'required',
			'phone'=>'required',
			'email'=>'required',
			'msg'=>'required',
		]);
		$message = new Message();
		$message->name = $request->name;
		$message->phone = $request->phone;
		$message->email = $request->email;
		$message->message = $request->msg;
		$message->save();
		return Redirect('/');
	}
	public function getNews () {
		
		$news = News::select('id', 'alias', 'title', 'summary', 'image', 'content', 'created_at')->orderBy('created_at', 'ASC')->paginate(4);
		return view('start.news', compact('news'));
	}
	public function getDetailNews ($id) {
		$new = News::where('id', $id)->first();
		$comments = DB::table('comments')
					->select('comments.author', 'comments.comment', 'comments.date', 'comments.news_id', 'news.id')
					->leftJoin('news', 'comments.news_id', '=', 'news.id')
					->orderBy('comments.date', 'ASC')
					->get();
		
		return view('start.detailNews', compact('new', 'comments'));
	}
	public function getComment() {
		
		return view('layout.detailNews');
	}
	public function postComment (Request $request) {
		$this->validate($request, [
			'author' => 'required',
			'email' => 'required',
			'comment' => 'required',
		]);
		$comment = new Comments();
		$comment->author = $request->author;
		$comment->email = $request->email;
		$comment->comment = $request->comment;
		$comment->news_id = $request->news_id;
		$comment->save();
		return Redirect()->back();
	}
}
