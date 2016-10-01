var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Moderador',
      templateUrl: 'partials/moderador.html',
      controller: 'moderadorCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    