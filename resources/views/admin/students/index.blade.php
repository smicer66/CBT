@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {!! "Users".link_to_route('admin.users.students.create',"Add New Student", [], ['class' => 'btn btn-info
                pull-right']) !!}
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="container-fluid">

        <div class="row">
            @if(Session::has('message'))
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of all Students
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @if($students)
                            <div class="dataTable_wrapper">
                                <table class="table table-striped display" id="studentsTable">
                                    <thead>
                                    <tr>
                                        <th>{{ "Identity Number" }}</th>
                                        <th>{{ "Student Name" }}</th>
                                        <th>{{ "Class" }}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td> {!! $student->identity_no !!}</td>
                                            <td>{!! $student->first_name !!} {!! $student->last_name !!}</td>
											<td>{{$student->class_==NULL ? "" : $student->class_->name}} {{$student->class_==NULL || $student->classArm==NULL ? "" : $student->classArm->arm_name}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success" onclick="">Actions
                                                    </button>
                                                    <button type="button" class="btn btn-success dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul id="actions" class="dropdown-menu" role="menu">
                                                        <li>{!! link_to_route('admin.users.students.edit', 'Edit',
                                                            [$student->id]) !!}
                                                        </li>
                                                        <li>{!! link_to_route('admin.users.students.delete',"Delete",
                                                            [$student->id],
                                                            ['class' => 'delete']) !!}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
    {{--{!! HTML::style('css/jquery.dataTables.min.css')!!}--}}
    {{--{!! HTML::script('js/jquery.dataTables.min.js')!!}--}}
    <script>
        $(document).ready(function () {
            $('#studentsTable').DataTable({
                renderer: "bootstrap"
            });
        });
    </script>
@stop
