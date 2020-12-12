@extends('layout.master')
@section('title', 'States Listing')
@section('parentPageTitle', 'State')
@section('BCLastTitle', 'List' )

@section('content')
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

                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="noOfItems">No of Items</label>
                                        <input type="number" class="form-control" placeholder="No of Items"
                                            name="noOfItems" value="{{ Request::get('noOfItems') }}">
                                    </div>

                                </div> --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="state">State Name </label>
                                        <input type="text" class="form-control" placeholder="State" name="state"
                                            value="{{ Request::get('state') }}">
                                    </div>
                                </div>
                            </div>
                            <div class=" button-group mt-3">
                                <div class="btn-group">
                                    <div class="form-group mx-sm-1 mb-2">
                                        <button type="submit" name="q" value="q" class="btn btn-primary mb-2">Search</button>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{ url()->current()}}"> <button type="button"
                                                class="btn btn-danger mb-2">Reset</button></a>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{Request::root()}}/admin/states/create"> <button type="button"
                                                class="btn btn-success mb-2">Add New</button></a>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{Request::root()}}/admin/states/export"> <button type="button"
                                                class="btn btn-warning mb-2">Export to csv</button></a>
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


                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordered table-striped dataTable dtr-inline">
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
                                            <i class="fa fa-pencil" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>|
                                        <a href="#"
                                            onclick="return deleteconfirm('/admin/states/delete/{{$state->state_id}}')">
                                            <i class="fa fa-trash" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php  $i++; ?>
                                @endforeach

                            </tbody>
                        </table>

                        {{-- {{ $all_states->appends(Request::except('page'))->links() }}

                        Showing {{ $all_states->firstItem() }} to {{ $all_states->lastItem() }} of total
                        {{$all_states->total()}} entries --}}
                    </div>
                </div>

                {{-- @else
                @if(Request::except('page'))
                <div class="card-body">
                    <div class="card-title">
                        <h4>Nothing Found</h4>
                    </div>
                    @endif --}}

                    @endif

                </div>
            </div>
        </div>
    </div>


    @stop

    @section('script')
<script src="{{asset('assets/js/jquery-validate.js')}}"></script>
<script src="{{asset('assets/js/states.js')}}"></script>
@endsection