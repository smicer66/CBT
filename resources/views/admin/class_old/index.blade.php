@extends('app')

@section('content')


		<div class="row">
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            @endif
			<div class="col-lg-12">
				<h1 class="page-header">{{$examination->title}}
					<small>Candidates</small>
				</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-body">
                        @if($examination->status == 'created'       )
                            <div class="col-lg-12">
                                <div class="form-group pull-right">
                                    {!! HTML::link('admin/exams/'. $examination->id .'/class/upload', 'Upload Candidates', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        @endif
                        <div class="dataTable_wrapper">
                            @if(count($candidates) > 0)

                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Id Number</th>
                                        <th>Result</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($candidates as $candidate)
            {{--                            {!! dd($candidate->user)!!}--}}
                                        <tr>
                                            <td>{!! $candidate->user->first_name !!}</td>
                                            <td>{!! $candidate->user->last_name !!}</td>
                                            <td>{!! $candidate->user->identity_no !!}</td>
                                            <?php $result = $candidate->user->examinationUsers()->where('examination_id',
                                                    $examination->id)->first()->result ?>
                                            <td>
                                                @if(! is_null($result))
                                                    {!! $result !!}
                                                @else
                                                    No score yet
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach

                                    </tbody>
                                </table>
                                {!! $candidates->render() !!}
                                @else
                                {!! "There are no candidates for this examination" !!}
                            @endif
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	     aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content load_modal">
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true
            });
        });
		$('#editModal').on('hidden.bs.modal', function () {
			$(this).removeData('bs.modal');
		});
	</script>
	@if($errors->any())
		<script>
			$("#edit").attr('href', '')
		</script>
	@endif
@stop
