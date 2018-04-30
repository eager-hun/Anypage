
<p>
    You will note that in these responsive presets, grid items do fill up all
    the available width. This, on the last row of items, can result in column
    numbers that differ from the definition.
</p>

<p>
    An option to control this behavior is not yet implemented.
</p>


<h3>2-column grid</h3>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--preset-2-cols">
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
    </div>

</div>




<h3>3-column grid</h3>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--preset-3-cols">
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
    </div>

</div>



<h3>4-column grid</h3>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--preset-4-cols">
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
    </div>

</div>



<h3>Nesting grids</h3>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--preset-3-cols payload-as-tiles">
        <div class="flex-grid__item">
            <div class="box tile">Top level</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Top level</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Top level</div>
        </div>
        <div class="flex-grid__item">

            <div class="flex-grid flex-grid--permanent payload-as-tiles">
                <div class="flex-grid__item half">
                    <div class="box tile color-zone color-zone--brand">Nested 1 deep</div>
                </div>
                <div class="flex-grid__item half">
                    <div class="box tile color-zone color-zone--brand">Nested 1 deep</div>
                </div>
            </div>

        </div>
        <div class="flex-grid__item">

            <div class="flex-grid flex-grid--permanent payload-as-tiles">
                <div class="flex-grid__item third">
                    <div class="box tile color-zone color-zone--accent-1">Nested 1 deep</div>
                </div>
                <div class="flex-grid__item two-thirds">

                    <div class="flex-grid flex-grid--permanent payload-as-tiles">
                        <div class="flex-grid__item half">
                            <div class="box tile color-zone color-zone--accent-2">Nested 2 deep</div>
                        </div>
                        <div class="flex-grid__item half">
                            <div class="box tile color-zone color-zone--accent-2">Nested 2 deep</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>



<h3>Collapsed grid</h3>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--preset-3-cols grid-collapsing">
        <div class="flex-grid__item">
            <div class="box tile color-zone color-zone--brand">
                Grid item
            </div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile color-zone color-zone--accent-1">
                Grid item
            </div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile color-zone color-zone--accent-2">
                Grid item
            </div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile color-zone color-zone--dark">
                Grid item
            </div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile color-zone color-zone--blockfill">
                Grid item
            </div>
        </div>
    </div>

</div>



<?php
$img_src = $tools->pathToThemeStaticFiles() . '/images/for-demo/photo-1-700.jpg';
$img = "<img src='$img_src' alt='Train wheel'>";

$box_with_image = $tools->render('patterns/box', [
    'wrapper_extra_classes' => 'tile',
    'box_content' => $img . '<p><code>&lt;img&gt;</code> inside a "box" in a grid-item</p>'
]);
?>

<h3>Images in grid items</h3>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--preset-4-cols payload-as-tiles">
        <div class="flex-grid__item">
            <img src="<?php echo $img_src; ?>" alt="Train wheel">
            <p><code>&lt;img&gt;</code> as direct child of a grid-item</p>
        </div>
        <div class="flex-grid__item">
            <?php echo $box_with_image; ?>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
    </div>

</div>
