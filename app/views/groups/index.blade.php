<!-- app/views/groups/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Nerds & Groups</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
@include ('layouts.navbar')

<h1>All the Groups</h1>
<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td><b>ID</td>
            <td><b>Group Name</td>
            <td><b>Active</td>
            <td><b>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($groups as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->group_name }}</td>
            <td>
            @if($value->active)
                <span class="glyphicon glyphicon-ok" style="color:green"></span>
            @else
                <span class="glyphicon glyphicon-remove" style="color:red"></span>
            @endif
            </td>
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the group (uses the destroy method DESTROY /groups/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'groups/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Group', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <!-- edit this group (uses the edit method found at GET /groups/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('groups/' . $value->id . '/edit') }}">Edit this Group</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
</body>
</html>