<!-- app/views/nerds/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Nerds & Groups</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
@include ('layouts.navbar')

<h1>Showing {{ $nerd->name }}</h1>

<div class="jumbotron text-center">
        <h2>{{ $nerd->name }}</h2>
        <p>
            <strong>Email:</strong> {{ $nerd->email }}<br>
            <strong>Level:</strong> {{ $nerd->nerd_level }}<br><br>
            <strong><u>Groups:</u></strong><br>
                <?php 
                    $groups = Nerd::find($nerd->id)->groups;
                ?>

                @foreach($groups as $k => $v)
                    <span class="glyphicon glyphicon-star" style="color:orange"></span>
                    {{ $v->group_name }}
                    </br>
                   
                @endforeach
            
        </p>
    </div>

</div>
</body>
</html>