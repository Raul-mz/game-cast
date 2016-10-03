var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {

    $routeProvider.
    when('/', {
      title: 'Tabla de Posiciones',
      templateUrl: 'partials/tabla.html'
      controller: 'equipoPosicionCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    
