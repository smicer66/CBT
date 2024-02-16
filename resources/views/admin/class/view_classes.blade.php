@extends('app')

@section('content')
<?php

?>
        <!-- Default box -->
    <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			List Of Classes
		</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="box form-wrapper">
    <div class="box-body">
        <table id="deptListing" class="table table-bordered table-hover">
            <thead>
            <tr class="active">
                <th>Class</th>
                <th>Arms</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($classes as $class)
                <?php
                $str = "";
                ?>
                <tr>
                    <td class="success"><strong>{{ $class->name }}</strong></td>
                    <td>

                        @foreach($class->class_arm as $arm)

                                <?php
								
                                	$str = $str. "<a href='/admin/class/step-two/".\Crypt::encrypt($class->id)."/".$arm->id."' title='Click to edit this class arm'>".$arm->arm_name."</a> [ <a href='/admin/class/delete-arm/".\Crypt::encrypt($class->id)."/".$arm->id."' title='Delete'><i class='fa fa-trash-o fa-fw'></i></a> ], ";
								
                                ?>
                        @endforeach
                            <?php echo substr($str, 0, strlen($str) - 2);?>
                    </td>
                    <td>
                        <div class="btn-group">
                        <button class="btn btn-danger btn-sm" type="button">Action</button>
                        <button data-toggle="dropdown" class="btn btn-danger btn-sm dropdown-toggle" type="button" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul role="menu" class="dropdown-menu">
                        <li><a href="class/step-one/{{ \Crypt::encrypt($class->id) }}">Update Class</a></li>
                        <li><a href="class/delete-class/{{ $class->id }}">Delete Class</a></li>
                        <li><a href="class/step-two/{{  \Crypt::encrypt($class->id) }}">Add Class Arm</a></li>
                        </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <a class="btn btn-default" href="javascript:history.back()"><i class="fa fa-chevron-circle-left"></i> Back</a>
    </div>
</div><!-- /.box -->
@stop

@section('section_title') Manage Classes @stop

@section('scripts')
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#deptListing').DataTable({
                "paging": true,
                "lengthChange": true,
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