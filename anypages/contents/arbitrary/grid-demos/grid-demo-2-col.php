<?php
?>

<p><code>.row.grid--2-cols.grid--wrapping</code></p>

<div class="row grid--2-cols grid--wrapping">

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('s', 3)]);?>
  </div>

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('s', 1)]);?>
  </div>

  <div class="column">
    <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('s', 4)]);?>
  </div>

</div><!-- /.row -->

