@if (Session::has('flash_notification.message'))
    <div class="row" style="margin-top: 12px;">
        <div class="alert alert-{{ Session::get('flash_notification.level') }}" id="flash">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! Session::get('flash_notification.message') !!}
        </div>
    </div>

@endif