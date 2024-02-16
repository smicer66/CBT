@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create a New Subject</h1>
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
                <div class="col-md-6" style="padding: 24px;">
                    {!! Form::open(['url' => 'admin/courses','files' => true,'class' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('title', "Department Offering Subject/Course" . ':') !!}
                        {!! Form::select('department_offering',$departments,null, array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', "Subject Name" . ':') !!}
                        {!! Form::text('title',Input::old('title'), array('class' => 'form-control')) !!}
                    </div>

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
@endsection
