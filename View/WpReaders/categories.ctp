<div class="wpReaders index">
    <h2><?php echo __('Wp Categories'); ?></h2>
    <div><li><?php echo $this->Html->link(__('New Category'), array('action' => 'category_add')); ?></li></div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Slug</th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($wp_categories as $wp_categories): ?>
            <tr>
                <td><?php echo $wp_categories['term_id']; ?>&nbsp;</td>
                <td><?php echo $wp_categories['name']; ?>&nbsp;</td>
                <td><?php echo $wp_categories['description']; ?>&nbsp;</td>
                <td><?php echo $wp_categories['slug']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'category_view', $wp_categories['term_id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'category_edit', $wp_categories['term_id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'category_delete', $wp_categories['term_id']), null, __('Are you sure you want to delete # %s?', $wp_categories['term_id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="paging">

    </div>
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
