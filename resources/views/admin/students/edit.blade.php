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
                            @if($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="col-sm-12">
                                {!! Form::model($student, array('method' => 'put','route' => array('admin.users.students.update',$student->id))) !!}
                                <div class="form-group">
                                    {!! Form::label('first_name', "First Name" . ':') !!}
                                    {!! Form::text('first_name',$student->first_name, array('class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('last_name', "Last Name" . ':') !!}
                                    {!! Form::text('last_name',$student->last_name, array('class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('identity_no', "Identity Number" . ':') !!}
                                    {!! Form::text('identity_no',$student->identity_no, array('class' => 'form-control')) !!}
                                </div>
								
								
								<div class="form-group" style="width: 200px;">
									{!! Form::label('class', "Student Class" . ':') !!}
									{!! Form::select('level',[NULL=>'-Select One-'] + $levels,$student->class_id."|||".$student->class_arm_id,array('class' => 'form-control')) !!}
								</div>
			
								

                                {{--<div class="form-group" style="width: 200px;">--}}
                                    {{--{!! Form::label('faculty', "Student Faculty" . ':') !!}--}}
                                    {{--{!! Form::select('faculty',$faculties,$student->faculty,array('class' => 'form-control')) !!}--}}
                                {{--</div>--}}

                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <div class="pull-left">
                                        {!! Form::submit("Save",array('class' => 'btn btn-primary','onClick' => 'this.form.submit(); this.disabled=true; this.value=\'Saving\'')) !!}
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
