<?php

$page_content = '';

$page_content .= $tools->render('page/page-title', [
    'page_title_text' => 'Project goals and priorities'
]);

$page_content .= $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/metapages/goals-and-priorities.md',
    'md'
);

echo $page_content;
