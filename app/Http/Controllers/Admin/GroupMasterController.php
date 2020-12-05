<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupMaster;

class GroupMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groupmaster = GroupMaster::leftJoin('application_master as am', 'group_master.application_id', 'am.application_id')->get();
        return view('groupmaster.index', ['groupmaster' => $groupmaster, 'request' => $request]);
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
        $group = GroupMaster::where('group_id', $id)->leftJoin('application_master as am', 'group_master.application_id', 'am.application_id')->first();
        // return $group->toArray();
        $applications = \DB::table('application_master')->get();
        return view('groupmaster-edit', ['group' => $group,  'applications' => $applications]);
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
        $response = GroupMaster::find($id)->update([
            'application_id' => $request->application_id,
            'group_name' => $request->group_name,
            'isactive' => $request->isactive,
        ]);
        
        if($response){
            return back()->with(['message' => 'user data updated', 'type' => 'success']);
        }
        else{
            return back()->with(['message' => 'something went wrong please try again later', 'type' => 'success']);
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
        //
    }
}
