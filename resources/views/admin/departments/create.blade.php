@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">

                <h1 class="page-header">
                    @if(isset($faculty))
                        {!! "Create a new Department in the faculty of ".$faculty->name !!}
                    @else
                        {!! "Create a new Department" !!}
                    @endif
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
                <div class="col-sm-12">
                    {!! Form::open(['url' => 'admin/departments','class' => 'form']) !!}
                    <div class="form-group col-md-6">
                        {!! Form::label('name', "Name of Department" . ':') !!}
                        {!! Form::text('name',Input::old('name'), array('class' => 'form-control')) !!}
                    </div>
                    <div class="clearfix"></div>
                    <?php if(isset($faculty)){ ?>
                        {!! Form::hidden('faculty_id',$faculty->id) !!}
                        {!! Form::hidden('redirect_manage',"true") !!}
                    <?php }
                    else { ?>
                    <div class="form-group col-md-6" style="width: 300px;">
                    {!! Form::label('faculty_id', "This Department's Faculty" . ':') !!}
                    {!! Form::select('faculty_id',$faculties,null, array('class' => 'form-control')) !!}
                    </div>
                    <?php }
                    ?>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-6">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-6">
                        <div class="pull-left">
                            {!! Form::submit("Save",array('class' => 'btn btn-primary','onClick' => 'this.form.submit(); this.disabled=true; this.value=\'Saving\'')) !!}
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-danger" href="javascript:history.back('-1')">{!! "Cancel" !!}</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@endsection
