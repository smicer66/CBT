@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit A Department</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>{!! "View/Edit a Department" !!}</b>
                    </div>

                    <div class="panel-body">
                        {!! Form::model($department, array('method' => 'PUT','route' => array('admin.departments.update',$department->id))) !!}

                        <div class="form-group">
                            {!! Form::label('name', "Name of Department" . ':') !!}
                            {!! Form::text('name',$department->name, array('class' => 'form-control')) !!}
                        </div>

                        {!! Form::hidden('original_faculty_id',$department->faculty_id) !!}

                        {{--<div class="form-group">--}}
                        {{--{!! Form::label('code', "Department Code" . ':') !!}--}}
                        {{--{!! Form::text('code',$department->code, array('class' => 'form-control')) !!}--}}
                        {{--</div>--}}

                        <div class="form-group" style="width: 300px;">
                            {!! Form::label('faculty_id', "This Department's Faculty" . ':') !!}
                            {!! Form::select('faculty_id',$faculties, $department->faculty_id, array('class' => 'form-control')) !!}

                        </div>


                        <div class="form-group">
                        </div>
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
