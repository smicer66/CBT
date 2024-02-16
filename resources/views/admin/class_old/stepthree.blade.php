@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "Step Three : Select Candidates For ".$examination->title." Examination" !!}
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
                            <p class="form-control-static">Students Currently belonging to {!! $dept[0]->name !!} Department and {!! $lvl[0]->name !!} Level</p>
                        </div>
                        <div class="form-group">
                            <p class="form-control-static">Select the Candidates Department and Level</p>
                        </div>


                        <div class="form-group">
                            <!-- /.panel-heading -->


                            <div class="panel-body col-lg-12">
                                @if(isset($students))
                                    <table class="table table-striped table-responsive" id="studentsTable">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">Select All<br><input type="checkbox" onclick="javascript:selectAllBox();" id="select1"> </th>
                                            <th style="width: 130px;">{{ "First Name" }}</th>
                                            <th>{{ "Last Name" }}</th>
                                            <th>{{ "Identity Number" }}</th>
                                            <th>{{ "Examination Code" }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($students as $student)

                                            <tr>
                                                <td style="text-align: center"><input class="custid"  name="studentsList[]" value={!! $student->id !!} type="checkbox" onclick="javascript:selectAll();" id={!! "select".$student->id !!}> </td>
                                                <td>{!!  $student->first_name !!}</td>
                                                <td>{!!  $student->last_name !!}</td>
                                                <td> {!! $student->identity_no !!}</td>
                                                <td> {!! $student->examination_code !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix">&nbsp;</div>

                        {!! Form::hidden('examination_id',$examination->id)!!}
                        {!! Form::hidden('level',$lvl[0]->id)!!}

                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit("Next",array('class' => 'btn btn-primary','onClick' => 'this.form.submit(); this.disabled=true; this.value=\'Processing\'')) !!}
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-danger" href="javascript:history.back('-1')">{!! "Go Back" !!}</a>
                            </div>
                        </div>

                        {!! Form::close() !!}


                    </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script>

        function selectAllBox()
        {
            var sel = document.getElementById('select1');

            var cusid_ele = document.getElementsByClassName('custid');
            for (var i = 0; i < cusid_ele.length; ++i) {
                var item = cusid_ele[i];
                if(sel.checked==true)
                {
                    item.checked = true;
                }else
                {
                    item.checked = false;
                }

            }
        }



    </script>

   @stop

