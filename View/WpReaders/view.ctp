<?php
$mysql_date_format = $wp_post['post_date']->year . "-" . $wp_post['post_date']->month . "-" . $wp_post['post_date']->day;
$wp_post_date = $this->Time->i18nFormat(strtotime($mysql_date_format));
?>
<div class="wpReaders view">
    <h2><?php echo __('Wp Post'); ?></h2>
    <dl>
        <dt><?php echo __('Posted'); ?></dt>
        <dd>
            <?php  
                //$wp_post_date = $wp_post['ImapReader']['created'];
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
                        echo $wp_post_date;
                    }
                } else {
                    echo $wp_post_date;
                }
                ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Content'); ?></dt>
        <dd>
            <?php echo $wp_post['post_content']; ?>
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
