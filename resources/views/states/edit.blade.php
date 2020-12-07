@extends('layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">State</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
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
</div>


@endsection

@section('script')
<script src="{{asset('assets/js/jquery-validate.js')}}"></script>
<script src="{{asset('assets/js/states.js')}}"></script>
@endsection