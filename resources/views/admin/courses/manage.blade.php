@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "Courses in the department of ".$department->name !!}
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">

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
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                @if($courses->count()>0)
                                    <table class="table table-striped table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>{!! "Title" !!} <a href="#" name="created_at" class="order"></a></th>
                                            <th>{!! "Code" !!} <a href="#" name="created_at" class="order"></a></th>
                                            <th>{!! "Department" !!} <a href="#" name="created_at" class="order"></a></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $course->title }}</td>
                                                <td> {{ $course->code }}</td>
                                                <td>{{ $course->department->name }}</td>
                                                <td>{!! link_to_route('admin.courses.edit',"View/Edit", [$course->id], ['class' => 'btn btn-success']) !!}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.courses.destroy', $course->id]]) !!}
                                                    {!! Form::submit("Delete",array("onClick" => "return confirm('Sure you want to delete this course ?')","class" => "btn btn-danger")) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                @else
                                    {!! "There are currently no courses at this time " !!}
                                @endif
                                <div>&nbsp;</div>
                                <div class="pull-left">{!! link_to('admin/courses/create/'.$department->id,"Add New Course",['class' => 'btn btn-info pull-right'])  !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
@stop
