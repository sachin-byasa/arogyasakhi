@extends('layout.master')
@section('content')


<div class="container-fluid mt-3">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <form class="form-row mt-2 mb-2" method="post" action="{{ route('user-master.index') }}">
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
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search">Search</i></button>
                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-plus"></i> Add</button>
                </div>
            </form>
      <hr>


                <!-- <h4 class="card-title">Accordion</h4>
                <p class="text-muted"><code></code>
                </p> -->
                <div id="accordion-one" class="accordion">
                    <div class="card">
                        <div id="collapseOne" class="collapse @if($errors->any()) show @endif" data-parent="#accordion-one">
                            <div class="card-body">
                            <form method="post" action="{{ route('user-master.add') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                        <input type="text" class="form-control input-default @error('user_name') is-invalid @enderror" id="user-name" value="{{ old('user_name') }}" name="user_name">

                                        @error('user_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="recipient-name" class="col-form-label">Login Name:</label>
                                        <input type="text" class="form-control input-default @error('login_id') is-invalid @enderror" id="user-name" value="{{ old('login_id') }}" name="login_id">

                                        @error('login_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Email :</label>
                                        <input type="text" class="form-control input-default @error('email_id') is-invalid @enderror" id="email" value="{{ old('email_id') }}" name="email_id">

                                        @error('email_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Mobile Number :</label>
                                        <input type="text" class="form-control input-default @error('mobile_number') is-invalid @enderror" id="phone_number" name="mobile_number" value="{{ old('mobile_number') }}">

                                        @error('mobile_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Password :</label>
                                        <input type="password" class="form-control input-default @error('user_key') is-invalid @enderror" id="user-name" name="user_key" value="{{ old('user_key') }}" required>

                                        @error('user_key')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">Confirm Password :</label>
                                        <input type="password" class="form-control input-default @error('confirm_user_key') is-invalid @enderror" id="user-name" name="user_key_confirmation" value="{{ old('user_key_confirmation') }}" required>

                                        @error('user_key_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="message-text" class="col-form-label">User Type :</label>
                                        <select class="form-control input-default @error('user_type') is-invalid @enderror" name="user_type" value="{{ old('user_type') }}" required>

                                        <option selected disabled value="">User Type</option>
                                        @forelse($userTypes as $userType)
                                        <option @if($userType->user_type == old('user_type')) selected @endif value="{{$userType->user_type}}">{{$userType->user_description}}</option>
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
                                            <option @if(old('isactive') == 1) selected @endif value="1">Active</option>
                                            <option @if(old('isactive') == 0) selected @endif value="0">Inactive</option>
                                        </select>
                                        @error('isactive')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                    <label for="user_group"  class="col-form-label">Group :</label>
                                        <select class="form-control input-default @error('user_group') is-invalid @enderror" name="user_group" required>

                                        <option selected disabled value="">Group</option>
                                        @forelse($GroupMasters as $gm)
                                        <option @if($gm->group_id == old('user_group')) selected @endif value="{{$gm->group_id}}">{{$gm->group_name}}</option>
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
                                        <button type="reset" class="btn btn-primary">Reset</button>
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

@if(!empty($usermaster))
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="active-member">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                    <th>User Name</th>
                                    <th>Login Name</th>
                                    <th>Email</th>
                                    <th>Phone Nuber</th>
                                    <th>Type</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($usermaster as $user)
                                    <tr>
                                        <td>{{$user->user_name}}</td>
                                        <td>{{$user->login_id}}</td>
                                        <td>{{$user->email_id}}</td>
                                        <td>{{$user->mobile_number}}</td>
                                        <td>{{$user->user_description}}</td>
                                        <td>{{$user->group_name}}</td>
                                        <td>@if($user->isactive === 0) inactive @else active @endif</td>
                                        <td><a href="{{ route('user-master.user.edit', $user->user_id) }}">Edit</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100" class="text-center">No record found</td>
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
@endif




</div>


@stop