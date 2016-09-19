(function () {
    'use strict';

    /* App Module */

    var pollsApp = angular.module('pollsApp', [
      'ngRoute',
      'pollsControllers'
    ]);

    pollsApp.config(['$routeProvider',
      function($routeProvider) {
        $routeProvider.
          when('/polls', {
            templateUrl: 'angularjs/partials/polls-list.html',
            controller: 'PollsListCtrl'
          }).
          when('/polls/:pollId', {
            templateUrl: 'angularjs/partials/polls-vote.html',
            controller: 'PollVoteCtrl'
          }).
            when('/polladmin', {
            templateUrl: 'angularjs/partials/polls-admin.html',
            controller: 'PollAdminCtrl'
          }).
            when('/about', {
            templateUrl: 'angularjs/partials/polls-about.html',
          }).
          otherwise({
            redirectTo: '/polls'
          });
      }]);
}())
