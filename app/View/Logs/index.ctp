<h2>本日の記録</h2>
<table cellpadding="0" cellspacing="0">
  <tr>
	<th>No.</th>
	<th><?php echo $this->Paginator->sort('title'); ?></th>
	<th><?php echo $this->Paginator->sort('content'); ?></th>
	<th class="actions"><?php echo __('Actions'); ?></th>
  </tr>
  <?php
$cnt = 1;
foreach ($logs as $log): 
  ?>
  <tr>
	<td>
	  <?php
echo $cnt;
$cnt += 1;
		 ?>
	</td>
	<td><?php echo h($log['Log']['title']); ?>&nbsp;</td>
	<td><?php echo h($log['Log']['content']); ?>&nbsp;</td>
	<td class="actions">
	  <?php echo $this->Html->link(__('View'), array('action' => 'view', $log['Log']['id'])); ?>
	  <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $log['Log']['id'])); ?>
	  <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $log['Log']['id']), null, __('Are you sure you want to delete # %s?', $log['Log']['id'])); ?>
	</td>
  </tr>
  <?php endforeach; ?>
</table>
