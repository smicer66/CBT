{{--{!! dd($examination->exam_date_object) !!}--}}

@extends('app')

@section('content')


		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Examinations</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<nav>
						<ul class="nav nav-tabs">
							<li><a href="/admin/exams/" {{$examination->id}}><i class="fa arrow pull-left"></i> Back</a></li>
						</ul>
					</nav>
					<div class="panel panel-default">
						<div class="panel-heading">
							Edit
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							@if ($errors->any())
								<div class="alert alert-danger">
									<strong>Whoops!</strong> There were some problems with your input.<br><br>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							<div class="dataTable_wrapper">
								{!! Form::model($examination, ['method' => 'PATCH', 'action' => ['AdminExaminationsController@update', $examination->id]]) !!}
								<!--  Form Input field -->
								<div class="form-group">
									<div class="col-md-12">
										{!! Form::label('course_id', 'Subject') !!}
										<div class="col-md-12">{{$examination->course->title}}</div>
									</div>
								</div>
								<!-- Title Form Input field -->
								<div class="form-group">
									<div class="col-md-12">
										{!! Form::label('title', 'Title:') !!}
										{!! Form::text('title', null, ['class' => 'form-control']) !!}
									</div>
								</div>
								<!--  Form Input field -->
								{{--<div class="form-group">--}}
									{{--<div class="col-md-12">--}}
										{{--{!! Form::label('no_of_questions', 'Number of questions') !!}--}}
										{{--{!! Form::input('number','no_of_questions', null, ['class' => 'form-control', 'min' => 1, 'max' => 10000]) !!}--}}
										{{--<span class="help-block">Specify the number of questions you want students to answer</span>--}}
									{{--</div>--}}
								{{--</div>--}}
								{{--<div class="form-group">--}}
									{{--<div class="col-md-12">--}}
										{{--<div class="checkbox">--}}
											{{--<label>--}}
												{{--{!! Form::checkbox('score_weight_type', 1, $examination->question_score_weight, ['id' => 'checkScoreType']) !!}--}}
												{{--All questions have equal score--}}
											{{--</label>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
								{{--<div class="form-group">--}}
									{{--<div class="col-md-12">--}}
										{{--{!! Form::input('number', 'question_score_weight', null,['placeholder' => 'Question Score weight', 'class' => 'pull-right form-control', 'id' => 'scoreWeight', 'disabled', 'min' => 0, 'max' => 10000]) !!}--}}
										{{--<span class="help-block">If all questions have same score, type the score here.</span>--}}
									{{--</div>--}}
								{{--</div>--}}
								<div class="form-group">
									<div class="col-md-12">
										{!! Form::label('duration', 'Duration of Examination', ['class' => 'control-label']) !!}
										<div class="input-group">
											{!! Form::input('number', 'duration', null, ['class' => 'form-control', 'min' => 0, 'max' => 14400]) !!}
											<span class="input-group-addon">minutes</span>
										</div>
										<span class="help-block">Time alllowed for the exam </span>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12">
										{!! Form::label('exam_date', 'Examination Date') !!}
										{{--{!! Form::input('date','exam_date', \Carbon\Carbon::instance($examination->exam_date)->format('Y-m-d'), ['class' => 'form-control']) !!}--}}
										{!! Form::input('date','exam_date', \Carbon\Carbon::parse($examination->exam_date)->format('Y-m-d'), ['class' => 'form-control']) !!}
									</div>
								</div>

								{{--<div class="form-group">--}}
								{{--<div class="col-md-12">--}}
								{{--{!! Form::label('time', 'Examination Time') !!}--}}
								{{--{!! Form::input('time','time', null, ['class' => 'form-control']) !!}--}}
								{{--</div>--}}
								{{--</div>--}}

								<div class="form-group">
									<div class="col-md-12">
                                        {!! Form::submit("Update Examination",array('class' => 'btn btn-primary','onClick' => 'this.form.submit(); this.disabled=true; this.value=\'Updating\'')) !!}
                                        {{--{!! Form::button('Create Examination', ['class' => 'form-control btn btn-primary', 'type' => 'submit']) !!}--}}
									</div>
								</div>


								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		if($("#scoreWeight").val() != null && $("#scoreWeight").val() != '')
		{
			$("#scoreWeight").attr('disabled', false);
		}
//		$('#checkScoreType').onload(function() {
//			$('#scoreWeight').attr('disabled',!this.checked)
//		});
		$('#checkScoreType').change(function() {
			$('#scoreWeight').attr('disabled',!this.checked)
		});
	</script>
@endsection