'use strict';

// Declare app level module which depends on filters, and services
angular.module('silElections', 
    ['el.elections', 'el.election', 'sgw.ui.breadcrumb', 'ngRoute']
  )
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/elections', {
      templateUrl : '/app/views/elections.html',
      controller : 'ElectionsCtrl'
    });
    $routeProvider.when('/election/:electionId', {
      templateUrl : '/app/views/election.html',
      controller : 'ElectionCtrl'
    });
    $routeProvider.otherwise({
      redirectTo : '/elections'
    });
  }])
  .controller('ElectionCtrl', ['$scope', '', function($scope) {
  }])
  ;
