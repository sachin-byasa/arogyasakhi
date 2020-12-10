@extends('layouts.master')
@section('content')


<div class="row page-titles mx-0">
    <div class="general-button">
        <a href="{{ route('sub-centre.create') }}"><button type="button" class="btn mb-1 btn-primary">  Add  SubCentre </button></a>
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

                <form class="form-row mt-2 mb-2" method="get" action="{{ route('sub-centre.index') }}">
                @csrf
                <div class="col-lg-3 col-md-12 mb-2">
                    <input class="form-control input-default" name="sub_centre_name"  value="{{Session::get('sub_centre_name')}}"  placeholder="Sub Centre Name">
                </div>
                <div class="col-lg-3 col-md-12 mb-2">
                <select class="form-control input-default" name="phc_id">
                        <option selected value="">Select Sub Centre</option>
                @forelse($phcs as $phc)
                        <option  @if($phc->phc_id == Session::get('phc_id')) selected @endif value="{{$phc->phc_id}}">{{$phc->phc_name}}</option>
                @empty
                        <option selected value="">No phcs available</option>
                @endforelse
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 mb-2">
                    <select class="form-control input-default" name="isactive">
                        <option selected value="">Status</option>
                        <option  @if(Session::get('isactive') == '1') selected @endif value="1">Active</option>
                        <option  @if(Session::get('isactive') == '0') selected @endif value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 mb-2">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search">Search</i></button>
                </div>
            </form>

            

                    @include('layouts.alerts')
                    <div class="table table-striped table-bordered table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SubCentre Name</th>
                                    <th>PHC</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt =1 ?>
                                @foreach ($sub_centres as $sub_centre)
                                <tr>
                                    <th>{{$cnt}}</th>
                                    <td>{{$sub_centre->sub_centre_name}}</td>
                                    <td>{{$sub_centre->phc_name}}</td>
                                    @if ($sub_centre->isactive == 1)
                                    <td><span class="badge badge-primary px-2">Active</span></td>
                                    @else
                                    <td><span class="badge badge-danger px-2">Inactive</span></td>
                                    @endif

                                    <td class="center" style="width: 120px;">

                                        <a href="{{ route('sub-centre.edit', $sub_centre->sub_centre_id) }}">
                                            <i class="fa fa-pencil-square-o" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                        @if($sub_centre->isactive == 1)|
                                        <a href="{{ route('sub-centre.disable', $sub_centre->sub_centre_id) }}" >
                                             <i class="fa fa-trash-o" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('sub-centre.enable', $sub_centre->sub_centre_id) }}" >
                                             <i class="fa fa-recycle" style="font-size: 18px;line-height: 1.5;"></i> 
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                <?php  $cnt++; ?>
                                @endforeach

                            </tbody>
                        </table>
                        {!! $sub_centres->render() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@stop