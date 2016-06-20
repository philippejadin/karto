<div class="form-group">
    {!! Form::label('prefix', 'Préfixe du contact') !!}
    {!! Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => 'Préfixe']) !!}
</div>

<div class="form-group">
    {!! Form::label('nom', 'Nom') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Présentation','id'=>'description']) !!}
    <script>CKEDITOR.replace('description');</script>
</div>

<div class="form-group">
    {!! Form::label('address', 'Adresse') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
</div>

<div class="form-group">
    {!! Form::label('postal_code', 'Code postal') !!}
    {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Code postal']) !!}
</div>

<div class="form-group ">
    {!! Form::label('locality', 'Localité') !!}
    {!! Form::text('locality', null, ['class' => 'form-control', 'placeholder' => 'Commune']) !!}
</div>

<div class="form-group">
    {!! Form::label('country', 'Pays') !!}
    {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Pays']) !!}
</div>


<div class="form-group">
    {!! Form::label('phone', 'Téléphone') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone2', 'Téléphone 2') !!}
    {!! Form::text('phone2', null, ['class' => 'form-control', 'placeholder' => 'Téléphone2']) !!}
</div>

<div class="form-group">
    {!! Form::label('website', 'Site web') !!}
    {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Site web']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Adresse mail') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
</div>


<div class="form-group">
    {!! Form::label('tags[]', 'Tag(s)') !!}
    {!! Form::select('tags[]', App\Tag::pluck('name','id'),$contact->tags->pluck('id')->all(),['class' =>'form-control input-lg','multiple'=>true,'id' => 'prettify']) !!}
</div>


<script type="text/javascript">
$('#prettify').select2();
</script>
