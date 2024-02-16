@extends('app')

@section('content')

        <!-- Default box -->
		
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			@if(isset($arm_id) && $arm_id!=NULL)
			Update A Class Arm
			@else
			Create A New Class Arm
			@endif
		</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
            <div class="box form-wrapper">
                <form class="form" action="/admin/class/store-step-two" method="post">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label for="className">Class Name:</label>
                                <p>{{ $class_name }}</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="className">Class Arm:</label>
                                <input class="form-control" type="text" name="class_arm" placeholder="Name of class arm" value="{{ (Input::old('arm_name') ? Input::old('arm_name') : (isset($arm_name) ? $arm_name : '')) }}"/>
                            </div>
                            <div class="clearfix"></div>

                            
                        </div>

                        <div class="col-md-4 col-md-offset-1">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4>Class Arms</h4>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-unstyled">

                                        @foreach($all_arm_records as $all_arms)
                                             <li><i class="fa fa-angle-double-right"></i> Class Arm {{ $all_arms->arm_name }}</li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-default btn-lg" href="javascript:history.back()"><i class="fa fa-times-circle"></i> Cancel</a>
                        <button type="submit" class="btn btn-success btn-lg pull-right" href="7b.html"><i class="fa fa-check-circle"></i> @if(isset($crypt_arm_id))
						Save
						@else
						Create
						@endif</button>
                    </div>

                    @if(isset($crypt_arm_id))
                        <input type="hidden" name="arm_id" value="{{$crypt_arm_id}}">
                    @endif
					<input type="hidden" name="class_id" value="{{\Crypt::encrypt($id)}}">
                </form>
            </div>
            <!-- /.box -->
@stop

@section('section_title') Manage Classes @stop

@section('scripts')
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#paymentItemListing').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "columnDefs": [
                    {"targets": 0, "orderable": false},
                    {"targets": 2, "width": "45%"}
                ],
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@stop