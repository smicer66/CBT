@extends('app')

@section('content')

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">{{$examination->title}}
						<small class="text-muted">Upload candidate</small>
					</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					@if ($errors->any())
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Some errors occurred<br><br>
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
								<p class="lead">use this page to upload the list of eligible candidates for an examination</p>
								<ol>
									<li class="text-info">Download the candidate template for this examination by clicking the
										link
										below.
									</li>
									<li class="text-info">Fill out the template.</li>
									<li class="text-info">Upload the template on this page when you are done.</li>
									<li class="text-info">You can find a link to this page anytime when you view class
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
										<li><a href="{!! url('/admin/exams/' . $examination->id . '/class/template') !!}"><i
														class="fa fa-download"></i> Click here to download candidate.</a></li>
									</ul>
								</nav>
							</div>
						</div>
						<div class="dataTable_wrapper">
							{!! Form::open(['action' => ['AdminClassController@store', $examination->id], 'method' => 'post', 'files' => true, 'role' => 'form', 'id' => 'subForm']) !!}
							<!--  Form Input field -->
							<div class="form-group">
								{!! Form::label('candidates', 'Upload Candidate file') !!}
								{!! Form::file('candidates', ['class' => 'form-control']) !!}
								<span class="help-block">Upload the completed candidate template.</span>
								{{--<span class="help-block text-danger">The previous questions will be overwritten.</span>--}}
							</div>
							{!! Form::hidden('examination_id', $examination->id) !!}
							<div class="form-group pull-right">
								{!! Form::button('Manually Add Candidates <i class="fa fa-upload"></i>', ['class' => 'btn btn-success', 'type' => 'button','onClick' => 'javascript:document.getElementById("buttonClicked").value = 0']) !!}
                                {!! Form::button('upload <i class="fa fa-upload"></i>', ['class' => 'btn btn-primary', 'type' => 'button','onClick' => 'javascript:document.getElementById("buttonClicked").value = 1']) !!}
                                {!! Form::hidden('buttonClicked','',['id'=>'buttonClicked']) !!}
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