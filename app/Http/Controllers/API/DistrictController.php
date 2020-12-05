<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    function __construct( \App\Models\District $District){
        $this->District = $District;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request('arogyasakhi_id'));
        return response($this->District->all(), 200)->header('Content-Type', 'text/plain');
    }

    public function DistrictsInState(Request $request)
    {
        $collection = $this->District->where('state_id', $request->state_id)->get();   
        return (!$collection->isEmpty())? $this->response->Success($collection->toJson()) : $this->response->notFound();
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
        $collection = $this->District->find($id);
        return (!empty($collection))? $this->response->Success($collection) : $this->response->notFound();
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
