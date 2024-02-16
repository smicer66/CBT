@extends('app')

@section('content')

            <!-- Default box -->
			
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						@if(isset($crypt_class_id))
						{!! "Update Class - ".$name !!}
						@else
						{!! "Create a new Class" !!}
						@endif
					</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			
            <div class="box form-wrapper">
                <form class="form" action="/admin/class/store-step-one" method="post">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="className">Class Name:</label>
                            <input class="form-control" type="text" name="name" placeholder="Name of class" value="{{(Input::old('name')) ? Input::old('name') : (isset($name) ? $name : "") }}"/>
                        </div>

                        <div class="clearfix"></div>


                        <hr/>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-default btn-lg" href="javascript:history.back()"><i class="fa fa-times-circle"></i> Cancel</a>
						
                        <button type="submit" class="btn btn-success btn-lg pull-right" href="7b.html"><i class="fa fa-check-circle"></i> 
						@if(isset($crypt_class_id))
						Save
						@else
						Create
						@endif</button>
						
                    </div>

                    @if(isset($crypt_class_id))
                        <input type="hidden" name="class_id" value="{{$crypt_class_id}}">
                    @endif
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

    <script>

        function onClassTypeSelect()
        {
            val = $('select#class_type').val();
            j = 0;
            var arr = ['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5', 'Level 6'];
            if(val=='NUR')
            {
                j = 3;
            }else if(val=='PRI')
            {
                j = 6;
            }else if(val=='JSS')
            {
                j= 3;
            }else if(val=='SSS')
            {
                j = 3;
            }
            $('#class_level').empty();
            if(j!=0)
            {
                for(i=0; i<j; i++)
                {
                    opt = document.createElement('option');
                    opt.value = (i+1);
                    opt.innerHTML = arr[i];
                    document.getElementById('class_level').appendChild(opt);
                }
            }
        }


        $(document).on('change', '#class_type', onClassTypeSelect);

    </script>
@stop