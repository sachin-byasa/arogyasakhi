@extends('layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">State</a></li>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($all_states as $state)
                                <tr>
                                    <th>{{$i}}</th>
                                    <td>{{$state->state_name}}</td>
                                    @if ($state->isactive == 1)
                                    <td><span class="badge badge-primary px-2">Active</span></td>
                                    @else
                                    <td><span class="badge badge-danger px-2">Inactive</span></td>

                                    @endif

                                    <td class="center" style="width: 120px;">

                                        <a href="{{Request::root()}}/regulations/edit-question/{{$state->state_id}}">
                                            <i class="fa fa-pencil-square-o"
                                                style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>|
                                        <a href="{{Request::root()}}/regulations/edit-question/{{$state->state_id}}">
                                            <i class="fa fa-trash-o" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php  $i++; ?>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@stop