<?php
/**
 * @file polls.php
 * @author Matthew Ruffell
 * @date 10 October 2014
 * @brief This file simply serves up the original angular frontpage
 */
echo doctype('html5');
?>


<html lang="en" ng-app="pollsApp">
<head>
  <meta charset="utf-8">
  <title>Polls</title>
  <?php
  $links = array (
    "angularjs/scripts/angular.js", 
    "angularjs/scripts/angular-route.js",
    "angularjs/js/app.js",
    "angularjs/js/controllers.js"
    );
  $scripts = "";
  foreach ($links as $value) {
      $scripts.= '<script src="';
      $scripts.= base_url($value);
      $scripts.= '"></script>';
      $scripts.= "\n";
  }
  echo $scripts;
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="angularjs/css/site.css" type="text/css" rel="stylesheet">
</head>
<body>

  <div ng-view></div>

</body>
</html>