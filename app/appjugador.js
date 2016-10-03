var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {

    $routeProvider.
    when('/', {
      title: 'Jugador',
      templateUrl: 'partials/jugador.html',
      controller: 'jugadorCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    
var angularTodo = angular.module('selectsD', []);
function controllerForm($scope, $http) {
      $scope.JSONEquipos = [ ];
      obtenerEquipos($http,$scope);
      
 } 
  function obtenerEquipos($http,$scope){
        console.log('Error:s dddddddddddddddddddaaaa');
      
       $http.post('beisbol/model/index.php',{ metodo : 'obtenerEquipos' })
       .success(function(data) {
            var array = data == null ? [] : (data.equipos instanceof Array ? data.equipos : [data.equipos]);
            $scope.JSONEquipos  = array;
              $scope.selEquipos   = $scope.JSONEquipos;
         console.log('Error:s aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        })
        .error(function(data) {
            console.log('Error:s ' + data);
        });    
  }
  