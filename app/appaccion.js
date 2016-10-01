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
    