@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit A Faculty</h1>
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
            <div class="row">
                <div class="pull-right" style="padding-right: 20px;">
                    <a class="btn btn-default" href="javascript:history.back('-1')">{!! "Back" !!}</a>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>{!! "View/Edit a Faculty" !!}</b>
                    </div>

                    <div class="panel-body">
                        {!! Form::model($faculty, array('method' => 'PUT','route' => array('admin.faculties.update',$faculty->id))) !!}

                        <div class="form-group">
                            {!! Form::label('name', "Name of Faculty" . ':') !!}
                            {!! Form::text('name',$faculty->name, array('class' => 'form-control')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('code', "Faculty Code" . ':') !!}
                            {!! Form::text('code',$faculty->code, array('class' => 'form-control')) !!}
                        </div>

                        {{--<div class="form-group" style="width: 300px;">--}}
                        {{--{!! Form::label('department_offering', "Department Offering this Course" . ':') !!}--}}
                        {{--{!! Form::select('department_offering',$departments, $course->department_offering, array('class' => 'form-control')) !!}--}}

                        {{--</div>--}}


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
