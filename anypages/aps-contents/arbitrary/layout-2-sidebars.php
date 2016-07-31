<?php
use \Michelf\Markdown;

$demo_box_for_main_content = $apsHelper->render('box', ['box_content' => 'Main']);
$demo_box_for_sidebar_1 = $apsHelper->render('box', ['box_content' => 'Sidebar 1']);
$demo_box_for_sidebar_2 = $apsHelper->render('box', ['box_content' => 'Sidebar 2']);

?>


<div class="grid-demos l-2sb-demo">

<?php
$text = <<<EOT
"Layout 2 sidebars" is a custom, complex component, based on on-demand grids.

It can be used to supply a variety of basic arrangements for page sections.

### Variants and states

This layout is used (best) for the primary layout of a page.
EOT;

echo Markdown::defaultTransform($text);
?>




  <!-- CONTENT IN THE MIDDLE. -->



  <h4>Variant: content in the middle</h4>
  <p><code>.layout--2sb.content-in-mid</code></p>



  <h5>Only one sidebar</h5>
  <p><code>.layout--2sb.content-in-mid.has-1-sb</code></p>



  <h6>Only sidebar 1</h6>

  <p><code>.layout--2sb.content-in-mid.has-1-sb.sb-1</code></p>

  <!--
  CLASSES EXPLAINED:
  - layout with (potentially) two sidebars;
  - main content will be in middle, sidebars come up to its sides;
  - currently only one sidebar is present;
  - the one present sidebar is sidebar 1.
  -->
  <div class="row layout--2sb content-in-mid has-1-sb sb-1">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--1">

      <?php echo $demo_box_for_sidebar_1; ?>

    </div>
  </div>



  <h6>Only sidebar 2</h6>

  <p><code>.layout--2sb.content-in-mid.has-1-sb.sb-2</code></p>

  <!--
  CLASSES EXPLAINED:
  - layout with (potentially) two sidebars;
  - main content will be in middle, sidebars come up to its sides;
  - currently only one sidebar is present;
  - the one present sidebar is sidebar 2.
  -->
  <div class="row layout--2sb content-in-mid has-1-sb sb-2">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--2">

      <?php echo $demo_box_for_sidebar_2; ?>

    </div>
  </div>



  <h5>Both sidebars</h5>

  <p><code>.layout--2sb.content-in-mid.has-2-sb</code></p>

  <!--
  CLASSES EXPLAINED:
  - layout with (potentially) two sidebars;
  - main content will be in middle, sidebars come up to its sides;
  - currently both sidebars are present.
  -->
  <div class="row layout--2sb content-in-mid has-2-sb">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--1">

      <?php echo $demo_box_for_sidebar_1; ?>

    </div>
    <div class="column column--sidebar column--sb--2">

      <?php echo $demo_box_for_sidebar_2; ?>

    </div>
  </div>




  <!-- CONTENT ON LEFT. -->




  <h4>Variant: content on the left, both sidebars on the right</h4>
  <p><code>.layout--2sb.content-on-left</code></p>



  <h5>Only one sidebar</h5>



  <h6>Only sidebar 1</h6>

  <p><code>.layout--2sb.content-on-left.has-1-sb</code></p>

  <div class="row layout--2sb content-on-left has-1-sb">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--1">

      <?php echo $demo_box_for_sidebar_1; ?>

    </div>
  </div>



  <h6>Only sidebar 2</h6>

  <p><code>.layout--2sb.content-on-left.has-1-sb</code></p>

  <div class="row layout--2sb content-on-left has-1-sb">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--2">

      <?php echo $demo_box_for_sidebar_2; ?>

    </div>
  </div>



  <h5>Both sidebars</h5>

  <p><code>.layout--2sb.content-on-left.has-2-sb</code></p>

  <div class="row layout--2sb content-on-left has-2-sb">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--1">

      <?php echo $demo_box_for_sidebar_1; ?>

    </div>
    <div class="column column--sidebar column--sb--2">

      <?php echo $demo_box_for_sidebar_2; ?>

    </div>
  </div>





  <!-- CONTENT ON RIGHT. -->




  <h4>Variant: content on the right, both sidebars on the left</h4>
  <p><code>.layout--2sb.content-on-right</code></p>



  <h5>Only one sidebar</h5>



  <h6>Only sidebar 1</h6>

  <p><code>.layout--2sb.content-on-right.has-1-sb</code></p>

  <div class="row layout--2sb content-on-right has-1-sb">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--1">

      <?php echo $demo_box_for_sidebar_1; ?>

    </div>
  </div>



  <h6>Only sidebar 2</h6>

  <p><code>.layout--2sb.content-on-right.has-1-sb</code></p>

  <div class="row layout--2sb content-on-right has-1-sb">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--2">

      <?php echo $demo_box_for_sidebar_2; ?>

    </div>
  </div>



  <h5>Both sidebars</h5>

  <p><code>.layout--2sb.content-on-right.has-2-sb</code></p>

  <!-- NOTE: the .natural-fit class here is not related to the column
  arrangements, it's for fitting this demo example better into the
  accordion. -->
  <div class="row layout--2sb content-on-right has-2-sb natural-fit">
    <div class="column column--main">

      <?php echo $demo_box_for_main_content; ?>

    </div>
    <div class="column column--sidebar column--sb--1">

      <?php echo $demo_box_for_sidebar_1; ?>

    </div>
    <div class="column column--sidebar column--sb--2">

      <?php echo $demo_box_for_sidebar_2; ?>

    </div>
  </div>




</div>

