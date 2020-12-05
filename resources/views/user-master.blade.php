<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    
    
    <title>Hello, world!</title>
  </head>
  <body>
    

  
  <div class="container">

  @if(isset($page) && $page == 'edit')
  
  @if(!empty(session('message')))
    <div class="alert alert-{{session('type')}}  mt-4 mb-4" >{{session('message')}}</div>
  @endif
    <form method="post" action="{{ route('usermaster.user.update') }}">
      @csrf
      <div class="form-row mt-4 mb-2">
        <div class="col-md-4 mb-2">
          <label for="name">Name</label>
          <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user-name" name="user_name" value="{{$user->user_name}}"  required>

              @error('user_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4 mb-2">
          <label for="name">Login Name</label>
          <input type="text" class="form-control @error('login_id') is-invalid @enderror" id="user-name" name="login_id" value="{{$user->login_id}}" >

              @error('login_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4 mb-2">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email_id" value="{{$user->email_id}}" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-2">
          <label for="phone">Phone</label>
          <input type="tel" class="form-control" name="mobile_number" id="phone" value="{{$user->mobile_number}}">
        </div>
        <div class="col-md-3 mb-2">
          <label for="isactive">Status</label>
          <select class="custom-select" id="isactive" name="isactive" required>
            <option selected disabled value="">Choose...</option>
            <option @if($user->isactive == 1) selected @endif value="1">Active</option>
            <option @if($user->isactive == 0) selected @endif value="0">Inactive</option>
          </select>
        </div>
        <div class="col-md-3 mb-2">
            <label for="user_type">User Type :</label>
            <select class="form-control @error('user_type') is-invalid @enderror" name="user_type" required>

              <option selected disabled value="">User Type</option>
              @forelse($userTypes as $userType)
              <option @if($userType->user_type == $user->user_type) selected @endif  value="{{$userType->user_type}}">{{$userType->user_description}}</option>
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
        <div class="col-md-3 mb-3">
          <!-- <label for="validationDefault05">Zip</label>
          <input type="text" class="form-control" id="validationDefault05" required> -->
        </div>
      </div>
      <button class="btn btn-primary" type="submit">update</button>
    </form>
  @else





  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('usemaster.user.add') }}">
        @csrf
      <div class="modal-body">
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user-name" name="user_name">

              @error('user_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col-md-6 mb-3">
            <label for="recipient-name" class="col-form-label">Login Name:</label>
            <input type="text" class="form-control @error('login_id') is-invalid @enderror" id="user-name" name="login_id">

              @error('login_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="message-text" class="col-form-label">Email :</label>
            <input type="text" class="form-control @error('email_id') is-invalid @enderror" id="user-name" name="email_id">

              @error('email_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col-md-6 mb-3">
            <label for="message-text" class="col-form-label">Mobile Number :</label>
            <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="user-name" name="mobile_number">

              @error('mobile_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="message-text" class="col-form-label">Password :</label>
            <input type="text" class="form-control @error('user_key') is-invalid @enderror" id="user-name" name="user_key" required>

              @error('user_key')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col-md-6 mb-3">
            <label for="message-text" class="col-form-label">Confirm Password :</label>
            <input type="text" class="form-control @error('confirm_user_key') is-invalid @enderror" id="user-name" name="user_key_confirmation" required>

              @error('user_key_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="message-text" class="col-form-label">User Type :</label>
            <select class="form-control @error('user_type') is-invalid @enderror" name="user_type" required>

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
          <div class="col-md-6 mb-3">
            <label for="message-text" class="col-form-label">Status :</label>
            <select class="form-control @error('isactive') is-invalid @enderror" name="isactive" required>

              @error('')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                  <option selected disabled value="">Status</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
          </div>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add User</button>
        </div>
      </form>
    </div>
  </div>
</div>










    
  @if(!empty(session('message')))
    <div class="alert alert-{{session('type')}}  mt-4 mb-4" >{{session('message')}}</div>
  @endif
 
      <form class="form-row mt-4 mb-4">
        @csrf
          <div class="col-lg-3 col-md-12 mb-2">
              <input class="form-control" name="user_name" placeholder="Name">
          </div>
          <div class="col-lg-3 col-md-12 mb-2">
              <input class="form-control" name="email_id" placeholder="Email">
          </div>
          <div class="col-lg-2 col-md-12 mb-2">
              <input class="form-control" name="mobile_number" placeholder="Phone Number">
          </div>
          <div class="col-lg-2 col-md-12 mb-2">
              <select class="form-control" name="isactive">
                  <option selected disabled value="">Status</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
          </div>
          <div class="col-lg-2 col-md-12 mb-2">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fa fa-plus"> Add</i></button>
          </div>
      </form>
      <hr>
  </div>

  <div class="container">
      <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">User Name</th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Phone Nuber</th>
              <th class="th-sm">Type</th>
              <th class="th-sm">Group</th>
              <th class="th-sm">Status</th>
              <th class="th-sm">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($usermaster as $user)
              <tr>
                <td>{{$user->user_name}}</td>
                <td>{{$user->email_id}}</td>
                <td>{{$user->mobile_number}}</td>
                <td>{{$user->user_description}}</td>
                <td>{{$user->group_name}}</td>
                <td>@if($user->isactive === 0) inactive @else active @endif</td>
                <td><a href="{{ route('usermaster.user.edit', $user->user_id) }}">Edit</a></td>
              </tr>
            @empty
            <tr>
              <td width="100">No record found</td>
            <tr>
            @endforelse
              
          </tbody>
          <!-- <tfoot>
            <tr>
              <th>Name
              </th>
              <th>Position
              </th>
              <th>Office
              </th>
              <th>Age
              </th>
              <th>Start date
              </th>
              <th>Salary
              </th>
            </tr>
          </tfoot> -->
        </table>
    @endif
  </div>












      

      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>