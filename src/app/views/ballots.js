'use strict';

/* Controllers */
var module = angular.module('el.ballots',
  [
    'el.services',
    'ngRoute',
    'sgw.ui.breadcrumb'
  ]
)
.controller('BallotsCtrl', ['$scope', '$routeParams', 'breadcrumbService', 'electionService', function($scope, $routeParams, breadcrumbService, electionService) {
  $scope.debug = {};

  $scope.settings = {};
  $scope.election = {};
  $scope.election.id = $routeParams.id;

  breadcrumbService.set('top', [{
    href : '#/elections',
    label : 'All Elections'
  }, {
    href : '#/election/' + $scope.election.id,
    label : ''
  }, {
    href : '#/election/' + $scope.election.id + '/ballots',
    label : 'Ballots'
  }]);
  var updateBreadcrumbs = function() {
    breadcrumbService.updateCrumb('top', 1, {
      label : $scope.election.name
    });
  };

  // Read
  $scope.queryElection = function() {
    electionService.get({'id': $scope.election.id }, function(response) {
        $scope.election = response.result;
        console.log('get return', response.result);
        updateBreadcrumbs();
    });
  };
  $scope.queryElection();
  
  $scope.addBallots = function() {
    console.log($scope.generateCount);
  }
  
}])
;
