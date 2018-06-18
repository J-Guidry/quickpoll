@include('partials/header')
    <body>
    @include('partials/search_bar')
    <div class="container">
        <h3 id="title" class="display-3">{{ $title }}</h3>
        <canvas id="results" width=300 height=130></canvas>
        <button><a href="/">Main Page</a></button>
        <button> <a href="/poll/{{$id}}">Vote</a></button>
    </div>

    <script type="text/javascript" src="/js/app.js"></script>
    <script>

        var ctx = document.getElementById("results");
        var ctx = document.getElementById("results").getContext("2d");
        var options = {!! json_encode($options, JSON_HEX_TAG) !!};
        var title = {!!json_encode($title, JSON_HEX_TAG) !!};
        var votes = {!! json_encode($votes, JSON_HEX_TAG) !!};
        //console.log(votes, options);
        console.log(votes);


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
                }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 19
                        }
                    }]                     
                },

            }
    });
    
    </script>        
    </body>
</html>