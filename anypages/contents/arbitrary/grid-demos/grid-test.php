
<div class="page__level__content grid-test">

  <h2>grid&#8209;column()</h2>

  <p>3 columns.</p>

  <div id="grid-test--3-cols-simple" class="row">
    <div class="column">
      <div class="box">Item 1</div>
    </div>
    <div class="column">
      <div class="box">Item 2</div>
    </div>
    <div class="column">
      <div class="box">Item 3</div>
    </div>
  </div>
</div>





<div class="page__level__content grid-test">

  <h2>breakpoint() + grid&#8209;column() + grid&#8209;column&#8209;end()</h2>

  <p>2 columns on mobile, then 4 columns on larger screens.</p>

  <div id="grid-test--4-cols-conditional" class="row">
    <div class="column">
      <div class="box">Item 1</div>
    </div>
    <div class="column">
      <div class="box">Item 2</div>
    </div>
    <div class="column">
      <div class="box">Item 3</div>
    </div>
    <div class="column">
      <div class="box">Item 4</div>
    </div>
    <div class="column">
      <div class="box">Item 5</div>
    </div>
  </div>
</div>





<div class="page__level__content grid-test">

  <h2>grid-layout()</h2>

  <p>2 columns on mobile, then 4 columns on larger screens.</p>

  <div id="grid-test--layout-mixin" class="row">
    <div class="column">
      <div class="box">Item 1</div>
    </div>
    <div class="column">
      <div class="box">Item 2</div>
    </div>
    <div class="column">
      <div class="box">Item 3</div>
    </div>
    <div class="column">
      <div class="box">Item 4</div>
    </div>
    <div class="column">
      <div class="box">Item 5</div>
    </div>
    <div class="column">
      <div class="box">Item 6</div>
    </div>
    <div class="column">
      <div class="box">Item 7</div>
    </div>
  </div>
</div>





<div class="page__level__content grid-test">

  <h2>grid&#8209;column&#8209;position()</h2>

  <p>Stacked one col on mobile, then as the screen grows, sidebar 1 joins from left, then later sidebar 2 joins from right.</p>

  <div id="grid-test--column-position" class="row">
    <div class="column column--main">
      <div class="box">Col main</div>
    </div>
    <div class="column column--sb--1">
      <div class="box">Col sidebar 1</div>
    </div>
    <div class="column column--sb--2">
      <div class="box">Col sidebar 2</div>
    </div>
  </div>
</div>





<div class="page__level__content grid-test">

  <h2>Nested grids</h2>

  <p>Pink and green groups are nested grids in a parent grid, that has 2 columns on large-enough screens.</p>

  <div id="grid-test--nested-grids" class="row">

    <div class="column">
      <div class="row">
        <div class="column">
          <div class="box">Item 1-1</div>
        </div>
        <div class="column">
          <div class="box">Item 1-2</div>
        </div>
        <div class="column">
          <div class="box">Item 1-3</div>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="row">
        <div class="column">
          <div class="box">Item 2-1</div>
        </div>
        <div class="column">
          <div class="box">Item 2-2</div>
        </div>
        <div class="column">
          <div class="box">Item 2-3</div>
        </div>
      </div>
    </div>

  </div>

  <div id="grid-test--nested-grids-reference" class="row">
    <div class="column">
      <div class="box">Reference</div>
    </div>
    <div class="column">
      <div class="box">Reference</div>
    </div>
    <div class="column">
      <div class="box">Reference</div>
    </div>
  </div>
</div>





<div class="page__level__content grid-test">

  <h2>Simple grid with only mixins.</h2>

  <p><strong>grid&#8209;row() + grid&#8209;column()</strong></p>

  <p>There are no grid-specific classes in this markup.</p>

  <p>All grid behavior has to be done by the mixins.</p>

  <p>3 columns.</p>

  <div id="grid-test--simple-with-only-mixins">
    <div class="group-item">
      <div class="box">Item 1</div>
    </div>
    <div class="group-item">
      <div class="box">Item 2</div>
    </div>
    <div class="group-item">
      <div class="box">Item 3</div>
    </div>
  </div>
</div>





<div class="page__level__content grid-test">

  <h2>Nested grids with only mixins</h2>

  <p><strong>
    grid&#8209;row()
    + grid&#8209;column()
    + grid&#8209;column&#8209;size()
  </strong></p>

  <p>There are no grid-specific classes in this markup.</p>

  <p>All grid behavior has to be done by the mixins.</p>

  <div id="grid-test--nested-with-only-mixins">

    <div class="group-left">
      <div class="inner-group-wrapper">
        <div class="inner-group-item">
          <div class="box">Item 1-1</div>
        </div>
        <div class="inner-group-item">
          <div class="box">Item 1-2</div>
        </div>
        <div class="inner-group-item">
          <div class="box">Item 1-3</div>
        </div>
      </div>
    </div>

    <div class="group-right">
      <div class="inner-group-wrapper">
        <div class="inner-group-item">
          <div class="box">Item 2-1</div>
        </div>
        <div class="inner-group-item">
          <div class="box">Item 2-2</div>
        </div>
        <div class="inner-group-item">
          <div class="box">Item 2-3</div>
        </div>
      </div>
    </div>

  </div>
</div>

