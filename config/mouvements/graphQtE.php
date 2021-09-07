
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
      <canvas id="mycanvass"></canvas>
    </div>

     
        <script >
                    $(document).ready(function(){
                    $.ajax({
                        url: "http://localhost/gestion-de-stock/config/mouvements/data2.php",
                        method: "GET",
                        success: function(data) {
                       // console.log(data);
                        var mois = [];
                        var quantite = [];

                        for(var i in data) {
                            mois.push(data[i].mois);
                            quantite.push(data[i].quantite);
                        }

                        var chartdata = {
                            labels: mois,
                            datasets : [
                            {
                                label: "Total d'article achetés par mois",
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: quantite
                            }
                            ]
                        };

                        var ctx = $("#mycanvass");

                        var barGraph = new Chart(ctx, {
                            type: 'bar',
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