var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Estadio',
      templateUrl: 'partials/estadio.html',
      controller: 'estadioCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    