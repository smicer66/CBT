@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit A User</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="col-sm-12">
                                {!! Form::model($user, array('method' => 'put','route' => array('admin.users.update',$user->id))) !!}

                                <div class="form-group">
                                    {!! Form::label('first_name', "First Name" . ':') !!}
                                    {!! Form::text('first_name',Input::old('first_name'), array('class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('last_name', "Last Name" . ':') !!}
                                    {!! Form::text('last_name',Input::old('last_name'), array('class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('identity_no', "Identity Number" . ':') !!}
                                    {!! Form::text('identity_no',Input::old('identity_no'), array('class' => 'form-control')) !!}
                                </div>

                                {{--<div class="form-group" style="width: 200px;">--}}
                                    {{--{!! Form::label('role_id', "User Role" . ':') !!}--}}
                                    {{--{!! Form::select('role_id',$roles,$user->role_id,array('class' => 'form-control')) !!}--}}
                                {{--</div>--}}

                                <div class="form-group">
                                </div>
                                {!! Form::hidden('id',$user->id)!!}
                                <div class="form-group">
                                    <div class="pull-left">
                                        {!! Form::submit("Save",array('class' => 'btn btn-primary')) !!}
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-danger" href="javascript:history.back('-1')">{!! "Cancel" !!}</a>
                                    </div>
                                </div>

                                {!! Form::close() !!}


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
