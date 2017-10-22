<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Drink;
use App\Models\Service;
use DB, Auth;
use Input;
use File;
use App\Models\TypeMenu;


class MenuController extends Controller
{
    public function __construct()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $this->middleware('auth');
    }
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::select('id', 'name', 'image', 'price', 'id_type')->paginate(10);
        $show = DB::table('type_menu')
                ->select('type_menu.name', 'type_menu.id')
                ->join('menu', 'type_menu.id', '=', 'menu.id_type')
                ->where('type_menu.id', '=', 'menu.id_type')
                ->get();
        return view('admin.menu.listmenu', compact('menus', 'show'));     
    }
    public function listByType($id)
    {
        $menus = Menu::select('id', 'name', 'image', 'price', 'id_type')->where('id_type', $id)->paginate(10);
        return view('admin.menu.listmenu', compact('menus'));
    }
    public function create()
    {
        $menus = TypeMenu::orderBy('id', 'name')->get();
        return view('admin.menu.addmenu', compact('menus'));
    }
    public function store(Request $request)
    {
        $logo = $request->file('image');
        $upload = 'images/menu';
        $filename = $logo->getClientOriginalName();
        $success = $logo->move($upload,$filename);

        $table = new Menu();
        $table->id_type = $request->menus = implode(',', Input::get('menus'));
        $table->name = $request->name;
        $table->image = $filename;
        $table->price = $request->price;
        $table->content = $request->content;
        $table->save();
        return redirect()->route('admin.menu.list');
    }
    public function edit($id)
    {
        $menu = Menu::where('id', $id)->firstOrFail();
        return view('admin.menu.editmenu', ['menu' => $menu]);
    }
    public function update(Request $request, $id) {
        try {
            //var_dump($id);
            /*$menu = Menu::where('id_menu', $id)->find($id);
            $menu->name = $request->name;
            $menu->price = $request->price;
            //dd(count($menu));
            //dd($menu);
            $menu->save();*/
            Menu::where('id', $id)->update($request->except('_method', '_token', 'editMenu'));
            return redirect()->route('admin.menu.list');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $MenuImage = Menu::find($id);
            File::delete('images/menu/' . $MenuImage['image']);
        DB::table('menu')->where('id', $id)->delete();
        return redirect()->route('admin.menu.list');
    }
}
