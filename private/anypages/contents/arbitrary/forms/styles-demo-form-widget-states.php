<?php

// #############################################################################
// Preparing text-ish input types' manifest.

$widget_states = [
    'initial',
    'has-error',
    'disabled',
    'readonly',
];

$widget_contents = [
    false,
    'placeholder' => 'this is a placeholder',
    'value' => 'this is a value'
];

$template_manifest_default = [
    'label_data' => [
        'extra_classes' => 'label--above'
    ],
    'widget_data' => [
        'attributes' => [
            'type' => 'text',
            'class' => 'input--oneliner'
        ],
    ],
];

$rendered_widgets_sequence = '';

$sequence_index = 0;

foreach ($widget_states as $state) {

    foreach ($widget_contents as $context => $content) {
        $sequence_index++;

        $template_manifest_current = [
            'label_data' => [
                'text' => ucfirst(strtolower($state)),
            ],
        ];

        if (empty($content)) {
            $template_manifest_current = array_merge_recursive(
                $template_manifest_current,
                [
                    'widget_data' => [
                        'attributes' => [
                            $state => $state,
                        ]
                    ]
                ]
            );
        }
        else {
            $template_manifest_current = array_merge_recursive(
                $template_manifest_current,
                [
                    'widget_data' => [
                        'attributes' => [
                            $state => $state,
                            $context => $content,
                        ]
                    ]
                ]
            );
        }

        $prepared_widget_manifest = array_merge_recursive(
            $template_manifest_default,
            $template_manifest_current
        );

        if ($state == 'has-error') {
            $prepared_widget_manifest['widget_data']['attributes']['class'] .= ' has-error';
        }

        $widget_container_data = [
            'label' => $tools->render(
                'forms/label--as-sibling',
                $prepared_widget_manifest['label_data']
            ),
            'widget' => $tools->render(
                'forms/input--textish',
                $prepared_widget_manifest['widget_data']
            ),
            'helptext' => '<p>Helptext for this form widget</p>',
        ];

        if ($state == 'has-error') {
            $widget_container_data['wrapper_extra_classes'] = 'has-error';
            $widget_container_data['errortext'] = 'Please fix this input if you can';
        }

        $rendered_widgets_sequence .= $tools->render(
            'forms/widget-container',
            $widget_container_data
        );

    }
    unset($context, $content);
}
unset($state);


echo $rendered_widgets_sequence;
