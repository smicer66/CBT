@extends('app')

@section('content')


		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Upload Master List of Student Users
						<small class="text-muted">Upload All Users</small>
					</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					@if ($errors->any())
						<div class="alert alert-danger">
							<strong>Whoops!</strong> The file you uploaded is not in the valid
							format<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3>Instructions</h3>
								</div>
								<div class="panel-body">
									<ol>
										<li class="text-info">Download the template for uploading users by clicking the
											link
											below.
										</li>
										<li class="text-info">Fill out the template.</li>
										<li class="text-info">Upload the template on this page when you are done.</li>

									</ol>
								</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<nav>
									<ul class="nav nav-pills">
										<li><a href="{{url('/admin/users/template')}}"><i
														class="fa fa-download"></i> Click here to download users
												template</a></li>
									</ul>
								</nav>
							</div>
						</div>
						<div class="dataTable_wrapper">
							{!! Form::open(['route' => 'admin.users.template', 'method' => 'post', 'files' => true, 'role' => 'form']) !!}
							<!--  Form Input field -->
							<div class="form-group">
								{!! Form::label('users', 'Upload Users') !!}
								{!! Form::file('users', ['class' => 'form-control']) !!}
								<span class="help-block">Upload the completed users template.</span>
								<span class="help-block text-danger">The previous users will not be overwritten.</span>
							</div>
							<div class="form-group pull-right">
								{!! Form::button('upload <i class="fa fa-upload"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
							</div>
							{!! Form::close() !!}
						</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')


	<script>
		@if(old('score_weight_type'))
		var scoreType = $('#checkScoreType');
		$('document').ready(function () {
			$('#scoreWeight').attr('disabled', false);
		});
		@endif
		$('#checkScoreType').change(function () {
					$('#scoreWeight').attr('disabled', !this.checked);
				});
		$('button').on('click', function () {
			$('form').submit();
			$('button').attr('disabled', true);
		});
	</script>
@endsection