@extends('app')

@section('content')




        <div class="container-fluid">
	        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Step Two: Create Examination - Provide Examination Details</h1>
                </div>
		        <!-- /.col-lg-12 -->
	        </div>
            <div class="row">
                <div class="col-md-12">
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
                        {!! Form::open(['route' => 'admin.exams.store']) !!}

                        <!--  Form Input field -->
						
						
						<div class="form-group">
                            {!! Form::label('course_id', 'Class') !!}: {{$className}}
                        </div>
						
						
						
						
                        <div class="form-group">
                            {!! Form::label('course_id', 'Subject') !!}

                            {!! Form::select('course_id', $courses , null , ['class' => 'form-control']) !!}
                        </div>

                        <!-- Title Form Input field -->
                        <div class="form-group">
                            {!! Form::label('title', 'Title:') !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>
                        <!--  Form Input field -->
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('no_of_questions', 'Number of questions') !!}--}}
                            {{--{!! Form::input('number','no_of_questions', null, ['class' => 'form-control', 'min' => 1, 'max' => 10000]) !!}--}}
                            {{--<span class="help-block">Specify the number of questions you want students to answer</span>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="checkbox">--}}
	                            {{--<label>--}}
		                            {{--{!! Form::checkbox('score_weight_type', 1, null, ['id' => 'checkScoreType']) !!}--}}
		                            {{--All questions have equal score--}}
	                            {{--</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::input('number', 'question_score_weight', null,['placeholder' => 'Question Score weight', 'class' => 'pull-right form-control', 'id' => 'scoreWeight', 'min' => 0, 'max' => 10000, 'disabled']) !!}--}}
                            {{--<span class="help-block">If all questions have same score, type the score here.</span>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('duration', 'Duration of Examination') !!}--}}
                            {{--<div class="input-group">--}}
	                            {{--{!! Form::input('number', 'duration', 'Duration', ['class' => 'form-control', 'min' => 0, 'max' => 14400]) !!}--}}
	                            {{--<span class="input-group-addon">minutes</span>--}}
                            {{--</div>--}}
                            {{--<span class="help-block">Time allowed for the exam </span>--}}
                        {{--</div>--}}


                        <div class="form-group">
                            {!! Form::label('instructions', 'Examination Instructions') !!}
                            {!! Form::textarea('instructions', null, ['class' => 'form-control']) !!}
                        </div>

                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('exam_date', 'Examination Date') !!}--}}
                            {{--{!! Form::input('date','exam_date', null, ['class' => 'form-control']) !!}--}}
                        {{--</div>--}}

                        <div class="form-group pull-right">
                            {!! Form::button('Next <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
                        </div>
						<input type="hidden" name="class_id" value="{{$class_id}}" />
						<input type="hidden" name="class_arm_id" value="{{$class_arm_id}}" />
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
			$('document').ready(function() {
				$('#scoreWeight').attr('disabled', false);
			});
		@endif
		$('#checkScoreType').change(function() {
			$('#scoreWeight').attr('disabled',!this.checked);
		});
		$('button').on('click', function(){
			$('form').submit();
			$('button').attr('disabled', true);
		});
	</script>
@endsection