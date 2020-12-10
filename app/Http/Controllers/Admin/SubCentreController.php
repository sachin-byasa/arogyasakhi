<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCentre;
use \Session;

class SubCentreController extends Controller
{
     /**
      * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sub_centres = SubCentre::from('sub_centres as sc')
        ->leftJoin('phc','phc.phc_id', 'sc.phc_id')
        ->where(function ($query) use ($request) {
                if(!empty($request->sub_centre_name)){
                    $query->where('sc.sub_centre_name', 'like', '%' . $request->sub_centre_name . '%');
                    Session::put('sub_centre_name', $request->sub_centre_name);
                }
                if($request->has('sub_centre_name') && empty($request->sub_centre_name)){
                    Session::forget('sub_centre_name');
                }
                if(!empty($request->phc_id)){
                    $query->where('sc.phc_id', $request->phc_id);
                    Session::put('phc_id', $request->phc_id);
                }
                if($request->has('phc_id') && empty($request->phc_id)){
                    Session::forget('phc_id');
                }
                if($request->isactive != null){
                    $query->where('sc.isactive', $request->isactive);
                    Session::put('isactive', $request->isactive);
                }
                if($request->has('isactive') && $request->isactive == null){
                    Session::forget('isactive');
                }
            })
            ->select('sub_centre_id', 'sub_centre_name', 'sc.phc_id', 'phc_name', 'sc.isactive')
            ->simplePaginate(15);
            
            $phcs = \DB::table('phc')->get();   
            

        // $sub_centres = SubCentre::from('sub_centres as sc')->leftJoin('phc','phc.phc_id', 'sc.phc_id')->select('sub_centre_id', 'sub_centre_name', 'sc.phc_id', 'phc_name', 'sc.isactive')->simplePaginate(15);
        return view('subcentre.index', compact('sub_centres', 'phcs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phcs = \DB::table('phc')->get();
        return view('subcentre.create', compact('phcs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sub_centre_name' => 'string|max:50|required',
            'phc' => 'integer|required',
            'status' => 'integer|required',
        ]);
        $update_response = SubCentre::create([
            'sub_centre_name' => $request->sub_centre_name,
            'phc_id' => $request->phc,
            'isactive' => $request->status,
            'entry_by' => \Auth::user()->user_id,
            'entry_date' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        if($update_response){
            return back()->with('success', 'Sub Centre Created');
        }
        else{
            return back()->with('error', 'something went wrong! please try again later.');
        }
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
        $sub_centre = SubCentre::where('sub_centre_id', $id)->leftJoin('phc','phc.phc_id', 'sub_centres.phc_id')->select('sub_centre_id', 'sub_centre_name', 'sub_centres.phc_id', 'phc_name', 'sub_centres.phc_id', 'sub_centres.isactive')->first();
        $phcs = \DB::table('phc')->get();
        return view('subcentre.edit', compact('sub_centre','phcs'));
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
        // dd($request->all());
        
        $request->validate([
            'sub_centre_name' => 'string|max:50|required|unique:sub_centres,sub_centre_name,'.$id.',sub_centre_id',
            'phc' => 'integer|required',
            'status' => 'integer|required',
        ]);

        $update_response = SubCentre::find($id)->update([
                            'sub_centre_name' => $request->sub_centre_name,
                            'phc_id' => $request->phc,
                            'isactive' => $request->status,
                            'updated_by' => \Auth::user()->user_id,
                            'updated_date' => \Carbon\Carbon::now()->toDateTimeString(),
                        ]);

        if($update_response){
            return back()->with('success', 'PHC updated');
        }
        else{
            return back()->with('error', 'something went wrong! please try again later.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        $disable_response = SubCentre::find($id)->update([
            'isactive' => 0,
            'updated_by' => \Auth::user()->user_id,
            'updated_date' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        if($disable_response){
            return back()->with('success', 'SubCentre disabled');
        }
        else{
            return back()->with('error', 'something went wrong! please try again later.');
        }
    }
   
    public function enable($id)
    {
        $enable_response = SubCentre::find($id)->update([
            'isactive' => 1,
            'updated_by' => \Auth::user()->user_id,
            'updated_date' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        if($enable_response){
            return back()->with('success', 'SubCentre updated');
        }
        else{
            return back()->with('error', 'something went wrong! please try again later.');
        }
    }
}
