<?php

$cakeDescription = __d('cake_dev', 'FarmaLink');
?>
<!DOCTYPE html>
<html>
<head>
	
	<meta charset="UTF-8">
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php
		echo $this->Html->meta('icon');
?>
	<link href='http://fonts.googleapis.com/css?family=Raleway:900,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	
	
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<?php	
	
		echo $this->Html->css('reset');
		echo $this->Html->css('style');
		echo $this->Html->css('bootstrap');
		
		echo $this->Html->script('jquery-2.1.0.min');
		echo $this->Html->script('jquery.tablesorter');

		echo $this->Html->script('jquery.autocomplete.min');
		echo $this->Html->script('currency-autocomplete');
	
	
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<?php /*
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" />*/ ?>
	<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
	
	<script type="text/javascript" src="DataTables/media/js/jquery.dataTables.min.js"></script>
	
	
</head>

<body>
	<div id="container">
	
	
		<div id="header">
			<?php echo $this->element('header'); ?>
		</div>
		
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		
		
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	
	
	<?php /*
	<?php echo $this->element('sql_dump'); ?>
	<?php debug($auth_user);  */ ?>
</body>
</html>
