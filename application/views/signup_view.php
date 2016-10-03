<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Signup Form </title>
	<link href="<?php echo base_url("bootstrap/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
<body ng-app="app">
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/home">home</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if ($this->session->userdata('login')){ ?>
				<li><p class="navbar-text">Hello <?php echo $this->session->userdata('uname'); ?></p></li>
				<li><a href="<?php echo base_url(); ?>index.php/home/logout">Log Out</a></li>
				<?php } else { ?>
				<li><a href="<?php echo base_url(); ?>index.php/login">Login</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/signup">Signup</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="row">



		<div class="col-md-4 col-md-offset-4 well" ng-controller="Controller">
			<?php $attributes = array("name" => "signupform");
			echo form_open("signup/index", $attributes);?>
			<legend>Signup</legend>
			
			<div class="form-group">
				<label for="name">First Name</label>
				<input ng-model="fio" required ng-pattern="namePattern" class="form-control" name="fio" placeholder="FIO" type="text" value="<?php echo set_value('fio'); ?>" />
				<span ng-show="signupform.fio.$touched && signupform.fio.$invalid">The name is incorrect.</span>
				<span class="text-danger"><?php echo form_error('fio'); ?></span>
			</div>			
		
			<div class="form-group">
				<label for="phone">Phone</label>
				<input ng-model="phone" class="form-control" ng-pattern="phonePattern" name="phone" placeholder="Phone" type="text" value="<?php echo set_value('phone'); ?>" />
				<span ng-show="signupform.phone.$touched && signupform.phone.$invalid">Phone is incorrect.</span>
				<span class="text-danger"><?php echo form_error('phone'); ?></span>
			</div>
		
			<div class="form-group" >
				<label for="email">Email </label>
				<input ng-model="email" required ng-pattern="emailPattern" class="form-control" name="email" placeholder="Email" type="text" value="<?php echo set_value('email'); ?>" />
				<span ng-show="signupform.email.$touched && signupform.email.$invalid">Email is incorrect.</span>
				<span class="text-danger"><?php echo form_error('email'); ?></span>
			</div>

			<div class="form-group">
				<label for="subject">Password</label>
				<input ng-model="password" required ng-pattern="passwordPattern" class="form-control" name="password" placeholder="Password" type="password" />
				<span ng-show="signupform.password.$touched && signupform.password.$invalid">Password is incorrect.(6+)</span>
				<span class="text-danger"><?php echo form_error('password'); ?></span>
			</div>

			<div class="form-group">
				<label for="subject">Confirm Password</label>
				<input ng-model="cpassword" ng-pattern="password" class="form-control" name="cpassword" placeholder="Confirm Password" type="password" />
				<span ng-show="signupform.cpassword.$touched && signupform.cpassword.$invalid">Password isn't same.</span>
				<span class="text-danger"><?php echo form_error('cpassword'); ?></span>
			</div>

			<div class="form-group">
				<button name="submit" type="submit" class="btn btn-info">Signup</button>
				<button name="cancel" type="reset" class="btn btn-info">Cancel</button>
			</div>
			<?php echo form_close(); ?>
			<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="<?php echo base_url(); ?>index.php/login">Login Here</a>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url("bootstrap/js/jquery-1.10.2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("bootstrap/js/bootstrap.js"); ?>"></script>
<script>
var app = angular.module('app', []);

app.controller('Controller', ['$scope', function($scope) {
      $scope.emailPattern = /^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/;
      $scope.phonePattern = /^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i;

      $scope.namePattern = /^[а-яА-ЯёЁ ]+$/i;
      $scope.passwordPattern = /^.{6,}$/;


    }]);


</script>
</body>
</html>