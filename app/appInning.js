var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Inning',
      templateUrl: 'partials/inning.html',
      controller: 'inningCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    