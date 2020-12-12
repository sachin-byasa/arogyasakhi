@extends('layout.master')
@section('title', 'States')
@section('parentPageTitle', 'State')
@section('BCLastTitle', 'Edit' )
@section('content')



<div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update State</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{Request::root()}}/admin/states/update" method="post" id="stateForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="state_id" value="{{$state->state_id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">State Name</label>
                               
                                <input type="text" class="form-control" id="state_name" name="state_name"
                                    placeholder="State Name" name="state" required value="{{$state->state_name}}">
                                <span style="display:block" class="error" role="alert">
                                    <p>{{ $errors->first('state_name') }}</p>
                                </span>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{Request::root()}}/admin/states"> <button type="button"
                                    class="btn btn-danger">Back</button></a>
                        </div>
                    </form>
                </div>

                <!-- /.card -->

            </div>
        </div>
    </div>
</div>

{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title">
                        <h4>Update State</h4>
                    </div>
                    @include('layouts.alerts')
                    <div class="form-validation">
                        <form action="{{Request::root()}}/admin/states/update" method="post" id="stateForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="state_id" value="{{$state->state_id}}">

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="state_name">State Name <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                <input type="text" class="form-control" id="state_name" name="state_name" value="{{$state->state_name}}"
                                        placeholder="Enter Name of the State" required>
                                        @if ($errors->has('state_name'))
                                        <span style="display:block" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state_name') }}</strong>
                                        </span>
                                        @endif
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{Request::root()}}/admin/states">  <button type="button" class="btn btn-primary">Back</button></a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div> --}}


@endsection

@section('script')
<script src="{{asset('assets/js/jquery-validate.js')}}"></script>
<script src="{{asset('assets/js/states.js')}}"></script>
@endsection