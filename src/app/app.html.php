<!doctype html>
<html lang="en" ng-app="silElections">
<head>
	<meta charset="utf-8">
	<title>Elections</title>
		<link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css" />
	    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap-theme.css" />
		<link rel="stylesheet" href="/vendor/fortawesome/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/app.css" />
</head>
<body>
<div ng-controller="ElectionsCtrl">
<ul class="breadcrumb indicator pull-right">
	<li class="settings"><a href="#/settings"><i class="icon-gear"></i></a></li>
</ul>
<ul id="top" breadcrumbs></ul>
</div>
<div ng-view></div>
<div id="version" style="clear: both">Elections: <span><?php echo $version;?></span></div>

<script	src="/vendor_bower/angular/angular.js"></script>
<script	src="/vendor_bower/angular-route/angular-route.min.js"></script>
<script	src="/vendor_bower/angular-resource/angular-resource.min.js"></script>
<script	src="/vendor_bower/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>

<?php foreach($scripts as $script): ?>
<script src="<?php echo $script; ?>"></script>
<?php endforeach; ?>

</body>
</html>