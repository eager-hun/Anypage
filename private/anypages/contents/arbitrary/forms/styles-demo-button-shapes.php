<div class="form-arrangement">


    <div class="widget-container width--full">
        <h4>Button sizes inherited from form</h4>
    </div>


    <div class="widget-container width--full">

        <?php
            $buttons = [
                [
                    'attributes' => [
                        'type'  => 'button',
                        'class' => 'button button--primary'
                    ],
                    'value' => 'Button'
                ],
                [
                    'attributes' => [
                        'type'  => 'button',
                        'class' => 'button button--primary button--oneliner'
                    ],
                    'value' => 'Button oneliner'
                ],
                [
                    'tagname' => 'a',
                    'attributes' => [
                        'href'    => '#!',
                        'class'   => 'button button--primary'
                    ],
                    'value' => 'Link'
                ],
                [
                    'tagname' => 'a',
                    'attributes' => [
                        'href'    => '#!',
                        'class'   => 'button button--primary button--oneliner'
                    ],
                    'value' => 'Link oneliner'
                ]
            ];

            foreach ($buttons as $button_props) {
                echo $tools->render('forms/button', $button_props);
            }
            unset($buttons, $button_props);
        ?>

    </div>

    <div class="widget-container width--full">

        <?php
            $buttons = [
                [
                    'attributes' => [
                        'type'  => 'button',
                        'class' => 'button button--primary'
                    ],
                    'value' => 'Button<br>multi'
                ],
                [
                    'attributes' => [
                        'type'  => 'button',
                        'class' => 'button button--primary button--oneliner'
                    ],
                    'value' => 'Button oneliner'
                ],
                [
                    'tagname' => 'a',
                    'attributes' => [
                        'href'    => '#!',
                        'class'   => 'button button--primary'
                    ],
                    'value' => 'Link<br>multi'
                ],
                [
                    'tagname' => 'a',
                    'attributes' => [
                        'href'    => '#!',
                        'class'   => 'button button--primary button--oneliner'
                    ],
                    'value' => 'Link oneliner'
                ]
            ];

            foreach ($buttons as $button_props) {
                echo $tools->render('forms/button', $button_props);
            }
            unset($buttons, $button_props);
        ?>

    </div>

    <div class="widget-container width--half">
        <?php
            echo $tools->render('forms/button', [
                'attributes' => [
                    'type'  => 'button',
                    'class' => 'button button--primary button--fullwidth'
                ],
                'value' => 'Button fullwidth'
            ]);
        ?>
    </div>

    <div class="widget-container width--half">
        <?php
            echo $tools->render('forms/button', [
                'tagname' => 'a',
                'attributes' => [
                    'href'    => '#!',
                    'class' => 'button button--primary button--fullwidth'
                ],
                'value' => 'Link fullwidth'
            ]);
        ?>
    </div>

    <div class="widget-container width--full">

        <?php
            echo $tools->render('forms/button', [
                'attributes' => [
                    'type'  => 'button',
                    'class' => 'button button--primary button--icon-prefix'
                ],
                'value' => 'Button',
                'icon_href' => '#icon-sprite__arrow-right'
            ]);

            echo $tools->render('forms/button', [
                'tagname' => 'a',
                'attributes' => [
                    'href'  => '#!',
                    'class' => 'button button--primary button--icon-suffix'
                ],
                'value' => 'Link',
                'icon_href' => '#icon-sprite__checkmark'
            ]);

            echo $tools->render('forms/button', [
                'attributes' => [
                    'type'  => 'button',
                    'class' => 'button button--primary button--icon-prefix'
                ],
                'value' => 'Button<br>multi',
                'icon_href' => '#icon-sprite__arrow-right'
            ]);

            echo $tools->render('forms/button', [
                'tagname' => 'a',
                'attributes' => [
                    'href'  => '#!',
                    'class' => 'button button--primary button--icon-suffix'
                ],
                'value' => 'Link<br>multi',
                'icon_href' => '#icon-sprite__checkmark'
            ]);
        ?>

    </div>

    <div class="widget-container width--full">
        <h4>Button sizes overridden manually</h4>
    </div>

    <?php
        $sizes = ['small', 'default', 'big'];

        foreach ($sizes as $size) {
            echo '<div class="widget-container width--full">';

            $button_props = [
                'attributes' => [
                    'type'  => 'button',
                    'class' => 'button button--primary button--size-' . $size
                ],
                'value' => 'Button'
            ];
            echo $tools->render('forms/button', $button_props);

            $button_props = [
                'tagname' => 'a',
                'attributes' => [
                    'href'  => '#!',
                    'class' => 'button button--primary button--size-' . $size
                ],
                'value' => 'Link'
            ];
            echo $tools->render('forms/button', $button_props);

            $button_props = [
                'attributes' => [
                    'type'  => 'button',
                    'class' => 'button button--primary button--icon-prefix button--size-' . $size
                ],
                'value'     => 'Button',
                'icon_href' => '#icon-sprite__arrow-right'
            ];
            echo $tools->render('forms/button', $button_props);

            $button_props = [
                'tagname' => 'a',
                'attributes' => [
                    'href'  => '#!',
                    'class' => 'button button--primary button--icon-suffix button--size-' . $size
                ],
                'value' => 'Link',
                'icon_href' => '#icon-sprite__checkmark'
            ];
            echo $tools->render('forms/button', $button_props);

            echo '</div>';

        }
        unset($sizes, $size);
    ?>

</div>
