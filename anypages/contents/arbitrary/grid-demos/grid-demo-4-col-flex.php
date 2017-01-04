<?php
use \Michelf\Markdown;

$text = <<<EOT
Note: this is not using any Foundation flexbox-related resources, but custom code.

Note: this will work only if a modernizr build is included and is producing an `.mdz-flexbox` class on some parent element.

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
