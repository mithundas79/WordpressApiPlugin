<div class="wpReaders index">
    <h2><?php echo __('Wp Pages'); ?></h2>
    <div><li><?php echo $this->Html->link(__('New Page'), array('action' => 'add')); ?></li></div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Created</th>
            <th>Modified</th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($wp_pages as $wp_page): ?>
            <tr>
                <td><?php echo $wp_page['post_id']; ?>&nbsp;</td>
                <td><?php echo $wp_page['post_title']; ?>&nbsp;</td>
                <td>
                    <?php
                    $mysql_date_format = $wp_page['post_date']->year . "-" . $wp_page['post_date']->month . "-" . $wp_page['post_date']->day;
                    $wp_page_date = $this->Time->i18nFormat(strtotime($mysql_date_format));

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
                            echo $wp_page_date;
                        }
                    } else {
                        echo $wp_page_date;
                    }
                    ?>
                    &nbsp;</td>
                <td>
                    <?php
                    $mysql_date_format = $wp_page['post_modified']->year . "-" . $wp_page['post_modified']->month . "-" . $wp_page['post_modified']->day;
                    $wp_page_date = $this->Time->i18nFormat(strtotime($mysql_date_format));

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
                            echo $wp_page_date;
                        }
                    } else {
                        echo $wp_page_date;
                    }
                    ?>
                    &nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $wp_page['post_id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $wp_page['post_id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $wp_page['post_id']), null, __('Are you sure you want to delete # %s?', $wp_page['post_id'])); ?>
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
