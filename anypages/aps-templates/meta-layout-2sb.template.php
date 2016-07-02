<div class="row layout--2sb <?php echo $wrapper_extra_classes; ?>">

  <?php if (!empty($main_content)): ?>
    <div class="column column--main">
      <?php echo $main_content; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($sidebar_1)): ?>
    <div class="column column--sidebar column--sb--1">
      <?php echo $sidebar_1; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($sidebar_2)): ?>
    <div class="column column--sidebar column--sb--2">
      <?php echo $sidebar_2; ?>
    </div>
  <?php endif; ?>

</div>

