
<div class="form-arrangement">

    <div class="widget-container width--half">
        <h4>Pick some fruits that you like</h4>

        <?php
        $type = 'checkbox';
        $name = 'liked_fruits';

        $multifruit_widget_defs = [
            [
                'label' => 'Grapes',
                'attributes' => [
                    'value' => 'grapes'
                ],
            ],
            [
                'label' => 'Melon',
                'attributes' => [
                    'value' => 'melon'
                ],
            ],
            [
                'label' => 'Apple',
                'attributes' => [
                    'value' => 'apple'
                ],
            ],
            [
                'label' => 'Pear',
                'attributes' => [
                    'value' => 'pear'
                ],
            ],
        ];
        foreach ($multifruit_widget_defs as $index => $widget_props) {
            $widget_props['attributes']['type'] = $type;
            $widget_props['attributes']['name'] = $name;
            $widget_props['wrapper_extra_classes'] = 'enhanced-choice--inline';

            switch($index) {
                case 1:
                    $widget_props['attributes'][] = 'checked';
            }

            echo $tools->render('forms/input--choice', $widget_props);
        }
        unset($type, $name, $widget_props);
        ?>
    </div>

    <div class="widget-container width--half">
        <h4>Pick the fruit you like most</h4>

        <?php
        $type = 'radio';
        $name = 'most_liked_fruit';

        $singlefruit_widget_defs = [
            [
                'label' => 'Grapes',
                'attributes' => [
                    'value' => 'grapes'
                ],
            ],
            [
                'label' => 'Melon',
                'attributes' => [
                    'value' => 'melon'
                ],
            ],
            [
                'label' => 'Apple',
                'attributes' => [
                    'value' => 'apple'
                ],
            ],
            [
                'label' => 'Pear',
                'attributes' => [
                    'value' => 'pear'
                ],
            ],
        ];
        foreach ($singlefruit_widget_defs as $index => $widget_props) {
            $widget_props['attributes']['type'] = $type;
            $widget_props['attributes']['name'] = $name;
            $widget_props['wrapper_extra_classes'] = 'enhanced-choice--inline';

            switch($index) {
                case 1:
                    $widget_props['attributes'][] = 'checked';
            }

            echo $tools->render('forms/input--choice', $widget_props);
        }
        unset($type, $name, $widget_props);
        ?>
    </div>

    <div class="widget-container width--half">
        <h4>Pick some fruits that you like</h4>

        <?php
        $type = 'checkbox';
        $name = 'liked_fruits_with_states';

        foreach ($multifruit_widget_defs as $index => $widget_props) {
            $widget_props['attributes']['type'] = $type;
            $widget_props['attributes']['name'] = $name;
            $widget_props['wrapper_extra_classes'] = 'enhanced-choice--inline';

            switch($index) {
                case 0:
                    $widget_props['attributes']['class'] = 'has-error';
                    break;
                case 1:
                    $widget_props['attributes']['class'] = 'has-error';
                    $widget_props['attributes'][] = 'checked';
                    break;
                case 2:
                    $widget_props['attributes'][] = 'disabled';
                    break;
                case 3:
                    $widget_props['attributes'][] = 'disabled';
                    $widget_props['attributes'][] = 'checked';
            }
            echo $tools->render('forms/input--choice', $widget_props);
        }
        unset($type, $name, $widget_props);
        ?>
    </div>

    <div class="widget-container width--half">
        <h4>Pick the fruit you like most</h4>

        <?php
        $type = 'radio';
        $name = 'most_liked_fruit_with_error';

        foreach ($singlefruit_widget_defs as $index => $widget_props) {
            $widget_props['attributes']['type'] = $type;
            $widget_props['attributes']['name'] = $name;
            $widget_props['attributes']['class'] = 'has-error';
            $widget_props['wrapper_extra_classes'] = 'enhanced-choice--inline';

            switch($index) {
                case 1:
                    $widget_props['attributes'][] = 'checked';
            }

            echo $tools->render('forms/input--choice', $widget_props);
        }
        unset($type, $name, $widget_props);
        ?>
    </div>

    <div class="widget-container width--half">
        <h4>Why were you late</h4>

        <?php
        $type = 'checkbox';
        $name = 'why_late_reasons';

        $whylate_widget_defs = [
            [
                'label' => 'I keep telling myself to go to bed by ten in the evening, but last night I did not manage to do so. So I overslept.',
                'attributes' => [
                    'value' => 'overslept'
                ],
            ],
            [
                'label' => 'You would think, 3 millimeters of snow should not be enough to get the entire public transport network disabled; but it do.',
                'attributes' => [
                    'value' => 'public_transport'
                ],
            ],
            [
                'label' => 'I had totally been thinking that I had to go to work to the other office.',
                'attributes' => [
                    'value' => 'forgot_where_to_work'
                ],
            ],
        ];
        foreach ($whylate_widget_defs as $widget_props) {
            $widget_props['attributes']['type'] = $type;
            $widget_props['attributes']['name'] = $name;
            $widget_props['wrapper_extra_classes'] = 'enhanced-choice--stacked';

            echo $tools->render('forms/input--choice', $widget_props);
        }
        unset($type, $name, $widget_props);
        ?>
    </div>

    <div class="widget-container width--half">
        <h4>Waddaya want to work on first</h4>

        <?php
        $type = 'radio';
        $name = 'work_on_first';

        $workonfirst_widget_defs = [
            [
                'label' => 'I could look into implementing these customized, fancy-looking checkboxes and radio-buttons.',
                'attributes' => [
                    'value' => 'custom_choice_inputs'
                ],
            ],
            [
                'label' => 'Having site navigation with proper UX is a must-have, so I could look first on building responsive menu structures.',
                'attributes' => [
                    'value' => 'menus'
                ],
            ],
            [
                'label' => "I know you will say I'm reinventing the wheel, but I have this half-done flex-grid system; it would be interesting to sort that out.",
                'attributes' => [
                    'value' => 'grids'
                ],
            ],
        ];
        foreach ($workonfirst_widget_defs as $widget_props) {
            $widget_props['attributes']['type'] = $type;
            $widget_props['attributes']['name'] = $name;
            $widget_props['wrapper_extra_classes'] = 'enhanced-choice--stacked';

            echo $tools->render('forms/input--choice', $widget_props);
        }
        unset($type, $name, $widget_props);
        ?>
    </div>

</div>
