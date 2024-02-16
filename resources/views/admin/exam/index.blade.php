@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! "All Examinations".link_to_route('admin.exams.create',"Create New Exam", [], ['class' => 'btn btn-info pull-right']) !!}
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-10">
                <p class="text-info" style="font-size: 12px;">
                    <u>Archived Examinations:</u>  This implies that the examination has been finished.
                </p>
                <p class="text-info"  style="font-size: 12px;">
                    <u>Ended Examinations:</u>  This implies that the examination has been finished. This examination can still be reset
                </p>
                <p class="text-info" style="font-size: 12px;">
                   <u>Created Examinations:</u>  This implies that the examination has not been taken by its candidates. To start an examination click on its SET button
                </p>
                <p class="text-info" style="font-size: 12px;">
                    <u>Running Examinations:</u>  This implies that the examination is currently being taken by its candidates.
                </p>
            </div>
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <div class="dataTable_wrapper" style="font-size:11px;">
                            @if($exams)
                                <table class="table" id="examinationsTable">
                                    <thead>
                                    <tr>
                                        <th>Examination</th>
                                        <th>Subject</th>
                                        <th>Exam Date</th>
                                        <th class="text-center">Duration <br>(Minutes)</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exams as $exam)
                                        <?php
                                                if(count($exam->questions) > 0){
                                                    $hasQuestions = true;
                                                }
                                                else{
                                                    $hasQuestions = false;
                                                }
												
												$i=$exam->questions->count();
                                        ?>
                                        <tr>
                                            <td>{!! ucwords($exam->title) !!}<br />
											<strong>Code:</strong> {!! strtoupper($exam->str_verify) !!}<br />
											<strong>Questions Uploaded:</strong> {{$i}} <br />
											</td>
                                            <td>{!! strtoupper($exam->course->title) !!}</td>
                                            <td>{!! $exam->exam_date    !!}</td>
                                            <td class="text-center">{!! $exam->duration !!}</td>
                                            <td>{!! strtoupper($exam->status == "active" ? "RUNNING" : ($exam->status == "inactive" ? "EXAM ENDED" : $exam->status)) !!}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success" onclick="">Actions</button>
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                            <li>{!! HTML::link('/admin/exams/' . $exam->id, 'View')  !!}</li>

                                                            @if($exam->status == 'active')
                                                                <li>
                                                                {!! HTML::link('/admin/exams/' . $exam->id.'/end', 'End Exam')  !!}
                                                                </li>
                                                            @elseif($exam->status == 'created')
                                                                <li>
                                                                 {!! HTML::link('/admin/exams/' . $exam->id.'/delete', 'Delete Exam', ['class' => 'delete'])  !!}
                                                                </li>
                                                            @elseif($exam->status == 'inactive')
                                                                <li>
                                                                {!! HTML::link('/admin/exams/' . $exam->id.'/archive', 'Archive Exam')  !!}
                                                                </li>
                                                            @endif

                                                            @if($exam->status != 'active' and $exam->status != 'inactive' and $exam->status != 'archived')
                                                                <li>
                                                                    {!! HTML::link('/admin/exams/' . $exam->id. '/questions' , 'Manage questions')  !!}
                                                                </li>
                                                            @endif

                                                            @if($exam->status != 'active' and $exam->status != 'inactive' and $exam->status != 'archived')
                                                                @if($hasQuestions)
                                                                <li>
                                                                    {!! HTML::link('/admin/exams/' . $exam->id. '/set' , 'Start Examination')  !!}
                                                                </li>
                                                                @endif
                                                            @endif

                                                            @if($exam->status == 'created')
                                                                <!--<li>
                                                                    {!! HTML::link('/admin/exams/' . $exam->id. '/class/step0' , 'Manage Candidates')  !!}
                                                                </li>-->
																<li>
																	{!! HTML::link('/admin/exams/' . $exam->id .'/edit' , 'Edit Examination')  !!}
																</li>
                                                            @endif
															
															@if($exam->status == 'created')
															<li>
																	{!! HTML::link('admin/exams/'.$exam->id.'/questions/upload' , 'Edit Examination')  !!}
															</li>
                                                            @endif


                                                            @if($exam->status == 'inactive')
                                                                <li>
                                                                    {!! HTML::link('/admin/results/' . $exam->id , 'View Exam Results')  !!}
                                                                </li>
																
																<!--<li>
																	{!! HTML::link('/admin/results/' . $exam->id , 'Delete Examination')  !!}
																</li>-->
																
																
																<!--<li>
																	{!! HTML::link('/admin/exams/' . $exam->id .'/questions' , 'View Questions')  !!}
																</li>
																
																<li>
																	{!! HTML::link('/admin/exams/' . $exam->id .'/class' , 'View Candidates')  !!}
																</li>-->
                                                            @endif
															@if($exam->status == 'active' || $exam->status == 'created')
															<li>
																{!! HTML::link('/admin/results/refreshcandidates/' . $exam->id , 'Refresh Examination Candidates')  !!}
															</li>
															@endif
															
															

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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#examinationsTable').DataTable({
                responsive: true
            });
        });
        $('.delete').on('click', function() {
            return confirm('Sure you want to delete this Examination?');
        });
    </script>
@stop
