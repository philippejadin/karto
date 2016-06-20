<div class="form-group">
    {!! Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => 'Préfixe']) !!}
</div>

<div class="form-group">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
</div>

<div class="form-group">
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Présentation','id'=>'description']) !!}
    <script>CKEDITOR.replace('description');</script>
</div>

<div class="form-group">
    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
</div>

<div class="form-group">
    {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Code postal']) !!}
</div>

<div class="form-group ">
    {!! Form::text('locality', null, ['class' => 'form-control', 'placeholder' => 'Commune']) !!}
</div>

<div class="form-group">
    {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Pays']) !!}
</div>


<div class="form-group">
    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone']) !!}
</div>

<div class="form-group">
    {!! Form::text('phone2', null, ['class' => 'form-control', 'placeholder' => 'Téléphone2']) !!}
</div>

<div class="form-group">
    {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Site web']) !!}
</div>

<div class="form-group">
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
</div>


<div class="form-group">
    {!! Form::label('tags[]', 'Tag') !!}
    {!! Form::select('tags[]', App\Tag::pluck('name','id'),$contact->tags->pluck('id')->all(),['class' =>'form-control input-lg','multiple'=>true,'id' => 'prettify']) !!}
</div>


<script type="text/javascript">
$('#prettify').select2();
</script>
