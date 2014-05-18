<div class="wpReaders index">
    <h2><?php echo __('Wp Comments'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Post</th>
            <th>Comment</th>
            <th>Created</th>
            <th>Status</th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($wp_comments as $wp_comment): ?>
            <tr>
                <td><?php echo $wp_comment['comment_id']; ?>&nbsp;</td>
                <td><?php echo $wp_comment['author']; ?>&nbsp;</td>
                <td><?php echo $wp_comment['post_title']; ?>&nbsp;</td>
                <td><?php echo $wp_comment['content']; ?>&nbsp;</td>
                <td>
                    <?php
                    $mysql_date_format = $wp_comment['date_created_gmt']->year . "-" . $wp_comment['date_created_gmt']->month . "-" . $wp_comment['date_created_gmt']->day;
                    $wp_comment_date = $this->Time->i18nFormat(strtotime($mysql_date_format));

                    if ($this->Time->isThisYear($mysql_date_format)) {
                        //more conditions
                        if ($this->Time->isThisWeek($mysql_date_format)) {
                            if ($this->Time->wasYesterday($mysql_date_format)) {
                                echo __('Yesterday');
                            } else {
                                //echo date('D, h:i a', strtotime($mysql_date_format));
                                if ($this->Time->isToday($mysql_date_format)) {
                                    echo $this->Time->i18nFormat(strtotime($mysql_date_format), '%X');
                                } else {
                                    echo date('I', strtotime($mysql_date_format));
                                }
                            }
                        } else {
                            //echo date('M j', strtotime($mysql_date_format));
                            echo $wp_comment_date;
                        }
                    } else {
                        echo $wp_comment_date;
                    }
                    ?>
                    &nbsp;</td>
                <td><?php echo $wp_comment['status']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('reply'), array('action' => 'reply', $wp_comment['comment_id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $wp_comment['comment_id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $wp_comment['comment_id']), null, __('Are you sure you want to delete # %s?', $wp_comment['comment_id'])); ?>
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
