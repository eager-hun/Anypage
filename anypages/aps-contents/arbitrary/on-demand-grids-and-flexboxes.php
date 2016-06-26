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
      <div class="box">
        <div class="box__content">
          <p>Lorem ipsum.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Per inceptos hymenaeos. Donec elit libero, sodales nec, volutpat
            a, suscipit non, turpis. Aenean vulputate eleifend tellus.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Class aptent taciti sociosqu ad litora torquent per conubia
            nostra.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          Fusce neque.
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Natoque penatibus et magnis dis parturient montes, nascetur
            ridiculus mus.</p>
        </div>
      </div>
    </div>

  </div><!-- /.row -->




  <h2 class="h4">4 column on-demand grid.</h2>

  <div class="row row--wrap row--wrap--4">

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Lorem ipsum.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Per inceptos hymenaeos. Donec elit libero, sodales nec, volutpat
            a, suscipit non, turpis. Aenean vulputate eleifend tellus.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Class aptent taciti sociosqu ad litora torquent per conubia
            nostra.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          Fusce neque.
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Natoque penatibus et magnis dis parturient montes, nascetur
            ridiculus mus.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Lorem ipsum.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Per inceptos hymenaeos. Donec elit libero, sodales nec.</p>
        </div>
      </div>
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

  <div class="row row--wrap row--flexbox--wide row--wrap--4 natural-fit">

    <div class="column">
      <div class="box">
        <div class="box__content">
        <img src="<?php apputils_print_path_to_theme(); ?>static-assets/styleguide-images/photo-1-700.jpg" alt="Train wheel close-up, for image demo purpose.">
          <p>Lorem ipsum.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Per inceptos hymenaeos. Donec elit libero, sodales nec, volutpat
            a, suscipit non, turpis. Aenean vulputate eleifend tellus.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Class aptent taciti sociosqu ad litora torquent per conubia
            nostra.</p>
          <img src="<?php apputils_print_path_to_theme(); ?>static-assets/styleguide-images/photo-1-700.jpg" alt="Train wheel close-up, for image demo purpose.">
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          Fusce neque.
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Natoque penatibus et magnis dis parturient montes, nascetur
            ridiculus mus.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Lorem ipsum.</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="box">
        <div class="box__content">
          <p>Per inceptos hymenaeos. Donec elit libero, sodales nec.</p>
        </div>
      </div>
    </div>

  </div><!-- /.row -->

</div>

