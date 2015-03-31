'use strict';

// Declare app level module which depends on filters, and services
angular.module('silElections', 
    [
      'el.elections',
      'el.election',
      'el.ballots',
      'sgw.ui.breadcrumb',
      'ngRoute'
    ]
  )
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/elections', {
      templateUrl : '/app/views/elections.html',
      controller : 'ElectionsCtrl'
    });
    $routeProvider.when('/election/:id/ballots', {
      templateUrl : '/app/views/ballots.html',
      controller : 'BallotsCtrl'
    });
    $routeProvider.when('/election/:id', {
      templateUrl : '/app/views/election.html',
      controller : 'ElectionCtrl'
    });
    $routeProvider.otherwise({
      redirectTo : '/elections'
    });
  }])
  .controller('MainCtrl', ['$scope', function($scope) {
  }])
  ;
