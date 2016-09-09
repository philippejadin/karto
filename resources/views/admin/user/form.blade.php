<div class="form-group">

    {{Form::radio('is_admin', 'yes', $user->isAdmin())}} admin <br/>
    {{Form::radio('is_admin', 'no', !$user->isAdmin())}} pas admin <br/>



</div>
