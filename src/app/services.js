'use strict';

// Services
// StudioLive common services
angular.module('el.services',
    ['ngResource']
  )
  .factory('electionService', ['$resource', function($resource) {
    return $resource(
      "/api/election/:id",
      null,
      {'query': { method: 'GET', isArray: false }}
    );
  }])
  ;
