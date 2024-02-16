@extends('back.template')

@section('main')
    <div class="pull-right" style="padding-right: 20px;">
        <a class="btn btn-primary" href="javascript:history.back('-1')">{!! "Back" !!}</a>
    </div>
  @if(Session::has('message'))
      <div class="alert alert-dismissible alert-danger">
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
  <div class="row col-lg-12">
      @if($subscribers->count()>0)
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>{!! "Name" !!} <a href="#" name="created_at" class="order"></a></th>
             <th>{!! "Email" !!} <a href="#" name="created_at" class="order"></a></th>
              <th>{!! "Active" !!} <a href="#" name="created_at" class="order"></a></th>
              <th>{!! "Date Subscribed" !!} <a href="#" name="active" class="order"></a></th>
          </tr>
        </thead>
        <tbody>
        @foreach ($subscribers as $subscriber)
            <tr {!! 'class="warning"'!!}>
                <td>{{ $subscriber->name }}</td>
            <td> {{ $subscriber->email }}</td>
                <td>{{ ($subscriber->active) ? 'Yes':'No' }}</td>
                <td>{{ $subscriber->date_subscribed }}</td>
                {{--<td>{!! link_to_route('newsletters.edit',"View/Edit", [$newsletter->id], ['class' => 'btn btn-success']) !!}</td>--}}
                {{--<td>--}}
                    {{--{!! Form::open(['method' => 'DELETE', 'route' => ['newsletters.destroy', $newsletter->id]]) !!}--}}
                    {{--{!! Form::destroy("Delete","Sure you want to delete this item ?") !!}--}}
                    {{--{!! Form::close() !!}--}}
                {{--</td>--}}
                </tr>
        @endforeach
        </tbody>
      </table>
    </div>
      @else
          {!! "There are currently no subscribers at this time " !!}
      @endif
  </div>

  <div class="row col-lg-12">
    {{--<div class="pull-right link">{!! $links !!}</div>--}}
  </div>

@stop
