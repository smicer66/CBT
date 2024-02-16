@extends('app')

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {!! "Create a new Faculty" !!}
            </h1>

        </div>
    </div>

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

    <div class="col-md-6">
        {!! Form::open(['url' => 'admin/faculties','class' => 'form']) !!}
        <div class="form-group">
            {!! Form::label('name', "Name of Faculty" . ':') !!}
            {!! Form::text('name',Input::old('name'), array('class' => 'form-control')) !!}
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
            {!! Form::label('code', "Faculty Code" . ':') !!}
            {!! Form::text('code',Input::old('code'), array('class' => 'form-control')) !!}
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
@stop