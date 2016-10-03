var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Accion',
      templateUrl: 'partials/accion.html',
      controller: 'accionCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
//select estadio
var angularTodo = angular.module('selectsEstadio', []);
function controllerForm($scope, $http) {
      $scope.JSONEstadios = [ ];
      obtenerEstadio($http,$scope);

      // EVENTO QUE GENERA BOTON LIMPIAR
      $scope.limpiar = function() {
        limpiarForm($scope);
      };
      // EVENTO QUE GENERA LA DIRECTIVA ng-change
  
 } 
  function obtenerEstadio($http,$scope){
        console.log('Error:s dddddddddddddddddddaaaa');
      
       $http.post('beisbol/model/index.php',{ metodo : 'obtenerEstadio' })
       .success(function(data) {
            var array = data == null ? [] : (data.estadios instanceof Array ? data.estadio : [data.estadios]);
            $scope.JSONEstadios  = array;
              $scope.selEstadios   = $scope.JSONEstadios;
         console.log('Error:s aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        })
        .error(function(data) {
            console.log('Error:s ' + data);
        });    
  }
  function limpiarForm($scope){
        $scope.selEstadios = '';
  }

//Equipo

var angularTodo = angular.module('selectsD', []);
function controllerForm($scope, $http) {
      $scope.JSONEquipos = [ ];
      obtenerEquipos($http,$scope);

      // EVENTO QUE GENERA BOTON LIMPIAR
      $scope.limpiar = function() {
        limpiarForm($scope);
      };
      // EVENTO QUE GENERA LA DIRECTIVA ng-change
  
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

  
  function limpiarForm($scope){
        $scope.selEquipos = '';
  }

//Equipo

var angularTodo = angular.module('selectsModerador', []);
function controllerForm($scope, $http) {
      $scope.JSONModeradors = [ ];
      obtenerModerador($http,$scope);

      // EVENTO QUE GENERA BOTON LIMPIAR
      $scope.limpiar = function() {
        limpiarForm($scope);
      };
      // EVENTO QUE GENERA LA DIRECTIVA ng-change
  
 } 
  function obtenerModerador($http,$scope){
        console.log('Error:s dddddddddddddddddddaaaa');
      
       $http.post('beisbol/model/index.php',{ metodo : 'obtenerModerador' })
       .success(function(data) {
            var array = data == null ? [] : (data.moderadors instanceof Array ? data.moderadors : [data.moderadors]);
            $scope.JSONModeradors  = array;
              $scope.selModeradors   = $scope.JSONModeradors;
         console.log('Error:s aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        })
        .error(function(data) {
            console.log('Error:s ' + data);
        });    
  }

  
  function limpiarForm($scope){
        $scope.selModeradors = '';
  }
