<!DOCTYPE html>
<html class="<?php print $classes; ?>" lang="<?php print $lang; ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php print $head_title; ?></title>
    <meta name="description" content="<?php print $head_desc; ?>">

    <!-- That's an empty favicon, prevents 404s. -->
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">

    <?php print $styles; ?>
    <?php print $head_scripts; ?>
  </head>
  <body>
    <?php print $page_content; ?>
    <?php print $body_scripts; ?>
  </body>
</html>

