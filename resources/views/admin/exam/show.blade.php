@extends('app')

@section('content')

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{$examination->title}}
					<small>details</small>
				</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					@if($examination)
                        @if(Session::has('message'))
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">X</button>
                                {!! Session::get('message') !!}
                            </div>
                        @endif
						@if ($errors->any())
							<div class="alert alert-danger">
								@foreach($errors->all() as $error)
									<li>{{$error}}</li>
								@endforeach
							</div>
						@endif
                            <div class="col-lg-12">
                                @if($examination->hasBeenWritten)
                                    <p class="text-info">Examination has been taken by some students and therefore
                                        cannot be edited.</p>
                                @endif
                                @if( $examination->status == 'inactive')
                                    <p class="text-info">This examination has ended but you can click on 'Set Exam' to re-set the exam.</p>
                                @elseif( $examination->status == 'active')
                                    <p class="text-info">Examination cannot be edited when it is set for writing.</p>
                                @endif

                            </div>
						<table class="table">
							<tr>
								<td>Number of questions Uploaded</td>
								<td>{{count($examination->questions)}}</td>
							</tr>
							<tr>
								<td>Number of eligible candidates</td>
								<td>{{count($examination->examinationUsers)}}</td>
							</tr>
						</table>


    					<div class="col-md-12">
							<div class="col-md-6">
								@if($examination->status == 'created' || $examination->status == 'inactive')
									<div class="col-lg-4">
                                        {!! HTML::link('admin/exams/' . $examination->id . '/set', 'Set Exam', ['class' => 'btn btn-warning']) !!}
                                    </div>
                                @endif
                                @if($examination->status == 'created')
										<div class="col-lg-4">
											{!! Form::open(array('url' => '/admin/exams/' . $examination->id)) !!}
											{!! Form::hidden('_method', 'DELETE') !!}
											{!! Form::submit('Delete', ['class' => 'btn btn-danger','onClick' => 'return confirm("Sure you want to delete this examination?")']) !!}
											{!! Form::close() !!}
										</div>
    									<div class="col-lg-4">
											{!! HTML::link('admin/exams/' . $examination->id . '/edit', 'Edit', ['class' => 'btn btn-primary']) !!}
										</div>
									@endif
								</div>
								<div class="col-lg-6">
									<div class="col-lg-6">
										{!! HTML::link('admin/exams/' . $examination->id . '/questions', 'View Questions', ['class' => 'btn btn-primary']) !!}
									</div>
                                    <div class="col-lg-6">
                                        {!! HTML::link('admin/exams/' . $examination->id . '/class', 'Candidates', ['class' => 'btn btn-success']) !!}
                                    </div>
							</div>
								@if($examination->status == 'active')
									<div class="col-lg-12" style="float:right">
										{!! Form::open(array('url' => '/admin/exams/' . $examination->id . '/end', 'class' => 'form-inline')) !!}
										{!! Form::hidden('_method', 'PATCH') !!}
										{!! Form::hidden('status', "archived") !!}
										{!! Form::submit('End Examination', ['class' => 'btn btn-success', 'onClick' => 'return confirm("Sure you want to end this examination?")']) !!}
										{!! Form::close() !!}
									</div>
								@endif

						</div>
                            <div class="col-span-8" >
                                @if($examination->hasBeenWritten)
                                    <div class="form-group">
                                        <div class="col-md-12" style="padding-top: 15px;">
                                            {!! HTML::link(action('AdminExaminationsController@downloadResultSheet', [$examination->id]), 'Download Results Sheet',  ['class' => 'btn btn-primary form-control']) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('scripts')
@stop