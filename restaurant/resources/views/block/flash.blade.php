@if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}" style="margin-top: -21px;width: 500px;text-align: center;margin-left: 320px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {!! session('flash_notification.message') !!}
    </div>
@endif