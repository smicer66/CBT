@extends('app')

@section('content')
{{--<script type="text/javascript">--}}
    {{--$(function(){--}}
       {{--$(".deleteCourse").click(function(e){--}}
           {{--e.preventDefault();--}}
           {{--var href = $(this).attr('href');--}}
           {{--if(confirm("do you want to delete this course ? All exams under this course will be deleted! ")){--}}
               {{--window.location = href;--}}
           {{--}--}}
       {{--}) ;--}}
    {{--});--}}
{{--</script>--}}
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "All Subjects".link_to_route('admin.courses.create',"Add New Subjects", [], ['class' => 'btn
                    btn-info pull-right']) !!}
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
                <div class="row col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                @if($courses->count()>0)
                                    <table class="table table-stripped" id="coursesTable">
                                        <thead>
                                        <tr>
                                            <th>{!! "Title" !!} <a href="#" name="created_at" class="order"></a></th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($courses as $course)
                                            <?php $count++; ?>
                                            <tr>
                                                <td>{{ $course->title }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" onclick="">Actions</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle"
                                                                data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul id="actions" class="dropdown-menu" role="menu">
                                                            <li>{!! link_to_route('admin.courses.edit',"View/Edit", [$course->id],
                                                                []) !!}
                                                            </li>
                                                            <li>{!! link_to_route('admin.courses.delete',"Delete", [$course->id],
                                                                ['class' => 'delete']) !!}
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    {!! "There are currently no courses at this time " !!}
                                @endif
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
        $(document).ready(function () {
            $('#coursesTable').DataTable({
                responsive: true
            });
        });
        $('.delete').on('click', function () {
            return confirm('Sure you want to delete this course ? All exams under this course will be deleted!');
        });
    </script>s
@stop
