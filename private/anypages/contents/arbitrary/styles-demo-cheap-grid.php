
<p>The "cheap grid" solution is called cheap for these reasons:</p>

<ul>
    <li>it is based on flexbox with no fallback/alternative, so it works well only where flexbox works well</li>
    <li>apparently it does not "think" in grid-column-counts; it rather "thinks" in just widths</li>
    <li>
        it lacks such features that people might have grown to expect from good grid solutions, for example:

        <ul>
            <li>column offsetting</li>
        </ul>
    </li>
    <li>it is doing a horrendous job with media queries in the generated CSS</li>
</ul>

<h2>Preset, responsive grids, using mixins</h2>

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



<h2>Fixed grids using the option to "steer" grid items with classes on them.</h2>

<p>NOTE: this is a limited-use option, as it has several shortcomings:</p>

<ul>
    <li>
        due to media-query support not being implemented, these grid-items don't
        adapt to screen-width-change, so on mobile they will likely be badly
        crammed
    </li>
    <li>
        when the grid wraps, there is no solution offered to keep a vertical gap
        between the wrapped items
    </li>
</ul>

<p>A better option can be using mixin-based preset grid layouts, whereever
suitable.</p>

<div class="styles-demo-grid-palette">

    <div class="cheap-grid cheap-grid--fixed">
        <div class="cheap-grid__item third">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item third">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

    <hr>

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

    <hr>

    <div class="cheap-grid cheap-grid--fixed">
        <div class="cheap-grid__item three-quarters">
            <div class="box fill-flex">Grid item</div>
        </div>
        <div class="cheap-grid__item quarter">
            <div class="box fill-flex">Grid item</div>
        </div>
    </div>

    <hr>

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
