@extends('app')

@section('content')


		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">{{$examination->title}}
						<br />
						<small class="text-muted">Upload Questions</small>
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
					@if(! $examination->isActive)
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3>Instructions</h3>
								</div>
								<div class="panel-body">
									<ol>
										<li class="text-info">Download the template for this examination by clicking the
											link
											below.
										</li>
										<li class="text-info">Fill out the template.</li>
										<li class="text-info">Upload the template on this page when you are done.</li>
										<li class="text-info">You can find a link to this page anytime when you view
											details of
											an examination.
										</li>
									</ol>
								</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<nav>
									<ul class="nav nav-pills">
										<li><a href="{{url('/admin/exams/' . $examination->id . '/template')}}"><i
														class="fa fa-download"></i> Click here to download questions
												template</a></li>
									</ul>
								</nav>
							</div>
						</div>
						<div class="dataTable_wrapper">
							{!! Form::open(['action' => 'QuestionsController@store', 'method' => 'post', 'files' => true, 'role' => 'form']) !!}
							<!--  Form Input field -->
							<div class="form-group">
								{!! Form::label('questions', 'Upload Questions') !!}
								{!! Form::file('questions', ['class' => 'form-control']) !!}
								<span class="help-block">Upload the completed question template.</span>
								<span class="help-block text-danger">The previous questions will be overwritten.</span>
							</div>
							{!! Form::hidden('examination_id', $examination->id) !!}
							<div class="form-group pull-right">
								{!! Form::button('upload <i class="fa fa-upload"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
							</div>
							{!! Form::close() !!}
						</div>
					@else
						<p class="text-info">Questions cannot be uploaded when an examination is set to be taken or has
							been taken.</p>
					@endif
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