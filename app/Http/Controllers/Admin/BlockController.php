<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\District;
use App\Exports\BlockExport;
use App\Models\State;
use App\Models\Block;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Auth;
use Jenssegers\Optimus\Optimus;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Optimus $opt , Request $request)
    {
        $this->optimus = $opt;
        $this->request =$request;
    }

    public function index()
    {

        $noOfItems =$this->request->input('noOfItems');
        $block =$this->request->input('block');
        $district =$this->request->input('district');
        $state =$this->request->input('state');

        if((isset($block) && !is_null($block)) || (isset($district) && !is_null($district)) || (isset($state) && !is_null($state))){
        $data['all_blocks'] = Block::allBlocks($noOfItems,$block,$district,$state);

        }else{
            $data['all_blocks']= collect();
        }

        return view('block.index', $data);
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

        return view('block.create', $data);
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
            'block_name' => 'required|unique:blocks',
            'district' => 'required',
        ]);

        $block_data = array(
            'block_name' => $request->input('block_name'),
            'district_id' => $request->input('district'),
            'isactive' => 1,
            'entry_date' => date('Y-m-d H:i:s'),
            'entry_by' => Auth::id(),
        );

        Block::insert($block_data);
        return redirect('admin/blocks')->with('message', 'Block Added Successfully');
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
        $block = Block::getDetails($id);
        if (isset($block) && !empty($block)) {
            $data['block'] = $block;
            $data['all_states'] = State::all();
            $data['all_district'] = District::all();
            return view('block.edit', $data);
        } else {
            return redirect()->back()->with('alert', 'Block Not Found');
        }
    }

    public function update($id, Request $request)
    {
        $block_id = $this->optimus->decode($id);
        $this->validate($request, [
            'block_name' => 'required',
            'district' => 'required',
        ]);
        $block = Block::find($block_id);
        if (isset($block) && !empty($block)) {

            $block_data = array(
                'block_name' => $request->input('block_name'),
                'district_id' => $request->input('district'),
                'isactive' => 1,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::id(),
            );

            $block->update($block_data);
            return redirect('admin/blocks')->with('message', 'Block Updated Successfully');
        } else {
            return redirect()->back()->with('alert', 'Something Went Wrong');
        }
    }

    public function destroy($id)
    {
        $block_id = $this->optimus->decode($id);
        $block = Block::find($block_id);
        if (isset($block) && !empty($block)) {
            $block->delete($block_id);
            return redirect('admin/blocks')->with('message', 'Block Deleted Successfully');
        } else {
            return redirect()->back()->with('alert', 'District Not Found');
        }
    }

    public function export()
    {
    // dd("erthj");
        return Excel::download(new BlockExport, 'blocks.csv');
    }
    public function getDistrictFromState($id)
    {
        $district = District::getDistrictFromState($id);
        return json_encode(array('status' => "pass", 'district' => $district));
    }

    public function getBlockFromDistrict($id)
    {
        $block = Block::getBlockFromDistrict($id);
        // dd($block);
        return json_encode(array('status' => "pass", 'block' => $block));
    }
}
