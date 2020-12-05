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
                        <h4>Add State</h4>
                    </div>

                    <div class="form-validation">
                    <form class="form-valide" action="{{Request::root()}}/states/store" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="state_name">State Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="state_name" name="state_name" placeholder="Enter Name of the State">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


@stop