@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "All Departments".link_to_route('admin.departments.create',"Add New Department", [], ['class' => 'btn btn-info pull-right']) !!}
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
                                @if($departments->count()>0)
                                        <table class="table" id="departmentsTable">
                                            <thead>
                                            <tr>
                                                <th>{!! "Name" !!} <a href="#" name="created_at" class="order"></a></th>
                                                <th>{!! "Faculty" !!} <a href="#" name="created_at" class="order"></a></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($departments as $department)
                                                <tr>
                                                    <td>{{ $department->name }}</td>
                                                    <td> {{ $department->faculty->name }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success" onclick="">Actions</button>
                                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul id="actions" class="dropdown-menu" role="menu">
                                                                <li>{!! link_to_route('admin.departments.edit',"View/Edit", [$department->id]) !!}</li>
                                                                <li>{!! link_to_route('admin.courses.manage',"Manage Courses", [$department->id]) !!}</li>
                                                                <li>{!! link_to_route('admin.departments.delete','Delete', [$department->id], ['class' => 'delete']) !!}
                                                                </li>
                                                                {{--<li>--}}
                                                                    {{--{!! Form::open(['method' => 'DELETE', 'route' => ['admin.departments.destroy', $department->id]]) !!}--}}
                                                                    {{--{!! Form::submit("Delete",array("onClick" => "return confirm('Sure you want to delete this department ?')")) !!}--}}
                                                                    {{--{!! Form::close() !!}--}}
                                                                {{--</li>--}}
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                @else
                                    {!! "There are currently no departments at this time " !!}
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
        $(document).ready(function() {
            $('#departmentsTable').DataTable({
                responsive: true
            });
        });
        $('.delete').on('click', function() {
            return confirm('Sure you want to delete this Department?');
        });
    </script>
@stop
