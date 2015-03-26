'use strict';

// Services
// StudioLive common services
angular.module('el.services',
    ['ngResource']
  )
  .service('electionService', ['$resource', function($resource) {
    this.read = function(id, callback) {
      jsonRpc.call('show_read', [id], callback);
    };
    this.update = function(model, callback) {
      jsonRpc.call('show_update', [model], callback);
    };
    this.remove = function(showIds, callback) {
      jsonRpc.call('show_delete', [showIds], callback);
    };
    this.list = function(callback) {
      // TODO Paging CP 2013-07
      jsonRpc.call('show_list', [], callback);
    };
    this.updateAction = function(showId, model, callback) {
      jsonRpc.call('show_updateAction', [showId, model], callback);
    };
    this.removeAction = function(showId, actionId, callback) {
      jsonRpc.call('show_removeAction', [showId, actionId], callback);
    };
    this.previewAction = function(action, operation, callback) {
      jsonRpc.call('caspar_executeAction', [action, operation, null], callback);
    };
    this.settingsRead = function(callback) {
      jsonRpc.call('settings_read', [], callback);
    };
    this.settingsUpdate = function(settings, callback) {
      jsonRpc.call('settings_update', [settings], callback);
    };
  }])
  ;
