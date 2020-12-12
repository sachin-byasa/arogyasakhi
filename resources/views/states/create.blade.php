@extends('layout.master')
@section('title', 'States')
@section('parentPageTitle', 'State')
@section('BCLastTitle', 'Add' )

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add State</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{Request::root()}}/admin/states/store" method="post" id="stateForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">State Name</label>
                               
                                <input type="text" class="form-control" id="state_name" name="state_name"
                                    placeholder="State Name" name="state" required value="{{old('state_name')}}">
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


@endsection

@section('script')
<script src="{{asset('assets/js/jquery-validate.js')}}"></script>
<script src="{{asset('assets/js/states.js')}}"></script>
@endsection