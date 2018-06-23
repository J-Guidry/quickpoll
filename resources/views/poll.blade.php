@include('partials/header')
    <body>
    @include('partials/search_bar')
    
    <div class="container">
        <h1 class="text-center display-3">Quick Poll</h1>
        <h2 class="text-center subtitle">Create instant polls and share them.</h2>

        <h1 id="title" class="display-6 text-center">{{ $title }}</h1>

        <form method="post" action="/vote/{{$id}}" id="create" >
            @csrf
            @method('PUT')
            @foreach ($options as $option)
            <div class="radio" class="form-group poll">
                <input class="form-check-input" type="radio" name="votes" id="vote"value={{$option["option_name"]}}>
                <label class="form-check-label" for="vote">{{$option['option_name']}}</label>
            </div>
            @endforeach
            <button class="btn btn-primary vote" type="submit">Vote</button>
        </form>
        <div class="button_group">
        <a class="results" href="/results/{{$id}}">
            <button class="btn btn-info">See Results</button>
        </a>
        <a href="/">
            <button class="btn btn-secondary">Create Poll</button>
        </a>
        </div>
    </div>

    </body>
</html>
