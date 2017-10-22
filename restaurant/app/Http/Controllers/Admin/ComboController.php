<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Combo;
use DB;
use Input;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combos = Combo::select('id', 'image', 'name', 'content', 'price')->get();
        return view('admin.combo.listcombo', compact('combos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.combo.addcombo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
            'content' => 'required',
            'price' => 'required',
        ]);
        $logo = $request->file('image');
        $upload = 'images/combo';
        $filename = $logo->getClientOriginalName();
        $success = $logo->move($upload,$filename);

        $table = new Combo();
        $table->image = $filename;
        $table->name = $request->name;
        $table->content = $request->content;
        $table->price = $request->price;
        $table->save();      
        return redirect()->route('admin.combo.list');

    }

    // *
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
     
    // public function show($id)
    // {
    //     $emp = Employer::where('id_employer', $id)->firstOrFail();
    //     return view('admin.employer.inforemployer', compact('emp'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
        $combo = Combo::where('id', $id)->firstOrFail();
        return view('admin.combo.editcombo', ['combo' => $combo]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        try {
            //var_dump($id);
            /*$menu = Menu::where('id_menu', $id)->find($id);
            $menu->name = $request->name;
            $menu->price = $request->price;
            //dd(count($menu));
            //dd($menu);
            $menu->save();*/
            Combo::where('id', $id)->update($request->except('_method', '_token', 'editCombo'));
            return redirect()->route('admin.combo.list');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        DB::table('combo')->where('id', $id)->delete();
        return redirect()->route('admin.combo.list');
    }
}
