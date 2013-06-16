<?php

echo $this->Form->create('User');
echo $this->Form->input('name');
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->end('登録する');
?>