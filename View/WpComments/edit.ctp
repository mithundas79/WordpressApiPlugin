<div class="wpReaders form">
    <form method="post" action="" enctype="multipart/form-data">
	<fieldset>
		<legend><?php echo __('Edit Comment'); ?></legend>
	<?php
        echo $this->Form->input('content');
		echo $this->Form->input('status', array('type'=>'select', 'options'=>$statusList));
        echo $this->Form->input('author');
        echo $this->Form->input('author_url');
        echo $this->Form->input('author_email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Manage Posts'), array('controller' => 'wp_readers', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('Manage Categories'), array('controller' => 'wp_readers', 'action' => 'categories')); ?></li>
        <li><?php echo $this->Html->link(__('Manage Pages'), array('controller' => 'wp_pages', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('Manage Comments'), array('controller' => 'wp_comments', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('Manage Media'), array('controller' => 'wp_uploads', 'action' => 'index')); ?></li>
    </ul>
</div>
