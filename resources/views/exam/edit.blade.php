@extends('back.template')

@section('main')
	<div class="form-validation alert-success">
		@if(Session::has('message'))
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="close" data-dismiss="alert">X</button>
				{{ Session::get('message') }}
			</div>
		@endif
	</div>
	@if($errors->any())
		<ul class="alert alert-danger">
			@foreach($errors->all() as $error)
				<li> {{ $error }}</li>
			@endforeach
		</ul>
	@endif

	<div class="row">
		<div class="pull-right" style="padding-right: 20px;">
			<a class="btn btn-default" href="javascript:history.back('-1')">{!! "Back" !!}</a>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{!! "View/Edit a Department" !!}</b>
			</div>

			<div class="panel-body">
				{!! Form::model($department, array('method' => 'PUT','route' => array('admin.departments.update',$department->id))) !!}

				<div class="form-group">
					{!! Form::label('name', "Name of Department" . ':') !!}
					{!! Form::text('name',$department->name, array('class' => 'form-control')) !!}
				</div>

				{!! Form::hidden('original_faculty_id',$department->faculty_id) !!}

				{{--<div class="form-group">--}}
				{{--{!! Form::label('code', "Department Code" . ':') !!}--}}
				{{--{!! Form::text('code',$department->code, array('class' => 'form-control')) !!}--}}
				{{--</div>--}}

				<div class="form-group" style="width: 300px;">
					{!! Form::label('faculty_id', "This Department's Faculty" . ':') !!}
					{!! Form::select('faculty_id',$faculties, $department->faculty_id, array('class' => 'form-control')) !!}

				</div>


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
		</div>
	</div>

@stop