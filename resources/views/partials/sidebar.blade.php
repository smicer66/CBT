

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
	        <!--if(Auth::user() and Auth::user()->isStaff())-->
		    <li  {!! Request::is('admin/dashboard') ? 'class="active"' : '' !!}>
                <a href="/admin/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>

                <li {!! Request::is('admin/faculties') ? 'class="active"' : '' !!}>
                    <a href="#"><i class="fa fa-building fa-fw"></i> Faculties<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{!! url('admin/faculties') !!}">{{ "See All" }}</a></li>
                        <li><a href="{!! url('admin/faculties/create') !!}">{{ "Add New" }}</a></li>
                    </ul>
                </li>

                <li {!! Request::is('admin/departments') ? 'class="active"' : '' !!}>
                    <a href="#"><i class="fa fa-building-o fa-fw"></i> Departments<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{!! url('admin/departments') !!}">{{ "See All" }}</a></li>
                        <li><a href="{!! url('admin/departments/create') !!}">{{ "Add New" }}</a></li>
                    </ul>
                </li>
				
				


		        

			<!--if(Auth::user() and Auth::user()->isAdmin())-->
				<li {!! Request::is('admin/departments') ? 'class="active"' : '' !!}>
                    <a href="#"><i class="fa fa-building-o fa-fw"></i> Classes<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{!! url('admin/class') !!}">{{ "See All" }}</a></li>
                        <li><a href="{!! url('admin/class/step-one') !!}">{{ "Add New" }}</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li {!! Request::is('admin/courses') ? 'class="active"' : '' !!}>
                    <a href="#"><i class="fa fa-book fa-fw"></i> Subjects<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{!! url('admin/courses') !!}">{{ "See All" }}</a></li>
                        <li><a href="{!! url('admin/courses/create') !!}">{{ "Add New" }}</a></li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
				
				<li {!! Request::is('admin/exams') ? 'class="active"' : '' !!}>
					<a href="#"><i class="fa fa-file fa-fw"></i>Examinations<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="{{action('AdminExaminationsController@index')}}"><i class="fa fa-list fa-fw"></i> View all</a>
						</li>
						<li>
							<a href="{{action('AdminExaminationsController@create')}}"><i class="fa fa-pencil fa-fw"></i> New</a>
						</li>
	
					</ul>
				</li>
		        <li {!! Request::is('admin/users') ? 'class="active"' : '' !!}>
			        <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
			        <ul class="nav nav-second-level">
				        <li><a href="{!! url('admin/users') !!}">{{ "See All Staff" }}</a></li>
				        <li><a href="{!! url('admin/users/students') !!}">{{ "See All Students" }}</a></li>
				        <li><a href="{!! url('admin/users/create') !!}">{{ "Add New Staff" }}</a></li>
				        <li><a href="{!! url('admin/users/students/create') !!}">{{ "Add New Student" }}</a></li>
				        <li><a href="{!! url('admin/users/createMasterList') !!}">{{ "Upload Student Master List" }}</a></li>
			        </ul>
			        <!-- /.nav-second-level -->
		        </li>

                <li {!! Request::is('admin/results') ? 'class="active"' : '' !!}>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Results<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{!! url('admin/results') !!}">View all</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
	        <!--endif-->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
