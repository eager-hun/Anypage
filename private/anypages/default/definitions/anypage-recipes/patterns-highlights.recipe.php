<?php

$demo_content = '';

$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Highlights and notifications'
]);


// ----------------------------------------------------------------------------
// Demo.

$demo_content .= '<h2>Hero</h2>';

$demo_content .= '<div class="hero-block">'
    . $tools->addFillerText('s', 1, true)
    . '</div>';



$demo_content .= '<h2>Highlight</h2>';

$demo_content .= '<div class="textblock-highlight">'
. $tools->addFillerText('s', 2, true)
. '</div>';



$demo_content .= '<h2>Note</h2>';

$demo_content .= $tools->render('patterns/texts/textblock-common', [
    'wrapper_extra_classes' => 'textblock-note',
    'icon_id'               => 'icon-sprite__info-i-in-filled-circle',
    'textblock_content'     => $tools->addFillerText('s', 6, true)
]);



$demo_content .= '<h2>System notifications</h2>';

$demo_content .= $tools->render('patterns/texts/textblock-common', [
    'wrapper_extra_classes' => 'notification notification--info',
    'icon_id'               => 'icon-sprite__info-i-in-filled-circle',
    'textblock_content'     => $tools->addFillerText('s', 6, true)
]);

$demo_content .= $tools->render('patterns/texts/textblock-common', [
    'wrapper_extra_classes' => 'notification notification--success',
    'icon_id'               => 'icon-sprite__checkmark-in-filled-circle',
    'textblock_content'     => $tools->addFillerText('s', 6, true)
]);

$demo_content .= $tools->render('patterns/texts/textblock-common', [
    'wrapper_extra_classes' => 'notification notification--warning',
    'icon_id'               => 'icon-sprite__exclamation-in-filled-triangle',
    'textblock_content'     => $tools->addFillerText('s', 6, true)
]);

$demo_content .= $tools->render('patterns/texts/textblock-common', [
    'wrapper_extra_classes' => 'notification notification--alert',
    'icon_id'               => 'icon-sprite__exclamation-in-filled-triangle',
    'textblock_content'     => $tools->addFillerText('s', 6, true)
]);


// ----------------------------------------------------------------------------
// Output.

$page_content = $tools->render('layouts/squeeze', [
    'squeeze_content' => $page_title . $demo_content,
]);

echo $page_content;
