<!-- app/views/nerds/create.bleade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Nerds & Groups</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
@include ('layouts.navbar')

<h1>Create a Nerd</h1> 

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'nerds')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('nerd_level', 'Nerd Level') }}
        {{ Form::select('nerd_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), Input::old('nerd_level'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('groups[]', 'Select Groups') }}
        {{ Form::select('groups[]', $group_options, Input::old('groups'), array('class' => 'form-control', 'multiple' => 'multiple', 'id' => 'groups')) }}
    </div>

<!--     <?php print_r($group_options);  ?> -->

    {{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>