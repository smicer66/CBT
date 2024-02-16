@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "Users".link_to_route('admin.users.create',"Add New User", [], ['class' => 'btn btn-info pull-right']) !!}
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
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of all users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                @if($users)
                                    <table class="table table-striped table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>{{ "First Name" }}</th>
                                            <th>{{ "Last Name" }}</th>
                                            <th>{{ "Role" }}</th>
                                            <th>{{ "Date Created" }}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{!! $user->first_name !!}</td>
                                                <td>{!! $user->last_name !!}</td>
                                                <td>{!! ucwords($user->role->name) !!}</td>
                                                <td> {!! date('d-m-Y',$user->created_at->timestamp) !!}</td>
                                                {{--<td>--}}
                                                    {{--{!! Form::open(['method' => 'DELETE', 'route' => ['admin.users.destroy', $user->id]]) !!}--}}
                                                    {{--{!! Form::submit("Delete",array("onClick" => "return confirm('Sure you want to delete this user ?')","class" => "btn btn-danger")) !!}--}}
                                                    {{--{!! Form::close() !!}--}}
                                                {{--</td>--}}
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" onclick="">Actions</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle"
                                                                data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul id="actions" class="dropdown-menu" role="menu">
                                                            <li>{!! link_to_route('admin.users.edit', 'Edit', [$user->id]) !!}</li>
                                                            @if($user->id != Auth::user()->id)
                                                                <li>{!! link_to_route('admin.users.delete',"Delete", [$user->id],
                                                                    ['class' => 'delete']) !!}
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
            $('#dataTables-example').DataTable({
                renderer: "bootstrap"
            });
        });
        $('.delete').on('click', function () {
            return confirm('Sure you want to delete this user?');
        });
    </script>
@stop
