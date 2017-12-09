
<p>This solution is referred to as "cheap" for these reasons:</p>

<ul>
    <li>I couldn't yet spend the amount of time on it that it would deserve</li>
    <li>it is based on flexbox with no fallback/alternative, so it works well only where flexbox works well — and under some conditions may have the same wobblyness to it as flexbox may have.</li>
    <li>some advanced features, like column offsetting, may require some "creative thinking"</li>
    <li>it is doing a horrendous job with media queries in the generated CSS</li>
</ul>

<h2 class="underlined">Preset, responsive grid layouts, using SASS mixins</h2>



<h3>3-column grid</h3>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--preset-3-cols">
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

</div>



<h3>4-column grid</h3>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--preset-4-cols">
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

</div>



<h3>Nesting grids</h3>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--preset-3-cols">
        <div class="cheap-grid__item">
            <div class="box fill-flex">Top level</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Top level</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Top level</div>
        </div>
        <div class="cheap-grid__item">

            <div class="cheap-grid cheap-grid--fixed">
                <div class="cheap-grid__item half">
                    <div class="box fill-flex color-zone color-zone--brand">Nested 1 deep</div>
                </div>
                <div class="cheap-grid__item half">
                    <div class="box fill-flex color-zone color-zone--brand">Nested 1 deep</div>
                </div>
            </div>

        </div>
        <div class="cheap-grid__item">

            <div class="cheap-grid cheap-grid--fixed">
                <div class="cheap-grid__item third">
                    <div class="box fill-flex color-zone color-zone--accent-1">Nested 1 deep</div>
                </div>
                <div class="cheap-grid__item two-thirds">

                    <div class="cheap-grid cheap-grid--fixed">
                        <div class="cheap-grid__item half">
                            <div class="box fill-flex color-zone color-zone--accent-2">Nested 2 deep</div>
                        </div>
                        <div class="cheap-grid__item half">
                            <div class="box fill-flex color-zone color-zone--accent-2">Nested 2 deep</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>



<h3>Collapsed grid</h3>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--preset-3-cols grid-collapsing">
        <div class="cheap-grid__item">
            <div class="box fill-flex color-zone color-zone--brand">
                Grid item
            </div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex color-zone color-zone--accent-1">
                Grid item
            </div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex color-zone color-zone--accent-2">
                Grid item
            </div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex color-zone color-zone--dark">
                Grid item
            </div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex color-zone color-zone--blockfill">
                Grid item
            </div>
        </div>
    </div>

</div>



<?php
$img_src = $tools->pathToThemeStaticFiles() . '/images/for-demo/photo-1-700.jpg';
$img = "<img src='$img_src' alt='Train wheel'>";

$box_with_image = $tools->render('patterns/box', [
    'wrapper_extra_classes' => 'fill-flex',
    'box_content' => $img . '<p><code>&lt;img&gt;</code> inside a "box" in a grid-item:</p>'
]);
?>

<h3>Images in grid items</h3>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--preset-4-cols">
        <div class="cheap-grid__item">
            <img src="<?php echo $img_src; ?>" alt="Train wheel">
            <p><code>&lt;img&gt;</code> as direct child of a grid-item</p>
        </div>
        <div class="cheap-grid__item">
            <?php echo $box_with_image; ?>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

</div>



<h3>Column offsetting (experimental)</h3>

<p>This is an experimental illustration of column offsetting that was achieved
by applying margins using the <code>grid-column-width()</code> SASS
function.</p>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--fixed column-offset-poc">
        <div class="cheap-grid__item">
            <div class="box fill-flex">Reference</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Reference</div>
        </div>
    </div>

    <div class="cheap-grid cheap-grid--fixed column-offset-poc">
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item offset-1-of-12-cols">
            <div class="box fill-flex">Offset by 1/12</div>
        </div>
    </div>

    <div class="cheap-grid cheap-grid--fixed column-offset-poc">
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item offset-2-of-12-cols">
            <div class="box fill-flex">Offset by 2/12</div>
        </div>
    </div>

    <div class="cheap-grid cheap-grid--fixed column-offset-poc">
        <div class="cheap-grid__item">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item offset-3-of-12-cols">
            <div class="box fill-flex">Offset by 3/12</div>
        </div>
    </div>

    <div class="cheap-grid cheap-grid--fixed column-offset-poc">
        <div class="cheap-grid__item">
            <div class="box fill-flex">Reference</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Reference</div>
        </div>
        <div class="cheap-grid__item">
            <div class="box fill-flex">Reference</div>
        </div>
    </div>

</div>



<h2 class="underlined">Fixed grids: "steering" grid items with classes on them</h2>

<p><strong>NOTE:</strong> this is a limited-use option, as it has several shortcomings:</p>

<ul>
    <li>
        <strong>the extensive array of pre-generated classes that would enable
            fine-grain control, are purposefully not provided</strong>

        <ul>
            <li>
                as a result, media-query support is also non-existent; these
                grid arrangements don't adapt to screen width, so on mobile they
                will likely be badly crammed
            </li>
        </ul>
    </li>
    <li>
        no solution is offered for the desirable vertical gaps between rows of items, when the grid wraps
    </li>
</ul>

<p>
    <strong>Building layouts by using the provided grid-related SASS mixins and
    functions is encouraged instead.</strong>
</p>


<h3>Simple examples</h3>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--fixed">
        <div class="cheap-grid__item third">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item third">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

    <div class="cheap-grid cheap-grid--fixed">
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

    <div class="cheap-grid cheap-grid--fixed">
        <div class="cheap-grid__item three-quarters">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

</div>



<h3>Fixed grids may not play nice with wrapping</h3>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--fixed">
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item half">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item three-quarters">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

</div>



<h3>Can be collapsed</h3>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--fixed grid-collapsing">
        <div class="cheap-grid__item half">
            <div class="box fill-flex color-zone color-zone--brand">
                Grid item
            </div>
        </div>
        <div class="cheap-grid__item half">
            <div class="box fill-flex color-zone color-zone--accent-1">
                Grid item
            </div>
        </div>
    </div>

</div>



