'use strict';

/* Controllers */
var module = angular.module('el.election',
   [
     'el.services',
     'ngRoute',
     'sgw.ui.breadcrumb'
   ]
)
.controller('ElectionCtrl', ['$scope', '$routeParams', 'breadcrumbService', 'electionService', function($scope, $routeParams, breadcrumbService, electionService) {
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
  }, ]);
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
  
  $scope.addCandidate = function() {
    var model = { name: ''};
    if ($scope.election.candidates == undefined) {
      $scope.election.candidates = [];
    }
    console.log($scope.election);
    $scope.election.candidates.push(model);
  }
  
  $scope.removeCandidate = function(index) {
    $scope.election.candidates.splice(index, 1);
  }
  
  $scope.save = function() {
    console.log($scope.election);
    electionService.save($scope.election, function(response) {
      console.log('update done');
      updateBreadcrumbs();
    });
  }
  
}])
;
