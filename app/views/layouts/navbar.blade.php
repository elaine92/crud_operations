<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('nerds') }}">Nerd Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('nerds') }}">View All Nerds</a></li>
        <li><a href="{{ URL::to('nerds/create') }}">Create a Nerd</a></li>
        <li><a href="{{ URL::to('groups')}}">View All Groups</a></li>
        <li><a href="{{ URL::to('groups/create')}}">Create a Group</a></li>
    </ul>
</nav>