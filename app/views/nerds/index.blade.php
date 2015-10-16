<!-- app/views/nerds/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Nerds & Groups</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
@include ('layouts.navbar')

<h1>All the Nerds</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td><b>ID</td>
            <td><b>Name</td>
            <td><b>Email</td>
            <td><b>Nerd Level</td>
            <td><b>Nerd Groups</td>
            <td><b>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($nerds as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->email }}</td>
            <td>
                <?php 
                    switch ($value->nerd_level) {
                        case "0":
                            echo "-";
                            break;
                        case "1":
                            echo "Sees Sunlight";
                            break;
                        case "2":
                            echo "Foosball Fanatic";
                            break;
                        case "3":
                            echo "Basement Dweller";
                    }
                ?>
            </td>

            <td>
                <?php 
                    $groups = Nerd::find($value->id)->groups;
                    //print_r($groups);
                ?>

                @foreach($groups as $k => $v)
                    <span class="glyphicon glyphicon-star" style="color:orange"></span>
                    {{ $v->group_name }}
                    </br>
                   
                @endforeach
            </td>

             <!-- we will also add show, edit, and delete buttons -->
            <td>
                
                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'nerds/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Nerd', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('nerds/' . $value->id) }}">Show this Nerd</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('nerds/' . $value->id . '/edit') }}">Edit this Nerd</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>