@extends('back.template')

@section('main')
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				{!! "Departments in the faculty of ".$faculty->name !!}
			</h1>
			<ol class="breadcrumb">
				<li class="active">
					<span class="fa fa-{{ 'user' }}"></span> {!! "Departments" !!}
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
	<div class="row col-lg-12">
		@if($departments->count()>0)
			<div class="table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th>{!! "Name" !!} <a href="#" name="created_at" class="order"></a></th>
						<th>{!! "Faculty" !!} <a href="#" name="created_at" class="order"></a></th>
					</tr>
					</thead>
					<tbody>
					@foreach ($departments as $department)
						<tr {!! 'class="warning"'!!}>
							<td>{{ $department->name }}</td>
							<td> {{ $department->faculty->name }}</td>
							<td>{!! link_to_route('admin.departments.edit',"View/Edit", [$department->id], ['class' => 'btn btn-success']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['admin.departments.destroy', $department->id]]) !!}
								{!! Form::destroy("Delete","Sure you want to delete this department ?") !!}
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		@else
			{!! "There are currently no departments at this time " !!}
		@endif
		<div>&nbsp;</div>
		<div class="pull-left">{!! link_to('admin/departments/create/'.$faculty->id,"Add New Department",['class' => 'btn btn-info pull-right'])  !!}</div>

	</div>

	<div class="row col-lg-12">
		{{--<div class="pull-right link">{!! $links !!}</div>--}}
	</div>

@stop
