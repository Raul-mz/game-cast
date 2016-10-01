var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Posicion',
      templateUrl: 'partials/posicion.html',
      controller: 'posicionCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    