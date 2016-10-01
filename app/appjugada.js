var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Jugada',
      templateUrl: 'partials/jugada.html',
      controller: 'jugadaCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    