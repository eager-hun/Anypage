
<?php

// #############################################################################
// Prepare boxes to demo color-zones.

// -----------------------------------------------------------------------------
// Raw data for boxes.

$boxes_data = [
    [
        'wrapper_extra_classes' => 'color-zone--brand',
        'box_title'             => 'Color zone "Brand"',
        'button_color_class'    => 'button--gray',
    ],
    [
        'wrapper_extra_classes' => 'color-zone--accent-1',
        'box_title'             => 'Color zone "Accent 1"',
        'button_color_class'    => 'button--gray',
    ],
    [
        'wrapper_extra_classes' => 'color-zone--accent-2',
        'box_title'             => 'Color zone "Accent 2"',
        'button_color_class'    => 'button--gray',
    ],
    [
        'wrapper_extra_classes' => 'color-zone--dark',
        'box_title'             => 'Color zone "Dark"',
        'button_color_class'    => 'button--accent-2',
    ],
    [
        'wrapper_extra_classes' => 'color-zone--blockfill',
        'box_title'             => 'Color zone "Blockfill"',
        'button_color_class'    => 'button--primary',
    ],
];

// -----------------------------------------------------------------------------
// Prepare box contents.

array_walk($boxes_data, function(&$item) {
    $box_content = <<<EOT
<p>
    Vulputate interdum tellus nec nisl curabitur <a href="foobar://foo">This is
    an inline link within this text</a>. Non mi varius donec mauris, est posuere
    quisque, <strong>tortor duis</strong> mauris imperdiet suscipit neque
    ornare.
</p>
EOT;

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

    $button_color_class = $item['button_color_class'];
    
    // For whatever reason, in this anonymous function, the "tools" object is
    // referred to as $this.
    $button_1 = $this->render('forms/button', [
        'value' => 'Button',
        'attributes' => [
            'type' => 'button',
            'class' => 'button button--size-big button--icon-prefix ' . $button_color_class
        ],
        'icon_href' => '#icon-sprite__checkmark'
    ]);

    $button_2 = $this->render('forms/button', [
        'tagname' => 'a',
        'value' => 'Link',
        'attributes' => [
            'href'  => '#!',
            'class' => 'button button--size-small button--icon-suffix ' . $button_color_class
        ],
        'icon_href' => '#icon-sprite__checkmark'
    ]);

    $box_content .= <<<EOT
<div class="stackable--grid-match">
    $button_1
</div>
<div class="stackable--grid-match">
    $button_2
</div>
EOT;

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