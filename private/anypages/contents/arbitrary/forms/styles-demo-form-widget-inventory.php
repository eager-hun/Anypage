<?php

// #############################################################################
// Preparing text-ish input types' manifest.

$textish_input_types = [
    'text',
    'email',
    'password',
    'search',
    'tel',
    'url',
    'number',
    'date',
    'month',
    'week',
    'time',
    'datetime-local',
];

$textish_inputs_manifest = [];

foreach ($textish_input_types as $input_type) {
    $textish_inputs_manifest[] = [
        'label_data' => [
            'text' => ucfirst(strtolower($input_type)),
        ],
        'widget_data' => [
            'template' => 'forms/input--textish',
            'attributes' => [
                'type' => $input_type,
                'id' => 'widget-inventory__input-textish--' . $input_type,
                'class' => 'input--oneliner'
            ],
        ],
        'container_data' => [
            'helptext' => 'Help text for input type ' . $input_type
        ],
    ];
}


// #############################################################################
// Button-ish widgets.

$buttonish_widgets_manifest = [
    [
        'label_data' => [
            'text' => 'Button',
        ],
        'widget_data' => [
            'template' => 'forms/button',
            'attributes' => [
                'type' => 'button',
                'id' => 'widget-inventory__button',
                'class' => 'button button--primary',
            ],
            'value' => 'Button'
        ],
    ],
    [
        'label_data' => [
            'text' => 'Link button',
        ],
        'widget_data' => [
            'template' => 'forms/link-button',
            'attributes' => [
                'id' => 'widget-inventory__link-button',
                'class' => 'button button--primary',
                'href' => '#',
            ],
            'value' => 'Link button'
        ],
    ],
    [
        'label_data' => [
            'text' => 'Button with icon',
        ],
        'widget_data' => [
            'template' => 'forms/button',
            'attributes' => [
                'type' => 'button',
                'id' => 'widget-inventory__button_w_icon',
                'class' => 'button button--primary button--icon-prefix',
            ],
            'value' => 'Button with icon',
            'icon_href' => '#icon-sprite__checkmark',
        ],
    ],
    [
        'label_data' => [
            'text' => 'Link button with icon',
        ],
        'widget_data' => [
            'template' => 'forms/link-button',
            'attributes' => [
                'id' => 'widget-inventory__link-button_w_icon',
                'class' => 'button button--primary button--icon-prefix',
                'href' => '#',
            ],
            'value' => 'Link button with icon',
            'icon_href' => '#icon-sprite__checkmark',
        ],
    ],
];


// #############################################################################
// Misc widgets.

$misc_widgets_manifest = [
    [
        'label_data' => [
            'text' => 'Textarea',
        ],
        'widget_data' => [
            'template' => 'forms/textarea',
            'attributes' => [
                'id' => 'widget-inventory__textarea',
                'required' => 'required',
            ],
            'value' => '',
        ],
        'container_data' => [
            'helptext' => 'Help text for the textarea',
        ],
    ],
    [
        'label_data' => [
            'text' => 'Checkbox',
        ],
        'widget_data' => [
            'template' => 'forms/input--checkbox',
            'attributes' => [
                'type' => 'checkbox',
                'id' => 'widget-inventory__checkbox',
            ],
        ],
    ],
    [
        'label_data' => [
            'text' => 'Radio',
        ],
        'widget_data' => [
            'template' => 'forms/input--radio',
            'attributes' => [
                'type' => 'radio',
                'id' => 'widget-inventory__radio',
            ],
        ],
    ],
    [
        'label_data' => [
            'text' => 'Select',
        ],
        'widget_data' => [
            'template' => 'forms/select',
            'attributes' => [
                'id' => 'widget-inventory__select',
                'class' => 'input--oneliner',
                'placeholder' => '',
                'foobar' => 'foobar',
            ],
            'options' => [
                [ 'value' => 'foo' ],
                [ 'value' => 'bar' ],
                [ 'value' => 'baz' ],
            ]
        ],
    ],
    [
        'label_data' => [
            'text' => 'File',
        ],
        'widget_data' => [
            'template' => 'forms/input--file',
            'attributes' => [
                'type' => 'file',
                'id' => 'widget-inventory__file',
            ],
        ],
    ],
];


// #############################################################################
// Finalizing the all-widgets' manifest.

$all_widgets_manifest = array_merge(
    $textish_inputs_manifest,
    $misc_widgets_manifest,
    $buttonish_widgets_manifest
);


// #############################################################################
// Rendering widgets.

$rendered_widgets_inventory = '';

foreach ($all_widgets_manifest as $widget_manifest) {

    $rendered_widget = $tools->render(
        $widget_manifest['widget_data']['template'],
        $widget_manifest['widget_data']
    );

    $rendered_label = $tools->render(
        'forms/label--as-sibling',
        [
            'extra_classes' => 'label--above',
            'widget_id' => $widget_manifest['widget_data']['attributes']['id'],
            'text' => $widget_manifest['label_data']['text'],
        ]
    );

    $widget_container_data = [
        'label' => $rendered_label,
        'widget' => $rendered_widget,
    ];

    if ( ! empty($widget_manifest['container_data']['helptext'])) {
        $widget_container_data['helptext'] =
            $widget_manifest['container_data']['helptext'];
    }

    $rendered_widgets_inventory .= $tools->render(
        'forms/widget-container',
        $widget_container_data
    );
}

echo "<form action='#'>$rendered_widgets_inventory</form>";
