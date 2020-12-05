<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class GroupMenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('user.control');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $group_id = $request->group_id;
        if(!empty($group_id)){
            $groups = DB::table('group_master')->select('group_id','group_name')->get();
            $menu = DB::table('group_menu_items')
                    ->leftJoin('menu_child as mc','group_menu_items.menuchild_id', 'mc.menuchild_id')
                    ->leftJoin('menu_master as mm','mm.menu_id', 'mc.menu_id')
                    ->where('group_menu_items.group_id', $group_id)
                    ->select('mm.menu_name', 'mc.child_name', 'mc.menuchild_id')
                    ->get();
                    // ->limit($request->limit)
                }
                else{
                    $groups = DB::table('group_master')->select('group_id','group_name')->get();
                    $menu = array();
                }
                
        return view('groupmenu.index', compact('groups', 'menu', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
