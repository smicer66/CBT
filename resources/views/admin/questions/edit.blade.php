@extends('app')

@section('content')


		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Examinations | Questions</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<nav>
						<ul class="nav nav-tabs">
{{--							<li><a href="{{url('/admin/exams/'. $question->examination->id . '/questions')}}"><i class="fa arrow pull-left"></i> Back</a></li>--}}
							<li><a href="{{URL::previous()}}"><i class="fa arrow pull-left"></i> Back</a></li>
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

										<li>All Option fields are required. Please Check your input</li>

										@foreach ($errors->get('correct_answers') as $error)
											<li>{{$error}}</li>
										@endforeach
									</ul>
								</div>
							@endif
							<div class="dataTable_wrapper">
								<form action="/admin/question/edit-question" method="post" enctype="multipart/form-data">

								<div class="form-group">
									<div class="col-md-12">

										{!! Form::label('title', 'Question:') !!}
										<textarea name='title' class='form-control' style="height:200px;">{{$question->title}}</textarea><br />
										<div class="col-md-4">Upload Question Image: </div><div class="col-md-8"><input type="file" name="uploadQuestionImages" /></div>
									</div>
									<div class="col-md-12" style="padding-bottom: 70px;">
									@if($questionImage!=NULL)
									<div class="col-md-12"><u>Current Question Images</u></div>
										@foreach($questionImage as $qi)
											<div class="col-md-3">
												<img src="/questions/{{$qi->image_url}}" class="col-md-12" /><br />
												<a href="/admin/exams/questions/deleteimage/{{\Crypt::encrypt($qi->id)}}">Delete</a>
											</div>
										@endforeach
									@endif
									</div>
									
								</div>
								
								<div style="padding-bottom: 70px;">
									<h5 style="padding-left:10px;"><strong><u>OPTIONS</u></strong></h5>
									<input type="hidden" name="question_id" value="{{$question->id}}" />
									<?php
									$arr = array();
									?>
									@foreach($question->options as $key => $option)
										<div class="form-group" style="clear:both">
											<div class="col-md-5">
												{!! Form::label('option', 'Option ' . (1 + $key), ['class' => 'control-label']) !!}
												{!! Form::text('options[' . $option->id . ']', $option->title, ['class' => 'form-control']) !!}
												<label>
													{!! Form::checkbox('correct_answers[' . $option->id . '][]', $option->id, $option->correct_answer) !!}
													Correct
												</label>
											</div>
											<div class="col-md-3" style="padding-top:30px;">
												<input type="file" name="uploadOption{{($option->id)}}" />
											</div>
											<div class="col-md-3" style=" padding-top:20px; padding-left:50px;">
											@if($optionImages!=NULL)
											
												@foreach($optionImages as $optionImage)
													@if($optionImage->option_id == $option->id)
													<span style="font-size:10px;">Current Option Image:</span><br />
													<img src="/options/{{$optionImage->image_url}}" class="col-md-12" /><br />
													<a href="/admin/exams/questions/deleteoptionimage/{{\Crypt::encrypt($optionImage->id)}}">Delete</a>
													@endif
												@endforeach
											@endif
											</div>
										</div>
										<?php
										array_push($arr, $option->id);
										?>
									@endforeach
									
									<input name="arr" type="hidden" value="{{join(',', $arr)}}" />
								</div>
								
								
                                <div class="form-group" style="clear:both">
                                    <div class="col-md-7" style="padding-top: 30px;">
                                        <u>{!! Form::label('score_weight', 'Score:') !!}</u>
                                        {!! Form::text('score_weight', $question->score_weight, ['class' => 'form-control']) !!}
                                    </div>
                                </div>



                                <div class="form-group" style="padding-top:10px; clear:both">
									<div class="col-md-5">
										{!! Form::button('Update', ['class' => 'form-control btn btn-primary', 'type' => 'submit']) !!}
									</div>
								</div>
								
								<?php
								echo Form::token();
								?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection