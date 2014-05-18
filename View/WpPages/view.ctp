<?php
$mysql_date_format = $wp_page['dateCreated']->year . "-" . $wp_page['dateCreated']->month . "-" . $wp_page['dateCreated']->day;
$wp_page_date = $this->Time->i18nFormat(strtotime($mysql_date_format));
?>
<div class="wpReaders view">
    <h2><?php echo __('Wp Page'); ?></h2>
    <dl>
        <dt><?php echo __('Posted'); ?></dt>
        <dd>
            <?php  
                //$wp_page_date = $wp_page['ImapReader']['created'];
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
            &nbsp;
        </dd>
        <dt><?php echo __('Title'); ?></dt>
        <dd>
            <?php echo $wp_page['title']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Content'); ?></dt>
        <dd>
            <?php echo $wp_page['description']; ?>
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
