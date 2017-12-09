<?php

$main_content = $tools->addFillerText('s', 1, true);

$box_for_sidebar = $tools->render('patterns/box', [
    'wrapper_extra_classes' => 'fill-flex color-zone color-zone--brand',
    'box_title' => 'Sidebar content',
    'box_content' => '<p>' . $tools->addFillerText('xxs', 1, false) . '.</p>'
]);

?>


<h2 class="underlined">Sidebar is present, on the right</h2>

<div class="layout-1-sidebar sidebar-on-right has-sidebar">
    <div class="layout__element layout__main">
        <?php echo $main_content; ?>
    </div>
    <div class="layout__element layout__sidebar">
        <?php echo $box_for_sidebar; ?>
    </div>
</div>


<h2 class="underlined">Sidebar is present, on the left</h2>

<div class="layout-1-sidebar sidebar-on-left has-sidebar">
    <div class="layout__element layout__main">
        <?php echo $main_content; ?>
    </div>
    <div class="layout__element layout__sidebar">
        <?php echo $box_for_sidebar; ?>
    </div>
</div>


<h2 class="underlined">Sidebar is not present</h2>

<div class="layout-1-sidebar sidebar-on-left">
    <div class="layout__element layout__main">
        <?php echo $main_content; ?>
    </div>
</div>
