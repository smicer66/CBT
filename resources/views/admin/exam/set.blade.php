@extends('app')

@section('content')
    {!!  HTML::style('css/daterangepicker-bs3.css')!!}


        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Set An Examination</h1>
                </div>
                <!-- /.col-lg-  12 -->
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <nav>
                        <ul class="nav nav-tabs">
                            <li><a href="/admin/exams/" {{$examination->id}}><i class="fa arrow pull-left"></i> Back</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Set Exam
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {!! Form::model($examination, ['method' => 'POST', 'action' => ['AdminExaminationsController@postSet', $examination->id]]) !!}
                            <!--  Form Input field -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('instructions', 'Exam Instructions') !!}
                                    {!! Form::textarea('instructions', null, ['class' => 'form-control']) !!}
                                    <span class="help-block">Specify the instructions you want students to see</span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('duration', 'Duration of Examination', ['class' => 'control-label']) !!}
                                    <div class="input-group">
                                        {!! Form::input('number', 'duration', $examination->duration, ['class' => 'form-control']) !!}
                                        <span class="input-group-addon">minutes</span>
                                    </div>
                                    <span class="help-block">Time alllowed for the exam </span>
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <div class="col-md-12">
                                    {!! Form::label('exam_date', 'Examination Date/Time From:',['class' => 'control-label']) !!}
                                    {!! Form::text('exam_date', "", ['class' => 'form-control','readonly' => true]) !!}
                                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                    <span class="help-block"> Click the calendar icon to select the date. </span>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('question_delivery', 'Examination Question Delivery') !!}
                                    {!! Form::select('question_delivery',array("" => "Please Select","random" => "Random","sequential" => "Sequential"),$examination->question_delivery,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('no_questions_per_page', 'Number of Questions Per Page') !!}
                                    {!! Form::select('no_questions_per_page',array("" => "Please Select",1 => "1",2 => "2",5 => "5",10 => "10",15 => "15",20 => "20",25 => "25"),$examination->no_questions_per_page,['class' => 'form-control']) !!}
                                </div>
                            </div>


                            {{--<div class="form-group">--}}
                            {{--<div class="col-md-12">--}}
                            {{--{!! Form::label('status', 'Examination Status') !!}--}}
                            {{--{!! Form::select('status',array("" => "Please Select","active" => "Active","inactive" => "Inactive"),$examination->status,['class' => 'form-control']) !!}--}}
                            {{--</div>--}}
                            {{--<span class="help-block">Please note that you have to set status to 'active' to make this examination available for students to write</span>--}}
                            {{--</div>--}}


                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('show_result', 'Show Result to Student after Examination?') !!}
                                    {!! Form::checkbox('show_result', 1, null )!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::button('Set Examination', ['class' => 'form-control btn btn-primary', 'type' => 'submit']) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! HTML::script('js/daterangepicker.js')!!}
    <script>
        $(function () {
            $('input[name="exam_date"]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        timePicker: true,
                        drops: 'up',
                        format: 'DD/MM/YYYY h:mm A',
                        timePickerIncrement: 5,
                        minDate: 01 / 01 / 2015
                    },
                    function (start, end, label) {
                    });
        });
    </script>
@endsection