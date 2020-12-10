<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\State;
use App\Exports\StateExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Auth;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $noOfItems =$request->input('noOfItems');
        $state =$request->input('state');

        // $data['all_states'] = State::allStates($noOfItems,$state);
        if((isset($state) && !is_null($state))){
            $data['all_states'] = State::allStates($noOfItems,$state);

        }else{
            $data['all_states']= collect();
        }
        return view('states.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('states.create');
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
        'state_name' => 'required|unique:states',
        
      ]);

        $state_data = array(
             'state_name' => $request->input('state_name'), 
             'isactive' => 1,
             'entry_date' => date('Y-m-d H:i:s'),
             'entry_by' => Auth::id(),
            );

        State::insert($state_data);
        return redirect('admin/states')->with('message', 'State Added Successfully');
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
        $state=State::find($id);
        if(isset($state) && !empty($state)){
            $data['state']=$state;
            return view('states.edit',$data);
        }else{
            return redirect()->back()->with('alert', 'State Not Found');
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
        $this->validate($request, [
            'state_id' => 'required',
            
        
      ]);

        $state_id =  $request->input('state_id');
        $state=State::find($state_id);
        if(isset($state) && !empty($state)){
            $state_data = array(
                'state_name' =>  $request->input('state_name'), 
                'isactive' => 1,
                'updated_date' => date('Y-m-d H:i:s'),
                 'updated_by' => Auth::id(),
            );
            // dd($state_data);
           $state->update($state_data);
        return redirect('admin/states')->with('message', 'State Updated Successfully');

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
        $state=State::find($id);
        if(isset($state) && !empty($state)){
            $state->delete($id);
            return redirect('admin/states')->with('message', 'State Deleted Successfully');
        }else{
            return redirect()->back()->with('alert', 'State Not Found');
        }
        
    }

    public function export(){
        

        return Excel::download(new StateExport, 'states.csv');

    }
}



