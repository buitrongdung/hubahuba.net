<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Home;
use DB, Auth;
use Input, File;

class HomeController extends Controller
{
    public function __construct()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $this->middleware('auth');
    }
    public function index()
    {
        $home = Home::select('id', 'name', 'type', 'image', 'content', 'created_at')->get();
        return view('admin.home.listhome', compact('home'));     
    }
    public function create()
    {
        return view('admin.home.addhome');
    }
    public function store(Request $request)
    {
        $logo = $request->file('image');
        $upload = 'images';
        $filename = $logo->getClientOriginalName();
        $success = $logo->move($upload,$filename);

        $table = new Home();
        $table->name = $request->name;
        $table->image = $filename;
        $table->type = $request->type; 
        $table->content = $request->content;        
        $table->save();
        return redirect()->route('admin.home.list');
    }
    public function edit($id)
    {
        $item = Home::where('id', $id)->firstOrFail();
        return view('admin.home.edithome', ['item' => $item]);
    }
    public function update(Request $request, $id)
    {
        try {
            //var_dump($id);

            $home = Home::where('id', $id)->find($id);
            $home->name = $request->name;
            $home->content = $request->content;
            $home->type = $request->type;
            //dd(count($menu));
            //dd($menu);
            $home->save();
            Home::where('id', $id)->update($request->except('_method', '_token', 'updateHome'));
            return redirect()->route('admin.home.list');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
    }
    public function destroy($id)
    {
        $homeImg = Home::find($id);
        File::delete('images/' .$homeImg['image']);
        DB::table('home')->where('id', $id)->delete();
        return redirect()->route('admin.home.list');
    }
}
