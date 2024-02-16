@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">View/Edit A Subject</h1>
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
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                            {!! Form::model($course, array('method' => 'PUT','route' => array('admin.courses.update',$course->id))) !!}

                            <div class="form-group">
                                {!! Form::label('title', "Title of Course" . ':') !!}
                                {!! Form::text('title',$course->title, array('class' => 'form-control')) !!}
                            </div>





                            {{--<!--  Form Input field -->--}}
                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('course_material122', 'Any Previously Uploaded Course Material:') !!}--}}
                                {{--{!! $course->course_material != null ? HTML::link('/uploads/course_materials/'.$course->course_material,"Uploaded Course Material",[]) : "None" !!}--}}

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
                            {{--<div class="clearfix"></div>--}}
                            {!! Form::close() !!}
                            
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
