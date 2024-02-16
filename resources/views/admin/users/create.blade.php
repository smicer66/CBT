@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "Create a New User" !!}
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">

            <div class="row">
                @if(Session::has('message'))
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">X</button>
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="col-sm-12">
                    {!! Form::open(['url' => 'admin/users','class' => 'form']) !!}


                    <div class="form-group">
                        {!! Form::label('first_name', "First Name" . ':') !!}
                        {!! Form::text('first_name',Input::old('first_name'), array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('last_name', "Last Name" . ':') !!}
                        {!! Form::text('last_name',Input::old('last_name'), array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('identity_no', "Identity Number" . ':') !!}
                        {!! Form::text('identity_no',Input::old('identity_no'), array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group" style="width: 200px;">
                        {!! Form::label('role_id', "User Role" . ':') !!}
                        {!! Form::select('role_id',$roles, Input::old('role_id'),array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <div class="pull-left">
                            {!! Form::submit("Save",array('class' => 'btn btn-primary','onClick' => 'this.form.submit(); this.disabled=true; this.value=\'Saving\'')) !!}
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-danger" href="javascript:history.back('-1')">{!! "Cancel" !!}</a>
                        </div>
                    </div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@endsection
