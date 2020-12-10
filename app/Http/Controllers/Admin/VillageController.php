<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\District;
use App\Exports\VillageExport;
use App\Models\State;
use App\Models\Block;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Village;
use Auth;
use Jenssegers\Optimus\Optimus;
use Illuminate\Support\Facades\Input;


class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Optimus $opt)
    {
        $this->optimus = $opt;
    }

    public function index(Request $request)
    {
        $noOfItems =$request->input('noOfItems');
        $villageName =$request->input('villageName');
        $block =$request->input('block');
        $district =$request->input('district');
        $state =$request->input('state');

        if((isset($villageName) && !is_null($villageName)) ||(isset($block) && !is_null($block)) || (isset($district) && !is_null($district)) || (isset($state) && !is_null($state))){
            $data['all_villages'] = Village::allVillages($noOfItems,$villageName,$block,$district,$state);

        }else{
            $data['all_villages']= collect();
        }
        return view('village.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['all_states'] = State::all();
        $data['all_district'] = District::all();

        return view('village.create', $data);
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
            'village_name' => 'required|unique:villages',
            'block' => 'required',
        ]);
        $village_data = array(
            'village_name' => $request->input('village_name'),
            'block_id' => $this->optimus->decode($request->input('block')),
            'entry_date' => date('Y-m-d H:i:s'),
            'entry_by' => Auth::id(),
        );

        Village::insert($village_data);

        return redirect('admin/villages')->with('message', 'Village Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id =  $this->optimus->decode($id);
        $village_data = Village::getDetails($id);
        if (isset($village_data) && !empty($village_data)) {
            $data['village_data'] = $village_data;
            $data['all_states'] = State::all();
            $data['all_district'] = District::all();
            $data['all_blocks'] = Block::all();

            return view('village.edit', $data);
        } else {
            return redirect()->back()->with('alert', 'Village Not Found');
        }
    }

    public function update($id, Request $request)
    {

        // dd($_POST);
        $village_id = $this->optimus->decode($id);
        $this->validate($request, [
            'village_name' => 'required',
            'block' => 'required',
        ]);
        $village = Village::find($village_id);
        if (isset($village) && !empty($village)) {

            $village_data = array(

                'village_name' => $request->input('village_name'),
                'block_id' => $this->optimus->decode($request->input('block')),
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::id(),
            );

            $village->update($village_data);
            return redirect('admin/villages')->with('message', 'Village Updated Successfully');
        } else {
            return redirect()->back()->with('alert', 'Something Went Wrong');
        }
    }

    public function destroy($id)
    {
        // dd("qwer");
        $village_id = $this->optimus->decode($id);
        $village = Village::find($village_id);
        if (isset($village) && !empty($village)) {
            $village->delete($village_id);
            return redirect('admin/villages')->with('message', 'Village Deleted Successfully');
        } else {
            return redirect()->back()->with('alert', 'Village Not Found');
        }
    }

    public function export()
    {
    // dd("erthj");
        return Excel::download(new VillageExport, 'villages.csv');
    }
    public function getDistrictFromState($id)
    {
        $district = District::getDistrictFromState($id);
        return json_encode(array('status' => "pass", 'district' => $district));
    }
}
