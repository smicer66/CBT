@extends('app')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Results
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
                            List of available results
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                @if($examinations)
                                    <table class="table table-striped table-hover" id="results-table">
                                        <thead>
                                        <tr>
                                            <th> Examination Name </th>
                                            <th> Examination Status </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($examinations as $examination)
                                            @if($examination->status == 'inactive')
                                            <tr>
                                                <td>{!! $examination->title !!}</td>
                                                <td>{!! $examination->status=='inactive' ? 'Ended' : $examination->status !!}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        {!! link_to_route('admin.results.show', 'View Results', [$examination->id], ['class' => 'btn btn-success']) !!}
                                                        {{--<button href="" type="button" class="btn btn-success" onclick="">View Results</button>--}}
                                                        {{--<button type="button" class="btn btn-success dropdown-toggle"--}}
                                                                {{--data-toggle="dropdown">--}}
                                                            {{--<span class="caret"></span>--}}
                                                            {{--<span class="sr-only">Toggle Dropdown</span>--}}
                                                        {{--</button>--}}
                                                        {{--<ul id="actions" class="dropdown-menu" role="menu">--}}
                                                            {{--<li>{!! link_to_route('admin.users.edit', 'Edit', [$user->id]) !!}</li>--}}
                                                            {{--<li>{!! link_to_route('admin.users.delete',"Delete", [$user->id],--}}
                                                                {{--['class' => 'delete']) !!}--}}
                                                            {{--</li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </td>
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
