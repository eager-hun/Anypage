<?php

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Highlights and notifications'
]);

// ----------------------------------------------------------------------------
// Demo.

$demo_content = '<h2>Hero</h2>';

$demo_content .= '<div class="hero-block">'
    . $tools->addFillerText('s', 1, true)
    . '</div>';

$demo_content .= '<h2>Highlight</h2>';

$demo_content .= '<div class="common-text-block highlight-block">'
. $tools->addFillerText('s', 2, true)
. '</div>';

$demo_content .= '<h2>Note</h2>';

$demo_content .= $tools->render('patterns/texts/note-block', [
    'note' => $tools->addFillerText('s', 3, true)
]);


// ----------------------------------------------------------------------------
// Output.

$page_content = $tools->render('layouts/page-level', [
    'page_level_content' => $tools->render('layouts/squeeze', [
        'squeeze_content' => $page_title . $demo_content,
    ]),
]);

echo $page_content;
