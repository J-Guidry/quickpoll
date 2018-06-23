@include('partials/header')
    <body>
    @include('partials/search_bar')
    <div class="container">
        <h1 class="text-center display-3">Quick Poll</h1>
        <h2 class="subtitle text-center">Create instant polls and share them.</h2>

        <h3 id="title" class="display-5">{{ $title }}</h3>
        <canvas class="canvas"id="results" width=300 height=130></canvas>
        <h4 id="total"></h4>
        <a href="/"><button class="btn btn-secondary">Create Poll</button></a>
        <a href="/poll/{{$id}}"><button class="btn btn-primary"> Vote</button></a>
    </div>

    <script type="text/javascript" src="/js/app.js"></script>
    <script>
        var ctx = document.getElementById("results");
        var ctx = document.getElementById("results").getContext("2d");
        var options = {!! json_encode($options, JSON_HEX_TAG) !!};
        var title = {!!json_encode($title, JSON_HEX_TAG) !!};
        var votes = {!! json_encode($votes, JSON_HEX_TAG) !!};
        var total = {!! json_encode($total, JSON_HEX_TAG) !!};

        let colors = [];
        for(let i = 0; i < options.length; i++){
            colors.push('rgb(255, 159, 64)');
        };

        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: options,
                datasets: [{
                    data: votes,
                    backgroundColor: colors        
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            stepSize: 1,
                            fontSize: 14,
                            display: false
                        },
                        gridLines: {
                    display: false
                }}],
                    yAxes: [{
                        ticks: {
                            fontSize: 19
                        }
                    }]                     
                },

            }
    });
    var container = document.querySelector(".container");
    var totalContainer = document.querySelector('#total');
    totalContainer.textContent = "Total Votes: " + total;

    </script>        
    </body>
</html>