@if(Session::has('message'))
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">X</button>
        {{ Session::get('message') }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">X</button>
        {{ Session::get('error') }}
    </div>
@endif
@if($errors->any())
    <ul class="alert alert-danger" style="list-style-type: none">
        @foreach($errors->all() as $error)
            <li> <small>-</small> {{ $error }}</li>
        @endforeach
    </ul>
@endif