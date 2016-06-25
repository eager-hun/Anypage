<?php
/**
 * Meta-template for the styleguide: A components-demo item.
 */
?>
<div class="x-cd-item">

  <?php if (!empty($title)): ?>
    <div class="x-cd-item__title">
      <?php print $title; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($description)): ?>
    <div class="x-cd-item__description">
      <?php print $description; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($content)): ?>
    <?php if (!empty($content_label)): ?>
      <span class="x-cd-item__label">
        <?php echo $content_label; ?>
      </span>
    <?php endif; ?>
    <div class="x-cd-item__content">
      <?php print $content; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($code)): ?>
    <span class="x-cd-item__label">Code:</span>
    <div class="x-cd-item__code">
      <?php print $code; ?>
    </div>
  <?php endif; ?>

</div>

