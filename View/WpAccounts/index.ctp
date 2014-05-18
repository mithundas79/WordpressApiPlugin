<?php
$this->Paginator->options(array('url' => $passArg));
?>
<div class="users index">
	<h2><?php echo __('Wordpress Accounts Manager: Wordpress Accounts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
    <tr>
        <th style="text-align: center; width: 30px;"><?php echo $this->Paginator->sort('name'); ?>
        </th>
        <th style="text-align: center;"><?php echo $this->Paginator->sort('host'); ?>
        </th>
        <th style="text-align: center; width: 150px;"><?php echo $this->Paginator->sort('firstname', 'User'); ?>
        </th>
        <th style="text-align: center; width: 150px;"><?php echo $this->Paginator->sort('created'); ?>
        </th>
        <?php //if ($this->Acl->check('WpAccounts', 'view', 'WordpressManager') == true || $this->Acl->check('WpAccounts', 'edit', 'WordpressManager') == true || $this->Acl->check('WpAccounts', 'delete', 'WordpressManager') == true) { ?>
            <th style="text-align: center; width: 150px;"><?php echo __('Actions'); ?>
            </th>
        <?php //} ?>
    </tr>
	<?php foreach ($wp_accounts as $wp_account): ?>
	<tr>
        <td style="text-align: center;"><?php echo h($wp_account['WpAccount']['name']); ?>&nbsp;</td>
        <td><?php echo h($wp_account['WpAccount']['host']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($wp_account['User']['firstname']); ?></td>
        <td style="text-align: center;"><?php echo h($wp_account['WpAccount']['created']); ?>&nbsp;</td>
        <?php //if ($this->Acl->check('WpAccounts', 'view', 'WordpressManager') == true || $this->Acl->check('WpAccounts', 'edit', 'WordpressManager') == true || $this->Acl->check('WpAccounts', 'delete', 'WordpressManager') == true) { ?>
            <td style="text-align: center;">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $wp_account['WpAccount']['id']), array('class' => 'btn btn-mini')); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $wp_account['WpAccount']['id']), array('class' => 'btn btn-mini btn-primary')); ?>
                <a href="javascript:void(0);" class="btn btn-mini btn-danger" onclick="delWpAccount(<?php echo h($wp_account['WpAccount']['id']); ?>, '<?php echo h($wp_account['WpAccount']['name']); ?>');"><?php echo __("Delete"); ?></a>
            </td>
        <?php //} ?>
    </tr>
<?php endforeach; ?>
	</table>
	
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Manage Accounts'), array('plugin' => 'wordpress_manager', 'controller' => 'user_emails', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('Wordpress Reader'), array('plugin' => 'wordpress_manager', 'controller' => 'wp_readers', 'action' => 'index')); ?></li>
	</ul>
</div>
