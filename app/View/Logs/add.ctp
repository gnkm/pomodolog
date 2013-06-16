<h1>記録</h1>
<?php

echo $this->Form->create('Log', array('action' => 'add'));
echo $this->Form->input('created', array('label' => '実施日時'));
echo $this->Form->hidden('user_id', array('value' => $user_id));
echo $this->Form->input('title', array('label' => '概要'));
echo $this->Form->input('content', array('label' => '詳細', 'type' => 'textarea'));
echo $this->Form->end('この内容で記録する');

?>