<!DOCTYPE html>
<html lang="it" ng-app="bookcoverApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Crea un PDF con le base per una copertina">
        <meta name="keywords" content="PDF, base, linee, copertina, cover, lines, export, margin, template">
        <meta name="author" content="Emilie Rollandin">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Copertina libro</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Personalizzazione -->
        <link href="css/mioTema.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.js"></script>
        <script src="js/script.js"></script>
        <script src="js/validazione.js"></script>
    </head>
    <body role="document" ng-controller="mainController">
        <div class="container theme-showcase" role="main">

            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <h1>LISTA COPERTINE</h1>
                <p>Controllo copertine create con l'app</p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipologia</th>
                            <th>Larghezza</th>
                            <th>Altezza</th>
                            <th>Dorso</th>
                            <th>Abbondanza</th>
                            <th>Taglio</th>
                            <th>Alette</th>
                            <th>ISBN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Visualizza lista ultime 10 copertine
                        require('SQLvisualizza.php');
                        SQLvisualizza();
                        ?>
                    </tbody>
                </table>
            </div>

            </br>
        </div> <!-- Fine div container -->

        <footer class="footer">
            <div class="container">
                <p class="text-muted text-center">Studio Archistico di Rollandin Emilie</p>
            </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
