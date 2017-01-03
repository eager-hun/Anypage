<?php
use \Michelf\Markdown;
?>


<div class="app-infra__grid-demos">

<?php
$text = <<<EOT
These grids use the `.row` and `.column` classes, but **_nothing like_** `.medium-4` or `.large-3`.

The widths (essentially, the column count), and the vertical margins for these grid items are defined in the custom `scss/layouts/_predefined-grid-layouts.scss` stylesheet.
EOT;

echo Markdown::defaultTransform($text);
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





  <h3>A flexboxified grid.</h3>

<?php
$text = <<<EOT
Note: this is not using any Foundation flexbox-related resources, but custom code.

Note: this will only work if a modernizr build is included and is producing an `.mdz-flexbox` class on some parent element.

Note: you can add `.grid--flexboxify` class in inspector to any `.row`s in this demo to flexboxify their children.<br>(Also note that this was done here only for the sake of the demo; adding this many modifiers to loosely defined generic grids might turn out to be expensive. In other words, feel free to thin down the corresponding stylesheet, thus use these features sparingly, when possible.)

`.row.grid--4-cols.grid--wrapping.grid--flexboxify`
EOT;

echo Markdown::defaultTransform($text);
?>


<?php
$boxes_with_images = [];

$boxes_with_images[1] = '<img src="' . apputils_path_to_theme() . 'static-assets/images/for-demo/photo-1-700.jpg" alt="Train wheel.">'
                      . $apsHelper->add_filler_text('xs', 1);

$boxes_with_images[2] = $apsHelper->add_filler_text('s', 2)
                      . '<img src="' . apputils_path_to_theme() . 'static-assets/images/for-demo/photo-1-700.jpg" alt="Train wheel.">';
?>

  <div class="row grid--4-cols grid--wrapping grid--flexboxify">

    <div class="column">
      <?php echo $apsHelper->render('components/box', ['box_content' => $boxes_with_images[1]]);?>
    </div>

    <div class="column">
      <?php echo $apsHelper->render('components/box', ['box_content' => $boxes_with_images[2]]);?>
    </div>

    <div class="column">
      <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('xs', 3)]);?>
    </div>

    <div class="column">
      <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('s', 1)]);?>
    </div>

    <div class="column">
      <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('s', 2)]);?>
    </div>

    <div class="column">
      <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('xs', 4)]);?>
    </div>

    <div class="column">
      <?php echo $apsHelper->render('components/box', ['box_content' => $apsHelper->add_filler_text('xs', 2)]);?>
    </div>

  </div><!-- /.row -->





</div>

