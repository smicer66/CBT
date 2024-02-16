@extends('app')

@section('content')
    <div id="page-wrapper">

        <div class="container">
            <div class="row text-center">
                <h1>Welcome, {{ \Auth::user()->first_name }}!</h1>
                <hr/>
                <div class="alert alert-dismissible alert-warning text-center">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <h4>Please Confirm that your name and identity number are correct. Contact the administrator if they are not.</h4>
                </div>
                <h4><b>Name:</b> {{ \Auth::user()->first_name." ". \Auth::user()->last_name }}</h4>
                <h4><b>Identity Number:</b> {{ \Auth::user()->identity_no   }}</h4>
                </div>
            </div>

            <div class="row">
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
            </div>
            <div class="row">
	            <div class="container">
                    <h1 class="page-header text-center">Examinations available</h1>
                    <div class="panel panel-default">
		            @if(isset($examinations) and $examinations->count()>0 )
			            <div class="table-responsive">
				            <table class="table">
					            <thead>
					            <tr>
						            <th>{!! "Name" !!} <a href="#" name="created_at" class="order"></a></th>
						            <th>{!! "Course" !!} <a href="#" name="created_at" class="order"></a></th>
						            <th>{!! "Exam Date" !!} <a href="#" name="created_at" class="order"></a></th>
						            <th>{!! "Exam Duration (Minutes)" !!} <a href="#" name="created_at" class="order"></a></th>
						            <th>{!! "Result" !!} <a href="#" name="created_at" class="order"></a></th>
					            </tr>
					            </thead>
					            <tbody>
					            @foreach ($examinations as $examination_user)
							            <tr>
								            <td>{!! $examination_user->title !!}</td>
								            <td> {!! $examination_user->course->title !!}</td>
								            <td> {!! $examination_user->exam_date !!}</td>
								            <td> {!! $examination_user->duration !!}</td>
								            <?php $settings = $examination_user->settings->where('key',
										            'DISPLAY_RESULTS')->first();?>
								            <td>
											<?php
											$totalScore = 100;
											
											if(array_key_exists($examination_user->id, $q2))
											{
												$totalScore = $q2[$examination_user->id];
											}
											$e1 = NULL;
											if(array_key_exists($examination_user->id, $exam_ids))
											{
												$e1 = $exam_ids[$examination_user->id];
											}
											
											$e4 = $examination_user->settings->where('key','DISPLAY_RESULTS');
											?>
									            &nbsp;{!! ($e4->count()>0 &&  $e1!=NULL && isset($e1->result)) ? $e1->result." of ".($totalScore). ' marks':'N/A' !!}</td>
								            <td colspan="2">{!! $e1!=NULL && !isset($e1->result ) && $examination_user->duration > 0 ? link_to_route('client.examinations.confirm',"Take Exam", [$e1!=NULL ? $examination_user->id : 0], ['class' => 'btn btn-success']) : '&nbsp;' !!}</td>
								            @if($e1!=NULL && $e1->isActive)
									            <td colspan="2">In Progress</td>
											@endif

							            </tr>
					            @endforeach
					            </tbody>
				            </table>
                        </div>
		            @else
			            {!! "There are currently no active examinations for you at this time" !!}
		            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@stop
