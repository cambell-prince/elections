'use strict';

/* Controllers */
var app = angular.module('el.elections',
    [
      'el.services',
      'sgw.ui.breadcrumb',
      'palaso.ui.listview'
    ]
  )
  .controller('ElectionsCtrl', ['$scope', 'breadcrumbService', 'electionService', function($scope, breadcrumbService, electionService) {

  breadcrumbService.set('top', [{
    href : '#/elections',
    label : 'All Elections'
  }, ]);

  // Selection
  $scope.selected = [];
  $scope.updateSelection = function(event, item) {
    var selectedIndex = $scope.selected.indexOf(item);
    var checkbox = event.target;
    if (checkbox.checked && selectedIndex == -1) {
      $scope.selected.push(item);
    } else if (!checkbox.checked && selectedIndex != -1) {
      $scope.selected.splice(selectedIndex, 1);
    }
  };
  $scope.isSelected = function(item) {
    return item != null && $scope.selected.indexOf(item) >= 0;
  };

  // List
  $scope.elections = [];
  $scope.queryElections = function() {
    console.log('query elections');
    electionService.query(function(result) {
      console.log(result);
      $scope.elections = result.entries;
      $scope.electionCount = result.count;
    });
  };

  // Remove
  $scope.removeElection = function(id) {
    console.log("removeElection", id);
    electionService.remove({'id': id}, function(result) {
      $scope.queryElections();
    });
  };

  $scope.selectUser = function(item) {
    console.log("Called selectUser(", item, ")");
  };

  // Create
  $scope.addElection = function() {
    var model = {};
    model.id = '';
    model.name = "New Election";
    console.log("addElection ", model);
    electionService.save(model, function(result) {
      console.log("addElection return");
      // TODO broadcast notice and add
      $scope.queryElections();
    });
  };

  /*
   * $scope.imageSource = function(avatarRef) { return avatarRef ?
   * '/images/avatar/' + avatarRef : '/images/avatar/anonymous02.png'; };
   */

}]);
