
<?php

// #############################################################################
// Prepare boxes to demo color-zones.

// -----------------------------------------------------------------------------
// Raw data for boxes.

$boxes_data = [
    [
        'wrapper_extra_classes' => 'color-zone--brand',
        'box_title'             => 'Color zone "Brand"',
        'button_class'          => 'some-button-color-variant-todo',
    ],
    [
        'wrapper_extra_classes' => 'color-zone--accent-1',
        'box_title'             => 'Color zone "Accent 1"',
        'button_class'          => 'some-button-color-variant-todo',
    ],
    [
        'wrapper_extra_classes' => 'color-zone--accent-2',
        'box_title'             => 'Color zone "Accent 2"',
        'button_class'          => 'some-button-color-variant-todo',
    ],
    [
        'wrapper_extra_classes' => 'color-zone--dark',
        'box_title'             => 'Color zone "Dark"',
        'button_class'          => 'some-button-color-variant-todo',
    ],
    [
        'wrapper_extra_classes' => 'color-zone--blockfill',
        'box_title'             => 'Color zone "Blockfill"',
        'button_class'          => 'some-button-color-variant-todo',
    ],
];

// -----------------------------------------------------------------------------
// Prepare box contents.

array_walk($boxes_data, function(&$item) {
    $box_content = '<p>';
    $box_content .= $this->addFillerText('xs', 2, false);
    $box_content .= ' <a href="foobar://foo">This is an inline link within this text</a> ';
    $box_content .= $this->addFillerText('xs', 2, false);
    $box_content .= '</p>';
    $box_content .= '<p>Okay, I needed <strong>one more paragraph</strong> just to check some more stuff.</p>';

    $box_content .= <<<EOT
        <ul class="bare-list">
            <li>
                <a href="foobar://foo">This is a link</a>
            </li>
            <li>
                <a href="/">This might be a visited link</a>
            </li>
        </ul>
EOT;

    $box_content .= $this->addFillerText('xs', 2, true);

    /*
    $box_content .= '<input type="text" value="Sample textfield">';

    $button_class = $item['button_class'];

    $box_content .= <<<EOL
        <button type="button" class="button $button_class">
            Sample button
        </button>
EOL;
    */

    $item['box_content'] = $box_content;
});


// #############################################################################
// Output boxes.

// -----------------------------------------------------------------------------
// Render boxes.

$rendered_boxes = [];

foreach($boxes_data as $key => $box_data) {

    $wrapper_extra_classes = 'box--major tile color-zone'
        . ' ' . $box_data['wrapper_extra_classes'];

    $rendered_boxes[$key] = $tools->render('patterns/box', [
        'wrapper_extra_classes' => $wrapper_extra_classes,
        'box_title'             => $boxes_data[$key]['box_title'],
        'box_content'           => $boxes_data[$key]['box_content'],
    ]);
}
unset($key, $box_data);

// -----------------------------------------------------------------------------
// Prepare rendered boxes array as payload for grid template.

array_walk($rendered_boxes, function(&$value, $key) {
    $value = [ 'item_content' => $value ];
});

// -----------------------------------------------------------------------------
// Render grid.

echo $tools->render('layouts/flex-grid', [
    'wrapper_extra_classes' => 'flex-grid--preset-3-cols payload-as-tiles',
    'items' => $rendered_boxes
]);
