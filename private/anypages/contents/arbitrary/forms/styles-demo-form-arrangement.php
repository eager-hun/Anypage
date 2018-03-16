<div class="form-arrangement">

    <div class="widget-container width--half">
        <label class="label--as-sibling label--above">Text 1</label>
        <input
            type="text"
            class="input--oneliner"
        >
        <div class="widget-container__helptext">
            <p>Helptext for this form widget</p>
        </div>
    </div>

    <div class="widget-container width--half">
        <label class="label--as-sibling label--above">
            Text 2
        </label>
        <input
            type="text"
            class="input--oneliner"
        >
        <div class="widget-container__helptext">
            <p>Helptext for this form widget</p>
        </div>
    </div>

    <div class="widget-container width--full">
        <label class="label--as-sibling label--above">Textarea 1</label>
        <textarea></textarea>
        <div class="widget-container__helptext">
            <p>Helptext for this form widget</p>
        </div>
    </div>

    <div class="widget-container width--half">
        <label class="label--as-sibling label--above">Text 3</label>
        <input
            type="text"
            class="input--oneliner"
            value="Some long text offering us comparison opportunity"
        >
        <div class="widget-container__helptext">
            <p>Helptext for this form widget</p>
        </div>
    </div>

    <div class="widget-container with-blank-label width--half">

        <?php
            echo $tools->render('forms/button', [
                'attributes' => [
                    'type'  => 'button',
                    'class' => 'button button--primary button--oneliner'
                ],
                'value' => 'Button'
            ]);

            echo $tools->render('forms/button', [
                'tagname' => 'a',
                'attributes' => [
                    'href'    => '#!',
                    'class' => 'button button--primary button--oneliner'
                ],
                'value' => 'Link button'
            ]);
        ?>

    </div>

    <div class="widget-container width--half">
        <label class="label--as-sibling label--above">Text 4</label>
        <input
            type="text"
            class="input--oneliner"
            value="Some long text offering us comparison opportunity"
        >
        <div class="widget-container__helptext">
            <p>Helptext for this form widget</p>
        </div>
    </div>

    <div class="widget-container width--half">
        <label class="label--as-sibling label--above">Textarea 2</label>
        <textarea>Here is hoping that the texts will align.</textarea>
        <div class="widget-container__helptext">
            <p>Helptext for this form widget</p>
        </div>
    </div>

</div>
