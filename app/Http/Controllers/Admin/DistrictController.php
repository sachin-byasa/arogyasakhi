<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\District;
use App\Exports\DistrictExport;
use App\Models\State;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Auth;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_districts'] = District::allDistrict();
        return view('district.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_states'] = State::allStates();
        return view('district.create',$data);
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
        'district_name' => 'required|unique:districts',
        'state' => 'required',
        
      ]);

        $district_data = array(
             'district_name' => $request->input('district_name'), 
             'state_id' => $request->input('state'), 
             'isactive' => 1,
             'entry_date' => date('Y-m-d H:i:s'),
             'entry_by' => Auth::id(),
            );

            District::insert($district_data);
        return redirect('admin/districts')->with('message', 'District Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district=District::find($id);
        if(isset($district) && !empty($district)){
            $data['district']=$district;
            $data['all_states'] = State::allStates();
            // dd($data);
            return view('district.edit',$data);
        }else{
            return redirect()->back()->with('alert', 'District Not Found');
        }
        
   

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        // dd($_POST);
        $this->validate($request, [
            'district_id' => 'required',
            'district_name' => 'required',
            'state' => 'required',
      ]);
        $district_id = $request->input('district_id');
        $district = District::find($district_id);
        if(isset($district) && !empty($district)){
            
            $district_data = array(
            'district_name' => $request->input('district_name'), 
            'state_id' => $request->input('state'), 
            'state_name' =>  $request->input('state_name'), 
            'isactive' => 1,
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::id(),
            );

            $district->update($district_data);
        return redirect('admin/districts')->with('message', 'District Updated Successfully');

        }else{
            return redirect()->back()->with('alert', 'Something Went Wrong');
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
        $district=District::find($id);
        if(isset($district) && !empty($district)){
            $district->delete($id);
            return redirect('admin/districts')->with('message', 'District Deleted Successfully');
        }else{
            return redirect()->back()->with('alert', 'District Not Found');
        }
        
    }

    public function export(){
        

        return Excel::download(new DistrictExport, 'districts.csv');

    }

    
}



