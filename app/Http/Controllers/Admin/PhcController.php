<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PHC;
use \Session;

class PhcController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->limit)){
            Session::put('limit', $request->limit);
        }
        else if($request->has('limit') && empty($request->limit)){
            Session::forget('limit');
        }
        
        $phcs = PHC::leftJoin('blocks','blocks.block_id', 'phc.block_id')
            ->where(function ($query) use ($request) {
                if(!empty($request->phc_name)){
                    $query->where('phc.phc_name', 'like', '%' . $request->phc_name . '%');
                    Session::put('phc_name', $request->phc_name);
                }
                if($request->has('phc_name') && empty($request->phc_name)){
                    Session::forget('phc_name');
                }
                if(!empty($request->block_id)){
                    $query->where('phc.block_id', $request->block_id);
                    Session::put('block_id', $request->block_id);
                }
                if($request->has('block_id') && empty($request->block_id)){
                    Session::forget('block_id');
                }
                if($request->isactive != null){
                    $query->where('phc.isactive', $request->isactive);
                    Session::put('isactive', $request->isactive);
                }
                if($request->has('isactive') && $request->isactive == null){
                    Session::forget('isactive');
                }
            })
            ->select('phc_id', 'phc_name', 'phc.block_id', 'block_name', 'district_id', 'phc.isactive')
            ->simplePaginate(Session::get('limit'));

        $blocks = \DB::table('blocks')->get();
            
        // $filter = new \StdClass();
        // $filter->phc_name = $request->phc_name;
        // $filter->block_id = $request->block_id;
        // $filter->isactive = $request->isactive;

        return view('phc.index', compact('phcs', 'blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blocks = \DB::table('blocks')->get();
        return view('phc.create', compact('blocks'));
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
            'phc_name' => 'string|max:50|required',
            'block' => 'integer|required',
        ]);
        $update_response = PHC::create([
            'phc_name' => $request->phc_name,
            'block_id' => $request->block,
            'isactive' => $request->status,
            'entry_by' => \Auth::user()->user_id,
            'entry_date' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        if($update_response){
            return back()->with('success', 'PHC Created');
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
        $phc = PHC::where('phc_id', $id)->leftJoin('blocks','blocks.block_id', 'phc.block_id')->select('phc_id', 'phc_name', 'phc.block_id', 'block_name', 'district_id', 'phc.isactive')->first();
        $blocks = \DB::table('blocks')->get();
        return view('phc.edit', compact('phc','blocks'));
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
            'phc_name' => 'string|max:50|required',
            'block' => 'integer|required',
            'status' => 'integer|required',
        ]);

        $update_response = PHC::find($id)->update([
                            'phc_name' => $request->phc_name,
                            'block_id' => $request->block,
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
        $disable_response = PHC::find($id)->update([
            'isactive' => 0,
            'updated_by' => \Auth::user()->user_id,
            'updated_date' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        if($disable_response){
            return back()->with('success', 'PHC disabled');
        }
        else{
            return back()->with('error', 'something went wrong! please try again later.');
        }
    }
   
    public function enable($id)
    {
        $enable_response = PHC::find($id)->update([
            'isactive' => 1,
            'updated_by' => \Auth::user()->user_id,
            'updated_date' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        if($enable_response){
            return back()->with('success', 'PHC updated');
        }
        else{
            return back()->with('error', 'something went wrong! please try again later.');
        }
    }
}
