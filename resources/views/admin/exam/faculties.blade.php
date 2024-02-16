@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <h1 class="page-header">Step One: Create Examination - Select A Class To Set An Examination For</h1>
                </div>
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
                    @if(Session::has('error'))
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">X</button>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif


                <div class="col-sm-12">
                    {!! Form::open(['url' => '/admin/exams/new/step2','class' => 'form', 'method' => 'post']) !!}


                    <div class="form-group">
                        <p class="form-control-static">Select the Class this exam is for</p>
                    </div>


                    <div class="form-group" style="width: 200px;">
                        {!! Form::label('class', "Candidates Class" . ':') !!}
                        {!! Form::select('class',[NULL => '-Select One-'] + $classes,null,array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <div class="pull-left">
                            {!! Form::submit("Next",array('class' => 'btn btn-primary','onClick' => 'this.form.submit(); this.disabled=true; this.value=\'Processing\'')) !!}
                        </div>
                        @if(!Session::has('message'))
                            <div class="pull-right">
                                <a class="btn btn-danger" href="javascript:history.back('-1')">{!! "Go Back" !!}</a>
                            </div>
                        @endif
                    </div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@endsection
