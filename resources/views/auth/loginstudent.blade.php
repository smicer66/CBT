@extends('login')

@section('content')
<div class="container-fluid login-container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="login-panel panel panel-default">
				<div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-responsive center-block" src="/img/glist.gif" alt=""/>
                        </div>
                        <div class="col-md-8">
                            <h1 class="text-center text-uppercase">Student Login</h1>
                            <hr/>


					    @if (count($errors) > 0)
						    <div class="alert alert-danger">
							    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    							<ul>
	    							@foreach ($errors->all() as $error)
		    							<li>{{ $error }}</li>
			    					@endforeach
				    			</ul>
					    	</div>
    					@endif

   						<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="col-md-4 control-label">Identity number</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="identity_no" value="{{ old('identity_no') }}">
								</div>
								<div class="" style="clear:both">&nbsp;</div>
								<!--<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password" value="">
								</div>-->
							</div>
	                        <input hidden name="student" />
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success pull-right">Login</button>
								</div>
                                <div style="">&nbsp;</div>
                                <div style="padding:5px; text-align:right" class="col-md-10"><a href="/auth/login">Login as staff</a></div>
							</div>
						</form>
   					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
