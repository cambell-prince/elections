'use strict';

/* Controllers */
var app = angular.module('el.elections',
    [
      'el.services',
      'sgw.ui.breadcrumb'
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
    electionService.list(function(result) {
      if (result.ok) {
        $scope.elections = result.data.entries;
        $scope.electionCount = result.data.count;
      }
    });
  };

  // Remove
  $scope.removeElections = function() {
    console.log("removeElections");
    var electionIds = [];
    for (var i = 0, l = $scope.selected.length; i < l; i++) {
      electionIds.push($scope.selected[i].id);
    }
    if (l == 0) {
      // TODO ERROR
      return;
    }
    electionService.remove(electionIds, function(result) {
      if (result.ok) {
        $scope.queryElections();
        // TODO
      }
    });
  };

  $scope.selectUser = function(item) {
    console.log("Called selectUser(", item, ")");
  };

  // Create
  $scope.addElection = function() {
    var model = {};
    model.id = '';
    model.name = $scope.name;
    console.log("addElection ", model);
    electionService.update(model, function(result) {
      if (result.ok) {
        // TODO broadcast notice and add
        $scope.queryElections();
      }
    });
  };

  /*
   * $scope.imageSource = function(avatarRef) { return avatarRef ?
   * '/images/avatar/' + avatarRef : '/images/avatar/anonymous02.png'; };
   */

}]);
