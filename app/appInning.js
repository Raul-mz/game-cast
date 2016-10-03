var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Inning',
      templateUrl: 'partials/inning.html',
      controller: 'inningCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);

//select JUGADOR
var angularTodo = angular.module('selectsD', []);
function controllerForm($scope, $http) {
      $scope.JSONJugadors = [ ];
      obtenerJugadors($http,$scope);
      // EVENTO QUE GENERA BOTON LIMPIAR
  
 } 
  function obtenerJugadors($http,$scope){
        console.log('Error:s dddddddddddddddddddaaaa');
      
       $http.post('beisbol/model/index.php',{ metodo : 'obtenerJugadors' })
       .success(function(data) {
            var array = data == null ? [] : (data.jugadors instanceof Array ? data.jugadors : [data.jugadors]);
            $scope.JSONJugadors  = array;
              $scope.selJugadors   = $scope.JSONJugadors;
         console.log('Error:s aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        })
        .error(function(data) {
            console.log('Error:s ' + data);
        });    
  }

//select JUGADa
var angularTodo = angular.module('selectsJugada', []);
function controllerForm($scope, $http) {
      $scope.JSONJugadas = [ ];
      obtenerJugadas($http,$scope);
      // EVENTO QUE GENERA BOTON LIMPIAR
  
 } 
  function obtenerJugadas($http,$scope){
        console.log('Error:s dddddddddddddddddddaaaa');
      
       $http.post('beisbol/model/index.php',{ metodo : 'obtenerJugadas' })
       .success(function(data) {
            var array = data == null ? [] : (data.jugadas instanceof Array ? data.jugadas : [data.jugadas]);
            $scope.JSONJugadas  = array;
              $scope.selJugadas   = $scope.JSONJugadas;
         console.log('Error:s aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        })
        .error(function(data) {
            console.log('Error:s ' + data);
        });    
  }
