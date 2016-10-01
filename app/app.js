var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Equipo',
      templateUrl: 'partials/equipo.html',
      controller: 'equipoCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    