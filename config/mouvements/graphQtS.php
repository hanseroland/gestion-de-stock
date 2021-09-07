
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
      <canvas id="mycanvasortie"></canvas>
    </div>

     
        <script >
                    $(document).ready(function(){
                    $.ajax({
                        url: "http://localhost/gestion-de-stock/config/mouvements/data3.php",
                        method: "GET",
                        success: function(data) {
                       // console.log(data);
                        var moisSortie = [];
                        var quantiteSortie = [];

                        for(var i in data) {
                            moisSortie.push(data[i].mois);
                            quantiteSortie.push(data[i].quantite);
                        }

                        var chartdata = {
                            labels: moisSortie,
                            datasets : [
                            {
                                label: "Total d'article vendus par mois",
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: quantiteSortie
                            }
                            ]
                        };

                        var ctx = $("#mycanvasortie");

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