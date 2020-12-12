@extends('layout.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Village</a></li>
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
                        <h4>Add Village</h4>
                    </div>
                    @include('layouts.alerts')
                    <div class="form-validation">
                        <form action="{{route('villages.store')}}" method="post" id="villageForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="village_name">Village Name<span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="village_name" name="village_name"
                                placeholder="Enter Name of the State" required value="{{old('village_name')}}">
                                     @if ($errors->has('village_name'))
                                <span style="display:block" class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('village_name') }}</strong>
                                </span>
                                @endif
                                </div>
                                
                            </div>
                            <div class="form-group row ">
                                <label class="col-lg-2 col-form-label" for="state">State <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="state" name="state" aria-required="true" required>
                                        <option value="">Please select State</option>
                                        @foreach ($all_states as $state)
                                        <option value="{{$state->state_id}}" 
                                        @if (old('state')== $state->state_id ) selected @endif >{{$state->state_name}}</option>
                                           
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            </div>
                            <div class="form-group row ">
                                <label class="col-lg-2 col-form-label" for="state">District <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="district" name="district" aria-required="true" required>
                                        <option value="">Please select District</option>
                                        {{-- @foreach ($all_district as $district)
                                        <option value="{{$district->district_id}}" 
                                        @if (old('district')== $district->district_id ) selected @endif >{{$district->district_name}}</option>
                                        @endforeach --}}
                                    </select>
                                    @if ($errors->has('district'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            </div>

                            <div class="form-group row ">
                                <label class="col-lg-2 col-form-label" for="state">Block <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="block" name="block" aria-required="true" required>
                                        <option value="">Please select Block</option>
                                        {{-- @foreach ($all_district as $district)
                                        <option value="{{$district->district_id}}" 
                                        @if (old('district')== $district->district_id ) selected @endif >{{$district->district_name}}</option>
                                        @endforeach --}}
                                    </select>
                                    @if ($errors->has('block'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('block') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{Request::root()}}/admin/districts">  <button type="button" class="btn btn-primary">Back</button></a>
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
<script src="{{asset('assets/js/village.js')}}"></script>
@endsection