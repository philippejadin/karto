@if (count($errors) > 0)
<div class="alert alert-danger">
  <strong><i class="fa fa-exclamation-triangle"></i>{{ trans('messages.howdy') }}</strong> {{ trans('messages.something_wrong') }}<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

Erreurs ici : 
@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('flash_notification.message') }}
    </div>
@endif
