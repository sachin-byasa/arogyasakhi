@extends('layouts.master')
@section('content')


<div class="row page-titles mx-0">
    <div class="general-button">
        <a href="{{ route('phc.create') }}"><button type="button" class="btn mb-1 btn-primary">  Add PHC </button></a>
    </div>
    <!-- <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">State</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">List</a></li>
        </ol>
    </div> -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <!-- <div class="card-title">
                        <h4>All States</h4>
                    </div> -->
<?php
/*
                    <form class="form-row mt-2 mb-2" method="get" action="{{ route('phc.index') }}">
                @csrf
                <div class="col-lg-3 col-md-12 mb-2">
                    <input class="form-control input-default" name="sub_centre_name" value="{{$request->sub_centre_name}}" placeholder="Sub Centre Name">
                </div>
                <div class="col-lg-3 col-md-12 mb-2">
                    <input class="form-control input-default" name="phc" value="{{$request->phc}}" placeholder="PHC">
                </div>
                <div class="col-lg-2 col-md-12 mb-2">
                    <input class="form-control input-default" name="status" value="{{$request->status}}" placeholder="Status">
                </div>
                <div class="col-lg-2 col-md-12 mb-2">
                    <select class="form-control input-default" name="isactive">
                        <option selected value="">Status</option>
                        <option @if($request->isactive == 1) selected @endif value="1">Active</option>
                        <option  @if($request->isactive == 0) selected @endif value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 mb-2">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search">Search</i></button>
                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-plus"></i> Add</button>
                </div>
            </form>
      <hr>
      */
      ?>

                    @include('layouts.alerts')
                    <div class="table table-striped table-bordered table-responsive">
                    
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>PHC Name</th>
                                    <th>Block</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt = $phcs->perPage() * ($phcs->currentPage() - 1) + 1  ?>
                                @foreach ($phcs as $phc)
                                <tr>
                                    <th>{{$cnt}}</th>
                                    <td>{{$phc->block_name}}</td>
                                    <td>{{$phc->phc_name}}</td>
                                    @if ($phc->isactive == 1)
                                    <td><span class="badge badge-primary px-2">Active</span></td>
                                    @else
                                    <td><span class="badge badge-danger px-2">Inactive</span></td>
                                    @endif

                                    <td class="center" style="width: 120px;">

                                        <a href="{{ route('phc.edit', $phc->phc_id) }}">
                                            <i class="fa fa-pencil-square-o" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                        @if($phc->isactive == 1)|
                                        <a href="{{ route('phc.disable', $phc->phc_id) }}" >
                                             <i class="fa fa-trash-o" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('phc.enable', $phc->phc_id) }}" >
                                             <i class="fa fa-recycle" style="font-size: 18px;line-height: 1.5;"></i> 
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                <?php  $cnt++; ?>
                                @endforeach

                            </tbody>
                        </table>
                        {!! $phcs->render() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@stop