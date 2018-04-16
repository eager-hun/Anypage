<?php

echo $tools->render('page/page-title', [
    'page_title_text' => 'Patterns: agile accordion'
]);

function demo_accordion_body($index) {
    return <<<EOT
        <p>Item {$index}</p>
        <p><a href="#!">Link 1</a></p>
        <p><a href="#!">Link 2</a></p>
EOT;
}

$accdn_manifest = [
    'settings' => [
        'tabsAt' => 820,
        'exclusiveItems' => 0, // Bool.
        'batchControls' => 1, // Bool.
    ],
    'items' => [
        [
            'id' => $tools->uniqueId('demo-accdn-item'),
            'title' => 'Item 0',
            'content' => demo_accordion_body(0),
        ],
        [
            'id' => $tools->uniqueId('demo-accdn-item'),
            'title' => 'Item 1',
            'content' => demo_accordion_body(1),
            'initially_open' => true,
        ],
        [
            'id' => $tools->uniqueId('demo-accdn-item'),
            'title' => 'Item 2',
            'content' => demo_accordion_body(2),
        ],
        [
            'id' => $tools->uniqueId('demo-accdn-item'),
            'title' => 'Item 3',
            'content' => demo_accordion_body(3),
        ],
    ],
];

echo $tools->render('patterns/collapsibles/agile-accordion', $accdn_manifest);
