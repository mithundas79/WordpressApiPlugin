<div class="divisions form">
    <h2>
        <?php echo __('Wordpress Accounts Manager: Wordpress Accountss (edit)'); ?>
    </h2>
    
    <div class="row-fluid show-grid">
        <div class="span12">
            <?php if (count($errors) > 0) { ?>
                <div class="alert alert-error">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <?php foreach ($errors as $error) { ?>
                        <?php foreach ($error as $er) { ?>
                            <strong><?php echo __('Error!'); ?> </strong>
                            <?php echo h($er); ?>
                            <br />
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php echo $this->Form->create('WpAccount', array('class' => 'form-horizontal')); ?>
            <?php echo $this->Form->input('id'); ?>
            <div class="control-group">
                <label class="control-label"><?php echo __('Name'); ?><span
                        style="color: red;">*</span> </label>
                <div class="controls">
                    <?php echo $this->Form->input('name', array('div' => false, 'label' => false, 'error' => false, 'class' => 'input-xxlarge')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo __('Host'); ?><span
                        style="color: red;">*</span> </label>
                <div class="controls">
                    <?php echo $this->Form->input('host', array('div' => false, 'label' => false, 'error' => false, 'class' => 'input-xxlarge')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo __('Username'); ?><span
                        style="color: red;">*</span> </label>
                <div class="controls">
                    <?php echo $this->Form->input('wp_username', array('div' => false, 'label' => false, 'error' => false, 'class' => 'input-xxlarge')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo __('Password'); ?><span
                        style="color: red;">*</span> </label>
                <div class="controls">
                    <?php echo $this->Form->input('wp_password', array('div' => false, 'label' => false, 'error' => false, 'class' => 'input-xxlarge')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo __('Path'); ?><span
                        style="color: red;">*</span> </label>
                <div class="controls">
                    <?php echo $this->Form->input('path', array('div' => false, 'label' => false, 'error' => false, 'class' => 'input-xxlarge')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo __('Public'); ?> </label>
                <div class="controls">
                    <?php echo $this->Form->input('is_public', array( 'label' => false, 'options' => array('No', 'Yes'))); ?>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary"
                       value="<?php echo __('Save Account'); ?>" /> <input type="submit"
                       class="btn" value="<?php echo __('Cancel'); ?>"
                       onclick="return cancel_edit();" />
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Manage Accounts'), array('plugin' => 'wordpress_manager', 'controller' => 'user_emails', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('Wordpress Reader'), array('plugin' => 'wordpress_manager', 'controller' => 'wp_readers', 'action' => 'index')); ?></li>
	</ul>
</div>
<script>
    function cancel_edit() {
        window.location = '<?php echo Router::url(array('plugin' => 'wordpress_manager', 'controller' => 'wp_accounts', 'action' => 'index')); ?>';
        return false;
    }
</script>
