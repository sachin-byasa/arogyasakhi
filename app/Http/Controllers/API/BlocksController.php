<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BlocksController extends Controller
{
    function __construct( \App\Models\Block $Block, \App\Library\Responses $response){
        $this->Block = $Block;
        $this->response = $response;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if()
        $block = $this->Block->all();
        foreach($block as $key => $value){
            dd($key);
        }
        return response($block, 200)->header('Content-Type', 'text/plain');
    }

    
    public function BlocksInDistrict(Request $request)
    {
        $collection = $this->Block->where('district_id', $request->district_id)->get();   
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
        $collection = $this->Block->find($id);
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
