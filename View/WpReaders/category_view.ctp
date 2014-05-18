
<div class="wpReaders view">
    <h2><?php echo __('Wp Category'); ?></h2>
    <dl>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo $wp_term['name']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Content'); ?></dt>
        <dd>
            <?php echo $wp_term['description']; ?>
            &nbsp;
        </dd>
        
    </dl>
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
