<!-- app/views/groups/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Nerds & Groups</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
@include ('layouts.navbar')

<h1>Create a Group</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'groups')) }}

    <div class="form-group">
        {{ Form::label('group_name', 'Group Name') }}
        {{ Form::text('group_name', Input::old('group_name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::checkbox('active', null, false, array('id' => 'active')) }}
    </div>


    {{ Form::submit('Create the Group!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>