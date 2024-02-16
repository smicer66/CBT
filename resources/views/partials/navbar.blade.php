<div class="navbar-header" style="">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="dashboard">
		<img src="/img/glist.gif" alt="" class="img-responsive">
	</a>
	<div style=" float:left; padding-top: 15px; font-size:25px; color:#0033FF; font-family:Verdana, Arial, Helvetica, sans-serif"><strong>{{env('APP_NAME')}}</strong></div>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">

	<!-- /.dropdown -->
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
		</a>
		@if(Auth::user())
			<ul class="dropdown-menu dropdown-user">
				<li><a href="#"><i
								class="fa fa-user fa-fw"></i> {{ Auth::user()->first_name . ' ' .Auth::user()->last_name }}
					</a>
				</li>
				<li class="divider"></li>
{{--				@if(isset($examination))--}}
{{--					@if(! $examination->examinationUsers()->where('user_id', \Auth::user()->getKey())->first()->status == 'active')--}}
                @if( \Request::route()->uri() != 'client/examinations/{examinations}')
					<li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
					</li>
                @endif
				{{--@else--}}
					{{--<li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>--}}
					{{--</li>--}}
				{{--@endif--}}
			</ul>
			<!-- /.dropdown-user -->
		@endif
	</li>
	<!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->
