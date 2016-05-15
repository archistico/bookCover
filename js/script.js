function mainController($scope) {
    $scope.tipologia = {selezionato: 0};

    $scope.$watch('tipologia.selezionato', function(value) {
       switch (value) {
            case 0:
                $scope.immagine = "img/coverExample.png";
                break;
            case 1:
                $scope.immagine = "img/coverExampleAlette.png";
                break;
        }
 });

}

angular.module("bookcoverApp", [])
        .controller("mainController", mainController);
