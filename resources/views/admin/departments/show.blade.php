@extends('back.template')

@section('main')
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(Session::has('error'))
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">X</button>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="row col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <b>{!!" Calendar" . '::' . $calendar->title.'' !!}</b>
                                <div class="pull-right" style="padding-right: 20px;">
                                    <a class="btn btn-default" href="javascript:history.back('-1')">{!! "Back" !!}</a>
                                </div>
                                <div class="pull-right" style="padding-left: 20px; padding-right: 20px;">
                                    {!!link_to('calendars/publish/'.$calendar->id,"Publish", ['class' => 'btn btn-success'])!!}
                                </div>
                                <div class="pull-right" style="padding-left: 20px;">
                                    {!! link_to_route("calendars.edit","Edit this Calendar", array('id' => $calendar->id), array('class' => 'btn btn-info')) !!}
                                </div>
                                <div class="pull-right" style="padding-left: 20px;">
                                    {!! Form::open(array('route' => array("calendars.destroy",$calendars->id))) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit("Delete this Calendar", null,array('class' => 'btn btn-danger')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="panel-body">
                                @if ($calendarEvents->count())
                                    <div class="row">
                                        @foreach($calendarEvents as $event)
                                            <div class="col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        {{--<b><a href="{!! URL::to('slideshows/slide/'.$slide->slideshow_id.'/'.$slide->id) !!}">{!!$slide->name!!}</a></b>--}}
                                                        <b>{!! link_to("event/$event->id",$event->name )!!}</b>
                                                    </div>
                                                    <div class="panel-body">
                                                        <p class="lead indent">{!! $event->description !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                            <div class="panel-footer clearfix">
                                <?php //echo $slideshowSlides->links(); ?>
                            </div>
                            @else
                                {!! "There are no events in this calendar"!!}
                            @endif
                        </div>
    </div>
    </div>
    </div>

@stop