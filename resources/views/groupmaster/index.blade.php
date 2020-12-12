@extends('layout.master')
@section('content')


<div class="container-fluid mt-3">
<?php
/*
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <form class="form-row mt-4 mb-4" method="post" action="{{ route('usermaster.user.list') }}">
                @csrf
                <div class="col-lg-3 col-md-12 mb-2">
                    <input class="form-control input-default" name="user_name" value="{{$request->user_name}}" placeholder="Name">
                </div>
                <div class="col-lg-3 col-md-12 mb-2">
                    <input class="form-control input-default" name="email_id" value="{{$request->email_id}}" placeholder="Email">
                </div>
                <div class="col-lg-2 col-md-12 mb-2">
                    <input class="form-control input-default" name="mobile_number" value="{{$request->mobile_number}}" placeholder="Phone Number">
                </div>
                <div class="col-lg-2 col-md-12 mb-2">
                    <select class="form-control input-default" name="isactive">
                        <option selected value="">Status</option>
                        <option @if($request->isactive == 1) selected @endif value="1">Active</option>
                        <option  @if($request->isactive == 0) selected @endif value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 mb-2">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-plus"></i> Add</button>
                </div>
            </form>
      <hr>


                <!-- <h4 class="card-title">Accordion</h4>
                <p class="text-muted"><code></code>
                </p> -->
                <div id="accordion-one" class="accordion">
                    <div class="card">
                        <div id="collapseOne" class="collapse" data-parent="#accordion-one">
                            <div class="card-body">
                            <form method="post" action="{{ route('usemaster.user.add') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                        <input type="text" class="form-control input-default @error('user_name') is-invalid @enderror" id="user-name" name="user_name">

                                        @error('user_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="recipient-name" class="col-form-label">Login Name:</label>
                                        <input type="text" class="form-control input-default @error('login_id') is-invalid @enderror" id="user-name" name="login_id">

                                        @error('login_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Email :</label>
                                        <input type="text" class="form-control input-default @error('email_id') is-invalid @enderror" id="email" name="email_id">

                                        @error('email_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Mobile Number :</label>
                                        <input type="text" class="form-control input-default @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number">

                                        @error('mobile_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Password :</label>
                                        <input type="text" class="form-control input-default @error('user_key') is-invalid @enderror" id="user-name" name="user_key" required>

                                        @error('user_key')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Confirm Password :</label>
                                        <input type="text" class="form-control input-default @error('confirm_user_key') is-invalid @enderror" id="user-name" name="user_key_confirmation" required>

                                        @error('user_key_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">User Type :</label>
                                        <select class="form-control input-default @error('user_type') is-invalid @enderror" name="user_type" required>

                                        <option selected disabled value="">User Type</option>
                                        @forelse($userTypes as $userType)
                                        <option value="{{$userType->user_type}}">{{$userType->user_description}}</option>
                                        @empty
                                        <option value="">no Role Available</option>
                                        @endforelse
                                        </select>
                                        
                                        @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Status :</label>
                                        <select class="form-control input-default @error('isactive') is-invalid @enderror" name="isactive" required>

                                        @error('isactive')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                            <option selected disabled value="">Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                    <label for="user_group"  class="col-form-label">Group :</label>
                                        <select class="form-control input-default @error('user_group') is-invalid @enderror" name="user_group" required>

                                        <option selected disabled value="">Group</option>
                                        @forelse($GroupMasters as $gm)
                                        <option value="{{$gm->group_id}}">{{$gm->group_name}}</option>
                                        @empty
                                        <option value="">no Group Available</option>
                                        @endforelse
                                        
                                        </select>
                                        @error('user_group')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Close</button>
                                    </div>
                                </form>                        


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
</div>
*/
?>
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="active-member">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration mb-0">
                                <thead>
                                    <tr>
                                    <th>Application Name</th>
                                    <th>group Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($groupmaster as $group)
                                    <tr>
                                        <td>{{$group->application_name}}</td>
                                        <td>{{$group->group_name}}</td>
                                        <td>@if($group->isactive === 0) <span class="badge badge-danger px-2">Inactive</span>  @else <span class="badge badge-primary px-2">Active</span> @endif</td>
                                        <td><a href="{{ route('group-master.group.edit', $group->group_id) }}">
                                                <i class="fa fa-pencil-square-o" style="font-size: 18px;line-height: 1.5;"></i>
                                            </a> | @if($group->isactive == 0)  <a href="{{ route('group-master.group.activate', $group->group_id) }}">Activate</a> @else <a href="{{ route('group-master.group.destroy', $group->group_id) }}">Deactivate</a> @endif</td>
                                        <td></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td width="100">No record found</td>
                                    <tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
    </div>



@stop