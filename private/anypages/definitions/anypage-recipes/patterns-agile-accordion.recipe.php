<?php

echo $tools->render('page/page-title', [
    'page_title_text' => 'Patterns: agile accordion'
]);

$aaccdn_manifest = [
    'settings' => [
        'fooSetting' => 'hoj'
    ],
    'items' => [
        [
            'title' => 'Item 1 title',
            'content' => $tools->addFillerText('s', 1, true),
            'initially_open' => true,
        ],
        [
            'title' => 'Item 2 title',
            'content' => $tools->addFillerText('s', 2, true),
        ],
        [
            'title' => 'Item 3 title',
            'content' => $tools->addFillerText('s', 3, true),
        ],
        [
            'title' => 'Item 4 title',
            'content' => $tools->addFillerText('s', 4, true),
        ],
    ]
];

echo $tools->render('patterns/collapsibles/agile-accordion', $aaccdn_manifest);
