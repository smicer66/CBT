@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "Departments in the faculty of ".$faculty->name !!}
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
                                @if($departments->count()>0)
                                    <table class="table table-striped table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>{!! "Name" !!} <a href="#" name="created_at" class="order"></a></th>
                                            <th>{!! "Faculty" !!} <a href="#" name="created_at" class="order"></a></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($departments as $department)
                                            <tr>
                                                <td>{{ $department->name }}</td>
                                                <td> {{ $department->faculty->name }}</td>
                                                <td>{!! link_to_route('admin.departments.edit',"View/Edit", [$department->id], ['class' => 'btn btn-success']) !!}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.departments.destroy', $department->id]]) !!}
                                                    {!! Form::submit("Delete",array("onClick" => "return confirm('Sure you want to delete this department ?')","class" => "btn btn-danger")) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                @else
                                    {!! "There are currently no departments at this time " !!}
                                @endif
                                <div>&nbsp;</div>
                                <div class="pull-left">{!! link_to('admin/departments/create/'.$faculty->id,"Add New Department",['class' => 'btn btn-info pull-right'])  !!}</div>
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
