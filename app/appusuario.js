var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Usuario',
      templateUrl: 'partials/usuario.html',
      controller: 'usuarioCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    