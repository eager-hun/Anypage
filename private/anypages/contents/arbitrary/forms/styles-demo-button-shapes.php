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
                    'value' => 'Link button'
                ],
                [
                    'tagname' => 'a',
                    'attributes' => [
                        'href'    => '#!',
                        'class'   => 'button button--primary button--oneliner'
                    ],
                    'value' => 'Link button oneliner'
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
                    'value' => 'Link button<br>multi'
                ],
                [
                    'tagname' => 'a',
                    'attributes' => [
                        'href'    => '#!',
                        'class'   => 'button button--primary button--oneliner'
                    ],
                    'value' => 'Link button oneliner'
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
                'value' => 'Wide'
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
                'value' => 'Link wide'
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
        ?>

    </div>

    <div class="widget-container width--full">
        <h4>Button sizes overridden manually</h4>
    </div>


    <div class="widget-container width--full">

        <?php
            $sizes = ['small', 'default', 'big'];

            foreach ($sizes as $size) {
                $button_props = [
                    'attributes' => [
                        'type'  => 'button',
                        'class' => 'button button--primary button--size-' . $size
                    ],
                    'value' => ucfirst($size)
                ];
                echo $tools->render('forms/button', $button_props);

                $button_props = [
                    'tagname' => 'a',
                    'attributes' => [
                        'href'  => '#!',
                        'class' => 'button button--primary button--size-' . $size
                    ],
                    'value' => 'Link ' . ucfirst($size)
                ];
                echo $tools->render('forms/button', $button_props);
            }
            unset($sizes, $size);
        ?>

    </div>

    <div class="widget-container width--full">

        <?php
            $sizes = ['small', 'default', 'big'];

            foreach ($sizes as $size) {
                $button_props = [
                    'attributes' => [
                        'type'  => 'button',
                        'class' => 'button button--primary button--icon-prefix button--size-' . $size
                    ],
                    'value'     => ucfirst($size),
                    'icon_href' => '#icon-sprite__arrow-right'
                ];
                echo $tools->render('forms/button', $button_props);

                $button_props = [
                    'tagname' => 'a',
                    'attributes' => [
                        'href'  => '#!',
                        'class' => 'button button--primary button--icon-suffix button--size-' . $size
                    ],
                    'value' => 'Link ' . $size,
                    'icon_href' => '#icon-sprite__checkmark'
                ];
                echo $tools->render('forms/button', $button_props);
            }
            unset($sizes, $size);
        ?>

    </div>

</div>
