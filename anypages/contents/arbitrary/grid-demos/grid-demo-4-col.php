<?php
?>
<p><code>.row.grid--4-cols.grid--wrapping</code></p>

<div class="row grid--4-cols grid--wrapping">

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('xs', 1)]);?>
  </div>

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('s', 1)]);?>
  </div>

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('xs', 2)]);?>
  </div>

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('xs', 3)]);?>
  </div>

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('s', 4)]);?>
  </div>

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('xs', 2)]);?>
  </div>

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('xs', 1)]);?>
  </div>

</div><!-- /.row -->
