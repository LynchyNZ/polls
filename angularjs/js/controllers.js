(function () {
    'use strict';

    /* Controllers */

    // Global "database"

    var pollsControllers = angular.module('pollsControllers', []);
    
    // Controller for Poll list page
    pollsControllers.controller('PollsListCtrl', function ($scope, $http) {
        var pollsUrl = "./index.php/services/polls";
        
        $http.get(pollsUrl) .then(function(response) {
            $scope.polls = response.data;
        });
    });
    
    // Controller for Voting page for a Poll
    pollsControllers.controller('PollVoteCtrl', function($scope, $http, $routeParams) {
        var pollId = $routeParams.pollId;
        var pollUrl = "././index.php/services/polls/" + pollId;
        
        // Get details about the poll
        $http.get(pollUrl) .then(function(response) {
            $scope.poll = response.data;
            $scope.poll.answers = $scope.poll.answers.split(','); // Split answers by commas
        });
            
        $scope.voteId = {
            id: 999 // Default ID, overridden by selected answer when submitting vote
        };
        
        // Submits a vote through backend services, by generating a URL with given voteID (and pollID)
        $scope.submitVote = function() {
            var voteId = $scope.voteId.id;
            var voteUrl = "././index.php/services/votes/" + pollId + "/" + voteId;
                
            $http.get(voteUrl) .then(function(response) {
                $scope.result = response.data;
            });
        };
    });    
    
    // Controller for the Admin page (view polls, view votes, delete votes, create new poll)
    pollsControllers.controller('PollAdminCtrl', function($scope, $http, $routeParams) {
        $scope.viewPolls = function() {
            var pollsUrl = "./index.php/services/polls";
        
            $http.get(pollsUrl) .then(function(response) {
                $scope.polls = response.data;
            });
        };
        
        // Gets votes for a given poll by accessing backend URL
        $scope.viewVotes = function($poll) {
            $scope.pollanswers = $poll.answers.split(',');
            var pollId = $poll.id;
            var viewUrl = "./index.php/services/votes/" + pollId;
           
            $http.get(viewUrl) .then(function(response) {
                  $scope.votes = response.data; // Loads the votes into $scope.votes
            });
        };
        
        // When an admin deletes votes for a poll, send request to database through backend URL
        $scope.deleteVotes = function($poll) {
            var pollId = $poll.id;
            var deleteUrl = "./index.php/services/deletevotes/" + pollId;
          
            $http.get(deleteUrl) .then(function(response) {
                $scope.result = response.data;
                $scope.viewVotes($poll); // Reload votes on view to reflect deletion (ie. votes reset to 0)
            }); 
        };
        
        // Takes inputs from form and sends to database through backend URL
        // I do some encoding that is missed by the in-built function to the inputs
        // The inputs are then encoded to a URL friendly format, using Javascripts' encodeURIComponent
        $scope.createPoll = function() {
            $scope.newpoll.title = $scope.newpoll.title.replace(/'/g, "%27");
            $scope.newpoll.question = $scope.newpoll.question.replace(/'/g, "%27");
            $scope.newpoll.answers = $scope.newpoll.answers.replace(/'/g, "%27");
            
            $scope.newpoll.title = $scope.newpoll.title.replace(/[(]/g, "%28");
            $scope.newpoll.question = $scope.newpoll.question.replace(/[(]/g, "%28");
            $scope.newpoll.answers = $scope.newpoll.answers.replace(/[(]/g, "%28");
            
            $scope.newpoll.title = $scope.newpoll.title.replace(/[)]/g, "%29");
            $scope.newpoll.question = $scope.newpoll.question.replace(/[)]/g, "%29");
            $scope.newpoll.answers = $scope.newpoll.answers.replace(/[)]/g, "%29");

            $scope.newpoll.title = $scope.newpoll.title.replace(/[!]/g, "%21");
            $scope.newpoll.question = $scope.newpoll.question.replace(/[!]/g, "%21");
            $scope.newpoll.answers = $scope.newpoll.answers.replace(/[!]/g, "%21");
 
            $scope.newpoll.title = $scope.newpoll.title.replace(/[~]/g, "%7E");
            $scope.newpoll.question = $scope.newpoll.question.replace(/[~]/g, "%7E");
            $scope.newpoll.answers = $scope.newpoll.answers.replace(/[~]/g, "%7E");     
            
            $scope.newpoll.title = $scope.newpoll.title.replace(/[*]/g, "%2A");
            $scope.newpoll.question = $scope.newpoll.question.replace(/[*]/g, "%2A");
            $scope.newpoll.answers = $scope.newpoll.answers.replace(/[*]/g, "%2A");  
                
            var title = encodeURIComponent($scope.newpoll.title);
            var question = encodeURIComponent($scope.newpoll.question);
            var answers = encodeURIComponent($scope.newpoll.answers);
            
            var createUrl = "./index.php/services/createpoll/" + title + "/" + question + "/" + answers;
           
            $http.get(createUrl) .then(function(response) {
                $scope.pollresult = response.data;
            }); 
            
            $scope.viewPolls(); // Reloads the polls to show the newly created poll
        };
        
        // Loads the viewPolls function
        $scope.viewPolls(); 
    });
    
  }())
  