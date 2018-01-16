<?php

echo $tools->render('page/page-title', [
    'page_title_text' => 'Patterns: titles'
]);


// #############################################################################
// Titles with descriptions.

// -----------------------------------------------------------------------------
// First example.

$t_1 = '<h2>A title with a description following it</h2>';
$t_1_desc = '<p>These kind of descriptions should be able to contain both paragraphs and lists.</p>';

echo $tools->render('patterns/texts/title-with-description', [
    'title' => $t_1,
    'description' => $t_1_desc
]);

echo $tools->addFillerText('m', 1, true);

// -----------------------------------------------------------------------------
// Second example.

$t_2 = '<h2>Example with a bit more description</h2>';
$t_2_desc_md = <<<EOT
Several paragraphs might end up appearing within a description of this kind.

Aiming for short, conscise extents of text lengths however might be useful here.
EOT;
$t_2_desc = $tools->markdown($t_2_desc_md);

echo $tools->render('patterns/texts/title-with-description', [
    'title' => $t_2,
    'description' => $t_2_desc
]);

echo $tools->addFillerText('m', 2, true);

// -----------------------------------------------------------------------------
// Third example.

$t_2 = '<h2>Demo title with diverse description</h2>';
$t_2_desc_md = <<<EOT
This part of the description is <strong>the paragraph</strong>.

- Keeping texts short in the list items continues to remain a useful idea.
- No pressure though because demonstrating a longer line also can prove its usefulness. 
EOT;
$t_2_desc = $tools->markdown($t_2_desc_md);

echo $tools->render('patterns/texts/title-with-description', [
    'title' => $t_2,
    'description' => $t_2_desc
]);

echo $tools->addFillerText('m', 3, true);