@extends('layouts.master')


@section('content')
<div class="row page-titles mx-0">
    {{-- <div class="general-button">
        <a href="{{Request::root()}}/admin/states/create"><button type="button" class="btn mb-1 btn-primary">  Add State </button></a>
       <a href="{{Request::root()}}/admin/states/export"> <button type="button" class="btn mb-1 btn-primary">Export</button> </a>
    </div> --}}
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">State</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">List</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                
                <div class="card-body">
                    @include('layouts.alerts')
                    {{-- <h4 class="card-title">Inline Form</h4> --}}
                    <div class="basic-form">
                        <form action="{{ url()->current()}}" method="get">

                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">No of Items</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="No of Items"
                                            aria-label="No of Items" aria-describedby="basic-addon1" name="noOfItems" value="{{ Request::get('noOfItems') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">State</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="State" aria-label="State"
                                            aria-describedby="basic-addon1" name="state" value="{{ Request::get('state') }}">
                                    </div>
                                </div>
                            </div> 
                            <div class=" button-group mt-3">
                                <div class="btn-group">
                                    <div class="form-group mx-sm-1 mb-2">
                                        <button type="submit" class="btn btn-dark mb-2">Search</button>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                      <a href="{{ url()->current()}}">  <button type="button" class="btn btn-dark mb-2">Reset</button></a>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{Request::root()}}/admin/states/create"> <button type="button" class="btn btn-dark mb-2">Add New</button></a>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{Request::root()}}/admin/states/export">  <button type="button" class="btn btn-dark mb-2">Export to csv</button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                @if (isset($all_states) && count($all_states)>0)
                <div class="card-body">
                    <div class="card-title">
                        <h4> States</h4>
                    </div>

                    @include('layouts.alerts')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($all_states as $state)
                                <tr>
                                    <th>{{$i}}</th>
                                    <td>{{$state->state_name}}</td>
                                    @if ($state->isactive == 1)
                                    <td><span class="badge badge-primary px-2">Active</span></td>
                                    @else
                                    <td><span class="badge badge-danger px-2">Inactive</span></td>

                                    @endif

                                    <td class="center" style="width: 120px;">

                                        <a href="{{Request::root()}}/admin/states/edit/{{$state->state_id}}">
                                            <i class="fa fa-pencil-square-o"
                                                style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>|
                                        <a href="#" onclick="return deleteconfirm('/admin/states/delete/{{$state->state_id}}')">
                                            <i class="fa fa-trash-o" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php  $i++; ?>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $all_states->appends(Request::except('page'))->links() }}

                        Showing {{ $all_states->firstItem() }} to {{ $all_states->lastItem() }} of total {{$all_states->total()}} entries
                    </div>
                </div>

                @else
                @if(Request::except('page'))
                <div class="card-body">
                    <div class="card-title">
                        <h4>Nothing Found</h4>
                    </div>
                @endif
              
                @endif

            </div>
        </div>
    </div>
</div>


@stop