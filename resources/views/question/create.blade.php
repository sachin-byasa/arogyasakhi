@extends('layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Questiion</a></li>
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
                        <h4>Add Questiion</h4>
                    </div>
                    @include('layouts.alerts')
                    <div class="form-validation">
                        <form action="{{route('question-manager.store')}}" method="post" id="villageForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="questionKeyWord">Question Key Word <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="questionKeyWord" name="questionKeyWord"
                                        placeholder="Enter Name of the State" required
                                        value="{{old('questionKeyWord')}}">
                                    @if ($errors->has('questionKeyWord'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('questionKeyWord') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="questionInEnglish">Question in English <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">

                                    <textarea class="form-control h-150px" rows="6" id="questionInEnglish"
                                        name="questionInEnglish"></textarea>
                                    @if ($errors->has('questionInEnglish'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('questionInEnglish') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="questionInMarathi">Question in Marathi <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">

                                    <textarea class="form-control h-150px" rows="6" id="questionInMarathi"
                                        name="questionInMarathi"></textarea>
                                    @if ($errors->has('questionInMarathi'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('questionInMarathi') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="questionInHindi">Question in Hindi <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">

                                    <textarea class="form-control h-150px" rows="6" id="questionInHindi"
                                        name="questionInHindi"></textarea>
                                    @if ($errors->has('questionInHindi'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('questionInHindi') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="answerType">Answer type <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="answerType" name="answerType" aria-required="true"
                                        required>
                                        <option value="">Please select Answer Type</option>
                                        @foreach ($answer_type as $type)
                                        <option value="{{$type->answer_type}}" @if (old('answerType')==$type->
                                            answer_type )
                                            selected @endif >{{$type->answer_type}}</option>

                                        @endforeach
                                    </select>
                                    @if ($errors->has('answerType'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answerType') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Validation
                                </label>
                                <div class="col-lg-6">
                                    <div class="form-check mb-3">
                                        <label class="form-check-label" for="capturePhotoRequired"></label>
                                        <input type="checkbox" class="form-check-input" value="1"
                                            id="capturePhotoRequired" name="capturePhotoRequired">Compulsory
                                        <input id='capturePhotoRequiredHidden' type='hidden' value='0'
                                            name='capturePhotoRequired'>
                                    </div>

                                    @if ($errors->has('capturePhotoRequired'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Validation
                                </label>
                                <div class="col-lg-6">
                                    <div class="form-check mb-3">
                                        <label class="form-check-label" for="required"></label>
                                        <input type="checkbox" class="form-check-input" value="true"
                                        id="required" name="required">Compulsory
                                         {{-- <input id='requiredHidden' type='hidden' value='0' name='required'> --}}
                                    </div>

                                    @if ($errors->has('required'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-check mb-3">
                                        <label class="form-check-label" for="length"></label>
                                        <input type="text" class="form-control" id="min" name="length[min]"
                                        placeholder="Enter Name of the State" required
                                        value="{{old('min')}}">
                                        <input type="text" class="form-control" id="max" name="length[max]"
                                        placeholder="Enter Name of the State" required
                                        value="{{old('max')}}">
                                        <input type="text" class="form-control" id="max" name="length[languages][en]"
                                        placeholder="Enter Name of the State" required
                                        value="{{old('max')}}">
                                        <input type="text" class="form-control" id="max" name="length[languages][mr]"
                                        placeholder="Enter Name of the State" required
                                        value="{{old('max')}}">
                                        <input type="text" class="form-control" id="max" name="length[languages][hi]"
                                        placeholder="Enter Name of the State" required
                                        value="{{old('max')}}">
                                    </div>

                                    @if ($errors->has('capturePhotoRequired'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-check mb-3">
                                        <<label class="form-check-label" for="length"></label>
                                        <input type="text" class="form-control" id="min" name="length[min]"
                                        placeholder="Enter Name of the State" required
                                        value="{{old('min')}}">
                                    </div>

                                    @if ($errors->has('required'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{Request::root()}}/admin/districts"> <button type="button"
                                            class="btn btn-primary">Back</button></a>
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