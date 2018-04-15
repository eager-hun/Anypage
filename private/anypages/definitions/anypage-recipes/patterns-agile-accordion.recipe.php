<?php

echo $tools->render('page/page-title', [
    'page_title_text' => 'Patterns: agile accordion'
]);

$accdn_manifest = [
    'settings' => [
        'tabsAt' => 500,
        'exclusiveItems' => 0, // Bool.
    ],
    'items' => [
        [
            'title' => 'Item 0',
            'content' => $tools->markdown('Item 0')
                . $tools->addFillerText('s', 1, true),
        ],
        [
            'title' => 'Item 1',
            'content' => $tools->markdown('Item 1')
                . $tools->addFillerText('s', 2, true),
            'initially_open' => true,
        ],
        [
            'title' => 'Item 2',
            'content' => $tools->markdown('Item 2')
                . $tools->addFillerText('s', 3, true),
        ],
        [
            'title' => 'Item 3',
            'content' => $tools->markdown('Item 3')
                . $tools->addFillerText('s', 4, true),
        ],
    ],
];

echo $tools->render('patterns/collapsibles/agile-accordion', $accdn_manifest);
