@extends('app')

@section('content')
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{$examination->title}}
					<small>Examination Instructions & Code Confirmation</small>
				</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="container">
			<div class="row">
                <div class="alert alert-warning">
                    <p class="lead">Examination Instructions</p>
                    <p>Please read the following instructions carefully. To begin, enter your authentication code and click on "Start Examination".</p>
                    <ul>
                    <?php
                    $instructions = explode('<br />',nl2br($examination->instructions));
                            if(isset($instructions)){
                                foreach($instructions as $instruction)
                                    echo "<li>".$instruction."</li>";
                            }
                    ?>
                    </ul>
                </div>

				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							@if($examination)
								@if ($errors->any())
									<div class="alert alert-danger">
										@foreach($errors->all() as $error)
											<li>{{$error}}</li>
										@endforeach
									</div>
								@endif
								<div class="col-md-12">
									<form class="form-horizontal" role="form" method="POST" action="{{ url('/client/examinations/confirm-code/'.$examination->id) }}">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">

										<div class="form-group">
											<label class="col-md-4 control-label">Authentication code</label>
											<div class="col-md-6">
												<input type="password" class="form-control" name="auth_code">
											</div>
										</div>

										<div class="form-group">
											<div class="col-md-6 col-md-offset-4">
												<button type="submit" class="btn btn-primary">Start Examination</button>
											</div>
										</div>
									</form>
								</div>
						</div>
					</div>
				</div>

			</div>
			@endif
		</div>
	</div>
@endsection

@section('scripts')
@stop