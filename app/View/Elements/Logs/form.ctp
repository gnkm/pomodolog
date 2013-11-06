<?php echo $this->Form->create('Log', array('action' => 'add')); ?>
<?php 
echo $this->Form->input('title', array('label' => 'Title')); 
echo $this->Form->input('content', array('label' => 'Content')); 
echo $this->Form->input('tag', array('label' => 'Tags')); 
// user info
echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user_id )); 
?>
<?php echo $this->Form->end('Submit'); ?>