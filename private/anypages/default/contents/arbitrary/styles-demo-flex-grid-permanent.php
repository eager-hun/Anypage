
<p>Permanent grids are non-responsive grids where "steering" grid items is
possible by adding HTML classes on them.</p>

<p>This is a limited approach for the following reasons:</p>

<dl>
    <dt>Not responsive</dt>
    <dd>
        The large number of pre-generated HTML classes that would be necessary
        to enable both fine-grain control over item widths and
        screen-size-dependent item layout updates <strong>are purposefully not
        provided.</strong>
    </dd>
    <dt>Row-wrapping is not solved</dt>
    <dd>
        No solution is offered for the desirable vertical gaps between rows of
        items, if grid items wrap.
    </dd>
</dl>

<p>
    <strong>For creating fine-tuned responsive grids, the encouraged approach is
    using the provided grid-related SASS mixins.</strong>
</p>




<h2>Simple examples</h2>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--permanent">
        <div class="flex-grid__item half">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item half">
            <div class="box tile">Grid item</div>
        </div>
    </div>

    <div class="flex-grid flex-grid--permanent">
        <div class="flex-grid__item third">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item third">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item third">
            <div class="box tile">Grid item</div>
        </div>
    </div>

    <div class="flex-grid flex-grid--permanent">
        <div class="flex-grid__item quarter">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item quarter">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item quarter">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item quarter">
            <div class="box tile">Grid item</div>
        </div>
    </div>

    <div class="flex-grid flex-grid--permanent">
        <div class="flex-grid__item three-quarters">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item quarter">
            <div class="box tile">Grid item</div>
        </div>
    </div>

</div>


<h3>Items don't expand to fill available room</h3>

<div class="styles-demo-grid-palette">
    <div class="flex-grid flex-grid--permanent">
        <div class="flex-grid__item third">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item third">
            <div class="box tile">Grid item</div>
        </div>
    </div>
</div>


<h3>Can be collapsed</h3>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--permanent grid-collapsing">
        <div class="flex-grid__item half">
            <div class="box tile color-zone color-zone--brand">
                Grid item
            </div>
        </div>
        <div class="flex-grid__item half">
            <div class="box tile color-zone color-zone--accent-1">
                Grid item
            </div>
        </div>
    </div>

</div>




<h2>Column offsetting (experimental)</h2>

<p>This column offsetting experiment is applying margin values — determined with
the <code>grid-column-width()</code> SASS function.</p>

<div class="styles-demo-grid-palette">

    <div class="flex-grid flex-grid--permanent column-offset-poc">
        <div class="flex-grid__item">
            <div class="box tile">Reference</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Reference</div>
        </div>
    </div>

    <div class="flex-grid flex-grid--permanent column-offset-poc">
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item offset-1-of-12-cols">
            <div class="box tile">Offset by 1/12</div>
        </div>
    </div>

    <div class="flex-grid flex-grid--permanent column-offset-poc">
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item offset-2-of-12-cols">
            <div class="box tile">Offset by 2/12</div>
        </div>
    </div>

    <div class="flex-grid flex-grid--permanent column-offset-poc">
        <div class="flex-grid__item">
            <div class="box tile">Grid item</div>
        </div>
        <div class="flex-grid__item offset-3-of-12-cols">
            <div class="box tile">Offset by 3/12</div>
        </div>
    </div>

    <div class="flex-grid flex-grid--permanent column-offset-poc">
        <div class="flex-grid__item">
            <div class="box tile">Reference</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Reference</div>
        </div>
        <div class="flex-grid__item">
            <div class="box tile">Reference</div>
        </div>
    </div>

</div>
