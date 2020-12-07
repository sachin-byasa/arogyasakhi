@if(Session::has('message'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button> {{  Session::get('message') }}  </div>
@endif

@if(Session::has('warning'))
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>{{  Session::get('warning') }}  </div>

@endif

@if(Session::has('alert'))
<div class="alert alert-warning alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>{{  Session::get('alert') }}</div>

@endif