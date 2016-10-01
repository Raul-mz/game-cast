var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Posicion',
      templateUrl: 'partials/equipoPosicion.html',
      controller: 'equipoPosicionCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    