<?php

echo $tools->render('page/page-title', [
    'page_title_text' => 'Patterns: agile accordion'
]);


$page_contents = [];


// #############################################################################
// Shared resources.

function demo_accordion_body($index) {
    return <<<EOT
        <p>Item {$index}'s content.</p>
        <p><a href="#!">Link 1</a></p>
        <p><a href="#!">Link 2</a></p>
EOT;
}


// #############################################################################
// Vue runtime-mode agile accordion(s).

$runtime_accordions_title = '<h2>Vue-runtime-mode agile accordions</h2>';

function accdn_runtime_unique_manifest($tools) {
    return [
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
}

$runtime_mode_accordion_1_rendered = $tools->render(
    'agile-accordion/twig/agile-accordion-runtime',
    accdn_runtime_unique_manifest($tools)
);
$runtime_mode_accordion_2_rendered = $tools->render(
    'agile-accordion/twig/agile-accordion-runtime',
    accdn_runtime_unique_manifest($tools)
);

$runtime_accordions_printable = <<<EOT

    {$runtime_accordions_title}

    <div class="stackable">
        {$runtime_mode_accordion_1_rendered}
    </div>    
    <div class="stackable">
        {$runtime_mode_accordion_2_rendered}
    </div>
EOT;


$page_contents[] = $runtime_accordions_printable;


// #############################################################################
// Progressively enhanceable agile accordion(s).

function accdn_pe_unique_manifest($tools) {
    return [
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
}

$pe_accordions_title = '<h2>Progressively enhance-able agile accordions</h2>';

$pe_accordion_1_rendered = $tools->render(
    'agile-accordion/twig/agile-accordion-pe',
    accdn_pe_unique_manifest($tools)
);
$pe_accordion_2_rendered = $tools->render(
    'agile-accordion/twig/agile-accordion-pe',
    accdn_pe_unique_manifest($tools)
);

$pe_accordions_printable = <<<EOT

    <div class="vue-compiler-dependent-app">

        {$pe_accordions_title}

        <div class="stackable">
            {$pe_accordion_1_rendered}
        </div>
        <div class="stackable">
            {$pe_accordion_2_rendered}
        </div>

    </div>
EOT;


$page_contents[] = $pe_accordions_printable;



// #############################################################################
// Printing page.

foreach ($page_contents as $content) {
    echo $tools->render('layouts/stackable', [
        'wrapper_extra_classes' => 'stackable--major',
        'stackable_content' => $content
    ]);
}
