<?php

$button_color_variants = [
    'primary',
    'accent-1',
    'accent-2',
    'gray',
];

$rendered_button_demo_sequence = '';

foreach ($button_color_variants as $color_variant) {

    $rendered_button_variant_collection = '';

    $template_vars_base = [
        'value' => "Button $color_variant",
        'attributes' => [
            'type' => 'button',
            'class' => "button button--$color_variant",
        ]
    ];

    // Initial button.

    $rendered_button_variant_collection .=
        $tools->render('forms/button', $template_vars_base);

    // Disabled button.

    $template_vars_updated = array_replace_recursive(
        $template_vars_base,
        [
            'value' => "Button $color_variant disabled",
            'attributes' => [
                'disabled' => 'disabled'
            ]
        ]
    );

    $rendered_button_variant_collection .=
        $tools->render('forms/button', $template_vars_updated);

    // Button as link.

    $template_vars_updated = array_replace_recursive(
        $template_vars_base,
        [
            'value' => "Link button $color_variant",
            'attributes' => [
                'href' => '#'
            ]
        ]
    );
    unset($template_vars_updated['attributes']['type']);

    $rendered_button_variant_collection .=
        $tools->render('forms/link-button', $template_vars_updated);

    $rendered_button_demo_sequence .= $tools->render('forms/widget-container', [
        'widget' => $rendered_button_variant_collection
    ]);

}
unset($color_variant);

echo $rendered_button_demo_sequence;
