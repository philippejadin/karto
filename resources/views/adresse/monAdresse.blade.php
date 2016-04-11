<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./JS/main.js"></script>
	<title>Mon Adresse</title>
</head>
<body>
	</br>

{{Form::open(['action' => 'monAdresseController@monAdresse', 'method'=>'GET'])}}

	<input type ="text" id="contact" name="postal_code" placeholder="Tapez votre code postal"></input>
{{Form::close()}}
 

<div id="listContact">

<table>
@foreach ($contacts as $contact)
	
<tr>
<td>
{{$contact->categorie}} </br>
</td>

<td>
{{$contact->name}} </br>
</td>


</tr>
@endforeach

</table>

{!! $contacts->render() !!}

</div>

</body>
</html>