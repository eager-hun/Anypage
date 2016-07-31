<?php
use \Michelf\Markdown;
?>


<div class="grid-demos">

<?php
$text = <<<EOT
These grids use the `.row` and `.column` classes, but **_nothing like_** `.narrow-l-3` or `.wide-12`.

The width (and vertical margins) for these grid items is defined in the custom `sass/layouts/_on-demand-grids.scss` stylesheet.

NOTE: you can add `.row--flexbox--wide` class in inspector to any `.row`s in this demo to flexboxify its children.
EOT;

echo Markdown::defaultTransform($text);
?>


  <h2 class="h4">3 column on-demand grid.</h2>

  <div class="row row--wrap row--wrap--3">
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 1)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('s', 1)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 2)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 3)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('s', 3)]);?>

    </div>
  </div><!-- /.row -->




  <h2 class="h4">4 column on-demand grid.</h2>

  <div class="row row--wrap row--wrap--4">
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 1)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('s', 1)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 2)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 3)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 4)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('s', 2)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 1)]);?>

    </div>
  </div><!-- /.row -->





  <h2 class="h4">Flexboxified grid.</h2>

<?php
$text = <<<EOT
Note: this is not using any Foundation flexbox-related resources, but custom code.

Note: this will only work if a modernizr build is included and is producing an .mdz-flexbox class on the :root element.
EOT;

echo Markdown::defaultTransform($text);
?>

<?php
$boxes_with_images = [];

$boxes_with_images[1] = '<img src="' . apputils_path_to_theme() . 'static-assets/styleguide-images/photo-1-700.jpg" alt="Train wheel.">'
                      . $apsHelper->add_filler_text('xs', 1);

$boxes_with_images[2] = $apsHelper->add_filler_text('xs', 2)
                      . '<img src="' . apputils_path_to_theme() . 'static-assets/styleguide-images/photo-1-700.jpg" alt="Train wheel.">';
?>

  <div class="row row--wrap row--flexbox--wide row--wrap--4 natural-fit">
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $boxes_with_images[1]]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 3)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $boxes_with_images[2]]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('s', 1)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('s', 2)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 4)]);?>

    </div>
    <div class="column">

      <?php echo $apsHelper->render('box', ['box_content' => $apsHelper->add_filler_text('xs', 2)]);?>

    </div>
  </div><!-- /.row -->

</div>

