<nav class="navbar" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
    </button>
    <?php echo $this->Html->link('Pomodolog', array('controller' => 'logs', 'action' => 'index'), array('class' => 'navbar-brand')); ?>
  </div>

  <div class="collapse navbar-collapse">
	<ul class="nav navbar-nav">
	  <li class="active">
		<?php echo $this->Html->link('Today', array('controller' => 'logs', 'action' => 'index')); ?>
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
	<ul class="nav navbar-nav navbar-right">
      <li>
        <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
      </li>
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
		  <span class="glyphicon glyphicon-cog"></span><b class="caret"></b>
		</a>
        <ul class="dropdown-menu">
          <li>
			<?php echo $this->Html->link('setting', array('controller' => 'users', 'action' => 'setting', $login_user_id)); ?>
		  </li>
          <li>
		  </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
