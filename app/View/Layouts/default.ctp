<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

//		echo $this->Html->css('cake.generic');
//		echo $this->Html->css('inuit/inuit');
//		echo $this->Html->css('inuit/css/style.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <!-- <link rel="stylesheet" href="https://djyhxgczejc94.cloudfront.net/frameworks/bootstrap/3.0/themes/cirrus/bootstrap.min.css"> -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.0.1/flatly/bootstrap.min.css">
</head>
  <body>
    <div class="container">
      <div class="navbar">
        <a href="#" class="navbar-brand">Pomodolog</a>
        <ul class="nav navbar-nav">
          <li class="active">
            <a href="#">Today</a>
          </li>
          <li>
            <a href="#">Weekly Review</a>
          </li>
          <li>
            <a href="#">Monthly Review</a>
          </li>
          <li>
            <a href="#">Annual Review</a>
          </li>
        </ul>
      </div>
	  <div id="content">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	  </div>
	  <div id="footer">
	  </div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
</html>
