<style>
    <!--
    .form-horizontal .control-label {
        padding-top: 0px;
    }
    -->
</style>
<div class="container">
    <h2>
        <?php echo __('Wordpress Accounts Manager: Wordpress Accounts (view)'); ?>
    </h2>
    <div class="row-fluid show-grid" id="tab_user_manager">
        <div class="span12">
            <ul class="nav nav-tabs">
                <?php if ($this->Acl->check('WpAccounts', 'index', 'WordpressManager') == true) { ?>
                    <li class="active"><?php echo $this->Html->link(__('Manage Accounts'), array('plugin' => 'wordpress_manager', 'controller' => 'user_emails', 'action' => 'index')); ?></li>
                <?php } ?>
                <?php if ($this->Acl->check('WpReader', 'index', 'WordpressManager') == true) { ?>
                    <li><?php echo $this->Html->link(__('Wordpress Reader'), array('plugin' => 'wordpress_manager', 'controller' => 'wp_readers', 'action' => 'index')); ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="row-fluid show-grid">
        <div class="span12">
            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label"><?php echo __('User'); ?>
                    </label>
                    <div class="controls">
                        <?php echo h($wp_account['User']['firstname']); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo __('Name'); ?>
                    </label>
                    <div class="controls">
                        <?php echo h($wp_account['WpReader']['name']); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo __('Host'); ?>
                    </label>
                    <div class="controls">
                        <?php echo h($wp_account['WpReader']['host']); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo __('Username'); ?>
                    </label>
                    <div class="controls">
                        <?php echo h($wp_account['WpReader']['wp_username']); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo __('Password'); ?>
                    </label>
                    <div class="controls">
                        <?php echo h($wp_account['WpReader']['wp_password']); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo __('Path'); ?>
                    </label>
                    <div class="controls">
                        <?php echo h($wp_account['WpReader']['path']); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo __('Public'); ?>
                    </label>
                    <div class="controls">
                        <?php 
                        if($wp_account['WpReader']['is_public'] == 1){
                            echo 'Public';
                        }else{
                            echo 'Private';
                        }
                        ?>
                    </div>
                </div>

                <div class="form-actions">
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $wp_account['WpReader']['id']), array('class' => 'btn  btn-primary')); ?>
                    <a class="btn " onclick="cancel_add();"><?php echo __('Cancel'); ?>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function cancel_add() {
        window.location = '<?php echo Router::url(array('plugin' => 'wordpress_manager', 'controller' => 'wp_accounts', 'action' => 'index')); ?>';
    }
</script>
