@extends('app')

@section('content')


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Questions</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Examination Details</h3>
				<div class="col-lg-3 clear-fix"><b>Examination Title:</b></div><div class="pull-left col-lg-7">{{$examination->title}}</div>
				<div class="col-lg-3 clear-fix"><b>Course:</b></div><div class="pull-left col-lg-7">{{$examination->course->title}}</div>
				<div class="col-lg-3  clear-fix"><b>Time Allocated:</b></div><div class="pull-left col-lg-7">{{$examination->duration}}</div>
				<div class="col-lg-3 clear-fix"><b>Status of Examination:</b></div><div class="pull-left col-lg-7">{{$examination->status}}</div>
				<div class="col-lg-3 clear-fix"><b>Scheduled Date:</b></div><div class="pull-left col-lg-7">{{$examination->exam_date}}</div>
			</div>
			<div>&nbsp;</div>
			<!-- /.col-lg-12 -->
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					@if(count($questions))
						@if($questions->first()->examination->status == 'active' || $questions->first()->examination->hasBeenWritten)
							<div class="alert alert-dismissible alert-warning">
								<button type="button" class="close" data-dismiss="alert">&times; </button>
								Questions cannot be updated or deleted because the exam has been set, ended or has been
								written
							</div>
						@endif
					@endif
					<nav>
						<ul class="nav nav-tabs nav-justified">
							<li><a href="/admin/exams/" {{URL::previous()}}><i class="fa arrow pull-left"></i> Back</a>
							</li>
							@if($examination->status == 'created')
								<li><a href="/admin/exams/{{$examination->id}}/questions/upload"><i
												class="fa fa-upload pull-left"></i>upload questions</a></li>
							@endif
						</ul>
					</nav>
					<?php
					$i = 1;
					?>
					@if(count($questions))
							<div class="col-lg-8 col-lg-offset-2">
								<div>&nbsp;</div>
								<p class="text-info">Options highlighted in green are the correct answers</p>
							</div>
						@foreach($questions as $key => $question)
							<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-lg-10  col-lg-offset-1">
									<p class="form-control-static lead"><b>{{$i++}}. {{$question->title}} ({{$question->score_weight!=null ? $question->score_weight : 0}}) marks</b>
									<div class="col-md-12">
										@foreach($questionImages as $qi)
											@if($qi->question_id == $question->id)
											<div class="col-md-4">
												<img src="/questions/{{$qi->image_url}}" class="col-md-12" />
											</div>
											@endif
										@endforeach
									</div>
									</p>
									<div style="clear:both">
										@foreach($question->options as $option)
											@if($option->correct_answer )
											<div style="border: 1px solid #ddd;clear:both; padding-left:10px" class="form-control-static  list-group-item-success ">
											{{$option->title}}<span class="text-success pull-right"><i class="fa fa-check-circle"></i></span><br />
											@else
											<div style="border: 1px solid #ddd;clear:both;  padding-left:10px" class="form-control-static">
											{{$option->title}}<br />
											@endif
											@if($optionImages->count()>0)
														@foreach($optionImages as $qi)
															@if($option->id == $qi->option_id)
																<img src="/options/{{$qi->image_url}}" class="col-md-4" vspace="20" />
															@endif
														@endforeach
											@endif		
											<div class="col-md-12" style="clear:both">&nbsp;</div>
											</div>
										@endforeach
									</div>
								</div>

								<div class="col-lg-10 col-lg-offset-1">
									<div class="form-group pull-right">
										@if(! $question->examination->isActive && !$question->examination->isArchived && !$question->examination->hasBeenWritten)
											{!! Form::open(array('url' => '/admin/exams/questions/' . $question->id)) !!}
											<a href="{{url('/admin/exams/questions/' . $question->id .'/edit')}}"
											   class="btn btn-info">Edit</a>
											{!! Form::hidden('_method', 'DELETE') !!}
											{!! Form::submit('Delete this Question', array('class' => 'btn btn-danger', "onClick" => "return confirm('Sure you want to delete this question?')")) !!}
											{!! Form::close() !!}
										@endif
									</div>
								</div>
							</div>
						</div>
						@endforeach
						<?php echo $questions->render(); ?>
					@else
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-md-10">
									<p class="lead">No Questions associated with this Examination</p>
								</div>
							</div>
						</div>

					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content load_modal">
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$('#editModal').on('hidden.bs.modal', function () {
			$(this).removeData('bs.modal');
		});
	</script>
	@if($errors->any())
		<script>
			$("#edit").attr('href', '')
		</script>
	@endif
@stop
