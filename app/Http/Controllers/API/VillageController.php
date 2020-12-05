<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VillageController extends Controller
{
    function __construct( \App\Models\Village $Village, \App\Library\Responses $response){
        $this->Village = $Village;
        $this->response = $response;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response($this->Village->all(), 200)->header('Content-Type', 'text/plain');
    }


    public function VillagesInBlock(Request $request)
    {
        $collection = $this->Village->where('block_id', $request->block_id)->get();   
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
        $collection = $this->Village->find($id);
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
