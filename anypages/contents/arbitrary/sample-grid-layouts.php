
<div class="appmeta__grid-demos">

  <p>These items start out as 100% wide, then as the screen grows, they go 50% wide, then 100% wide again, then 50% wide again.</p>

  <div class="row">
    <div class="column narrow-l-6 wide-12 wide-m-6">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 1']);?>

    </div>
    <div class="column narrow-l-6 wide-12 wide-m-6">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 2']);?>

    </div>
  </div>

  <p>By default, Foundation will float the last grid item to the opposite direction than the others (right). This is due to work around rounding errors in width calculations, therefore to ensure perfectly aligned column edges on the right side too.</p>
  <p>Columns also seem to be able to wrap to multi lines.</p>
  <p>If there is a remainder at the end, it goes to the wrong end.</p>

  <div class="row">
    <div class="column wide-6">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 1']);?>

    </div>
    <div class="column wide-6">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 2']);?>

    </div>
    <div class="column wide-6">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 3']);?>

    </div>
  </div>

  <p>By adding an .end class to the last column, the right-floating of that element can be prevented.</p>

  <div class="row">
    <div class="column wide-6">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 1']);?>

    </div>
    <div class="column wide-6">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 2']);?>

    </div>
    <div class="column wide-6 end">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 3']);?>

    </div>
  </div>

  <p>Testing a nested grid.</p>

  <div class="row">
    <div class="column wide-9">
      <div class="row">
        <div class="column wide-6">

          <?php echo $apsHelper->render('components/box', ['box_content' => 'Inner row, box 1']);?>

        </div>
        <div class="column wide-6">

          <?php echo $apsHelper->render('components/box', ['box_content' => 'Inner row, box 2']);?>

        </div>
      </div>
    </div>
    <div class="column wide-3">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Outer row, box 1']);?>

    </div>
  </div>

  <p>Taking nesting further.</p>
  <p>The innermost elements go sharing width only at "wide-m" media query.</p>

  <div class="row">
    <div class="column wide-9">
      <div class="row">
        <div class="column wide-6">

          <?php echo $apsHelper->render('components/box', ['box_content' => 'Inner row, box 1']);?>

        </div>
        <div class="column wide-6">
          <div class="row">
            <div class="column wide-m-6">

              <?php echo $apsHelper->render('components/box', ['box_content' => 'Innermost row, box 1']);?>

            </div>
            <div class="column wide-m-6">

              <?php echo $apsHelper->render('components/box', ['box_content' => 'Innermost row, box 2']);?>

            </div>
            <div class="column wide-m-6 end">

              <?php echo $apsHelper->render('components/box', ['box_content' => 'Innermost row, box 3']);?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="column wide-3">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Outer row, box 1']);?>

    </div>
  </div>


  <p>Item that gets centered at "wide" width, then changes width at "wide-m"</p>

  <div class="row">
    <div class="column wide-4 wide-centered wide-m-10">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 1']);?>

    </div>
  </div>

  <p>Practical(-ish) example where we position boxes progressively next to each other, as growing width allows.</p>

  <div class="row">
    <div class="column narrow-l-6 wide-m-4">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 1']);?>

    </div>
    <div class="column narrow-l-6 wide-m-4">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 2']);?>

    </div>
    <div class="column wide-m-4">

      <?php echo $apsHelper->render('components/box', ['box_content' => 'Box 3']);?>

    </div>
  </div>
</div>


