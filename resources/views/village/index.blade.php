@extends('layouts.master')


@section('content')
<div class="row page-titles mx-0">
    <div class="general-button">
        <a href="{{ route('villages.create')}}"><button type="button" class="btn mb-1 btn-primary">  Add Village </button></a>
       <a href="{{Request::root()}}/admin/villages/export/csv"> <button type="button" class="btn mb-1 btn-primary">Export</button> </a>
    </div>
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Village</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">List</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title">
                        <h4>All States</h4>
                    </div>

                    @include('layouts.alerts')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Village Name</th>
                                    <th>Block Name</th>
                                    <th>District</th>
                                    <th>State</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($all_villages as $village)
                                <tr>
                                    <th>{{$i}}</th>
                                    <td>{{$village->village_name}}</td>
                                    <td>{{$village->block_name}}</td>
                                    <td>{{$village->district_name}}</td>
                                    <td>{{$village->state_name}}</td>



                                    <td class="center" style="width: 120px;">

                                        <a href="{{route('villages.edit', ['village_id' => $village->village_id]) }}">
                                            <i class="fa fa-pencil-square-o"
                                                style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                        |
                                        <a href="#" onclick="return deleteconfirm('/admin/villages/delete/{{$village->village_id}}')">
                                            <i class="fa fa-trash-o" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php  $i++; ?>
                                @endforeach

                            </tbody>
                        </table>
                        {!! $all_villages->render() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@stop