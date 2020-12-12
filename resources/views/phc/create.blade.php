@extends('layout.master')

@section('content')
<!-- <div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">State</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
        </ol>
    </div>
</div> -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title">
                        <h4>Create PHC</h4>
                    </div>
                    @include('layouts.alerts')
                    <div class="form-validation">
                        <form action="{{ route('phc.store') }}" method="post" id="stateForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="phc_name">PHC Name <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="phc_name" name="phc_name" value="{{ old('phc_name') }}"
                                            placeholder="Enter Name of the PHC" required>
                                    @if ($errors->has('phc_name'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phc_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="block">Block <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="block" name="block" aria-required="true" required>
                                        <option value="">Please select Block</option>
                                        @foreach ($blocks as $block)
                                        <option value="{{$block->block_id}}" 
                                        @if ($block->block_id == old('block') ) selected @endif >{{$block->block_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('block'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('block') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="status">Status <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="status" name="status" aria-required="true" required>
                                        <option value="" disabled>Please select status</option>
                                        <option value="1" selected >Active</option>
                                        <option value="0" >Inctive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <a href="{{ route('phc.index') }}">  <button type="button" class="btn btn-primary">Back</button></a>
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