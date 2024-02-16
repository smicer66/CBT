@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Results
                    {!! "Users".link_to_route('admin.exams.results.download',"Download Results", [$examination->id], ['class' => 'btn btn-info pull-right']) !!}
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container-fluid">
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
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
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Results for {{$examination->title}}
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                @if($examination)
                                    <table class="table table-striped table-hover" id="results-table">
                                        <thead>
                                        <tr>
                                            <th> Identity Number </th>
                                            <th> Student Name </th>
                                            <!--<th>Class</th>-->
                                            <th>Score</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($candidates as $candidate)
                                            @if($candidate->hasScore)
                                                <tr>
                                                    <td>{!! $candidate->user->identity_no!!}</td>
                                                    <td>{!! $candidate->user->first_name . ' ' . $candidate->user->last_name !!}</td>
                                                    <!--<td>{! $candidate->user->user_department->name !}</td>-->
                                                    <td>{!! $candidate->result !!}</td>

                                                </tr>
                                            @endif
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
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#results-table').DataTable({
                responsive: true
            });
        });
        $('.delete').on('click', function () {
            return confirm('Sure you want to delete this user?');
        });
    </script>
@stop
