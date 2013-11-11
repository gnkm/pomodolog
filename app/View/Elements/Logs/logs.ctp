<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>タイトル</th>
      <th>詳細</th>
      <th>タグ</th>
      <th>作成</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $cnt = 1;
    foreach ($logs as $log): 
    ?>
    <tr>
      <td>
	    <?php
        echo $cnt;
        $cnt += 1;
		 ?>&nbsp;
      </td>
	  <td><?php echo h($log['Log']['title']); ?>&nbsp;</td>
	  <td><?php echo h($log['Log']['content']); ?>&nbsp;</td>
      <td>
        <?php if (!empty($log['Tag'])): ?>
		<?php foreach($log['Tag'] as $tag): ?>
		<?php echo $this->Html->link(h($tag['name']), array()); ?>
		, 
		<?php endforeach; ?>
		<?php endif; ?>
      </td>
	  <td><?php echo h($log['Log']['created']); ?>&nbsp;</td>
      <td clas="actions">
        <button type="button" class="btn btn-default btn-xs">
          <span class="glyphicon glyphicon-pencil"></span> 編集
        </button>
        <button type="button" class="btn btn-default btn-xs">
          <span class="glyphicon glyphicon-trash"></span> 削除
        </button>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
