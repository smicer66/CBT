@extends('back.template')

@section('main')

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				{!! "Create a new Department in the faculty of ".$faculty->name !!}
			</h1>
			<ol class="breadcrumb">
				<li class="active">
					{{--<span class="fa fa-{{ "user" }}"></span> {!! link_to('admin/departments', 'Departments').'/create' !!}--}}
					<span class="fa fa-{{ "user" }}"></span> {!! 'Departments/create' !!}
				</li>
			</ol>
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

	<div class="col-sm-12">
		{!! Form::open(['url' => 'admin/departments','class' => 'form-horizontal panel']) !!}
		<div class="form-group">
			{!! Form::label('name', "Name of Department" . ':') !!}
			{!! Form::text('name',Input::old('name'), array('class' => 'form-control')) !!}
			{!! Form::hidden('faculty_id',$faculty->id) !!}
		</div>

		{{--<div class="form-group" style="width: 300px;">--}}
		{{--{!! Form::label('faculty_id', "This Department's Faculty" . ':') !!}--}}
		{{--{!! Form::select('faculty_id',$faculties,null, array('class' => 'form-control')) !!}--}}
		{{--</div>--}}

		<div class="form-group">
		</div>
		<div class="form-group">
			<div class="pull-left">
				{!! Form::submit("Save",null,array('class' => 'btn btn-primary')) !!}
			</div>
			<div class="pull-right">
				<a class="btn btn-danger" href="javascript:history.back('-1')">{!! "Cancel" !!}</a>
			</div>
		</div>
		{!! Form::close() !!}


	</div>

@stop