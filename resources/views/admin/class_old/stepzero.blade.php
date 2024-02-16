@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "Candidates For ".$examination->title." Examination" !!}
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
                    <div class="col-lg-12">
                        {!! Form::open(['url' => '/admin/exams/' . $examination->id . '/class/step4','class' => 'form']) !!}



                        <div class="form-group">
                            <!-- /.panel-heading -->


                            <div class="panel-body col-lg-12">
                                @if(isset($students))
                                    <table class="table table-striped table-responsive" id="studentsTable">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">Select All<br><input type="checkbox" onclick="javascript:selectAll();" id="selectAll"> </th>
                                            <th style="width: 130px;">{{ "First Name" }}</th>
                                            <th>{{ "Last Name" }}</th>
                                            <th>{{ "Identity Number" }}</th>
                                            <th>{{ "Examination Code" }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($students as $student)

                                            <tr>
                                                <td style="text-align: center"><input  name="studentsList[]" value={!! $student->id !!} type="checkbox" onclick="javascript:selectAll();" id={!! "select".$student->id !!}> </td>
                                                <td>{!!  $student->first_name !!}</td>
                                                <td>{!!  $student->last_name !!}</td>
                                                <td> {!! $student->identity_no !!}</td>
                                                <td> {!! $student->examination_code !!}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" onclick="">Actions</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                    {!! HTML::link('/admin/exams/' . $examination->id.'/'.$student->id.'/deleteCandidate', 'Delete Exam Candidate')  !!}
                                                            </li>

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

                        <div class="clearfix">&nbsp;</div>

                        {!! Form::hidden('examination_id',$examination->id)!!}

                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <div class="pull-left">
                                {!! HTML::link('/admin/exams/' . $examination->id. '/class/upload' , 'Add More Candidates to Exam')  !!}
                            </div>
                        </div>

                        {!! Form::close() !!}


                    </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

    <script>

        function selectAll()
        {
            document.getElementsByClass
        }



    </script>

   @stop

