@include('partials/header')
    <body>
    @include('partials/search_bar')
        <div class="container">
            <h1 class="title display-3 text-center">Quick Poll</h1>
            <h2 class="subtitle text-center">Create instant polls and share them.</h2>
            <form method="post" action="/polls" id="create" name="poll" >
            @csrf
                <div class="form-group">
                    <input class="question text-truncate"type="text" name="poll_name" placeholder="Type Your Poll Question" required>
                </div>
                <select id="optionSelect" required>
                    <option>Choose How Many Poll Options</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                </select>
                <div id="options">
                
                </div>
                <button class="btn btn-primary" type="submit" data-toggle="modal" data-target="#exampleModal">Create Poll</button>
            </form>
        
            @include('partials/messages')
            
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Here is Your Poll</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/js/app.js"></script>
        <script src="/js/clipboard-polyfill.js"></script>
        <script type="text/javascript" src="/js/index.js"></script>
    </body>
</html>
