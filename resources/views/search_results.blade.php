@include('partials/header')
    <body>
    @include('partials/search_bar')
        <div class="container">
            <h1 class="text-center display-3">Quick Poll</h1>
            <h2 class="text-center subtitle">Create instant polls and share them.</h2>

            <h1>Search Results</h1>
            <ul>
            @foreach($results as $result)
                <li class="list-group-item">
                    <a href="/results/{{$result['id']}}">{{$result['name']}}</a>
                </li>
            @endforeach
            </ul>
            <a href="/">
                <button class="btn btn-secondary">Create Poll</button>
            </a>
        </div>
    </body>
</html>