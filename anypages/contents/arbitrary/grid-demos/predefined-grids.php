<?php
use \Michelf\Markdown;
?>







  <h3>2 column predefined grid.</h3>

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





  <h3>3 column predefined grid.</h3>

  <p><code>.row.grid--3-cols.grid--wrapping</code></p>

  <div class="row grid--3-cols grid--wrapping">

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
      <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('s', 3)]);?>
    </div>

  </div><!-- /.row -->





  <h3>4 column predefined grid.</h3>

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





