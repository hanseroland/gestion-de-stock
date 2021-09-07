
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
   
  

    #chart-container {
        width: 100%;
        height: auto;
    }
    
</style>
<script src="chart.js-3.5.0/package/dist/chart.min.js"></script>
<script src="config/js/jquery-3.3.1.min.js"></script>
</head>
<body>
    <div id="chart-container">
      <canvas id="mycanvas-qte"></canvas>
    </div>

    
        <script >
                    $(document).ready(function(){
                    $.ajax({
                        url: "http://localhost/gestion-de-stock/config/articles/dataQte.php",
                        method: "GET",
                        success: function(data) {
                        console.log(data);
                        var article = [];
                        var qte = [];
                        var couleur = [];
                        console.log(article);

                        for(var i in data) {
                            article.push(data[i].article);
                            qte.push(data[i].quantite);
                            couleur.push(data[i].couleur);
                        }

                        var chartdata = {
                            labels: article,
                            datasets : [
                            {
                                label: "Articles",
                                backgroundColor: couleur,
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: qte
                            }
                            ]
                        };

                        var options = {
                        responsive:true,
                        scales:{
                            yAxes:[{
                                ticks:{
                                    min:0
                                }
                            }]
                        }
                    };

                        var ctx = $("#mycanvas-qte");

                        var barGraph = new Chart(ctx, {
                            type: 'pie',
                            data: chartdata
                        });
                        },
                        error: function(data) {
                        console.log(data);
                        }
                    });
                    });
        </script>
</body>
</html>