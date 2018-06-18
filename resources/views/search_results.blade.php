@include('partials/header')
    <body>
    @include('partials/search_bar')
    <div class="container">
    <h1>Search Results</h1>
        <ul>
        @foreach($results as $result)
            <li class="list-group-item">
                <a href="/poll/{{$result['id']}}">{{$result['name']}}</a>
            </li>
        @endforeach
        </ul>
        <button><a href="/">Main Page</a></button>
        </div>
    </body>
</html>