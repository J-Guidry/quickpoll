@include('partials/header')
    <body>
    @include('partials/search_bar')
    
    <div class="container">
    <h1 id="title" class="display-3">{{ $title }}</h1>

    <form method="post" action="/vote/{{$id}}" id="create">
        @csrf
        @method('PUT')
        @foreach ($options as $option)
        <div class="form-group">
            <input type="radio" name="votes" value={{$option["option_name"]}}>
            <span>{{$option['option_name']}}</span>
        </div>
        @endforeach
        <button class="btn btn-primary" type="submit">Vote</button>
    </form>
    <button><a class="results" href="/results/{{$id}}">See Results</a></button>

    <button><a href="/">Main Page</a></button>
    </div>

    </body>
</html>
