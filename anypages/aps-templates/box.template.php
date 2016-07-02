<div class="box <?php echo $wrapper_extra_classes; ?>">

  <?php if (!empty($box_title)): ?>
    <div class="box__title">
      <?php echo $box_title; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($box_content)): ?>
    <div class="box__content">
      <?php echo $box_content; ?>
    </div>
  <?php endif; ?>

</div>

