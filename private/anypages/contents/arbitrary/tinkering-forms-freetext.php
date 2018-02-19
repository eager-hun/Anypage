<form action="#">

    <div class="flex-grid flex-grid--preset-2-cols">
      <div class="flex-grid__item">

        <div class="widget-container">
          <label class="label--as-sibling label--above" for="form-tinkering-1__text-1">
            Text 1
          </label>
          <input
              id="form-tinkering-1__text-1"
              type="text"
              class="input--oneliner"
              value="Some long text offering us comparison opportunity"
          >
        </div>

      </div>
      <div class="flex-grid__item">

        <div class="widget-container">
          <label
              class="label--as-sibling label--above"
              for="form-tinkering-1__textarea-1"
          >
              Textarea 1
          </label>
          <textarea
              id="form-tinkering-1__textarea-1"
          >Here is hoping that the texts will align.</textarea>
        </div>

      </div>
      <div class="flex-grid__item">

        <div class="widget-container">
          <label class="label--as-parent">
            Textarea 2
            <textarea
                class="has-error"
            ></textarea>
          </label>
        </div>

      </div>
      <div class="flex-grid__item">

      </div>
      <div class="flex-grid__item">

        <input
          id="form-tinkering-1__text-2"
          type="text"
          class="input--oneliner"
          value="Foobar some glyphs with descender"
        >

      </div>

      <div class="flex-grid__item">

        <button type="button" class="button button--oneliner">
            <span class="button__text">
                Button
            </span>
        </button>

        <a class="button button--oneliner">
            <span class="button__text">
                Button as link
            </span>
        </a>

      </div>
    </div>

    <fieldset>
        <legend>Fieldset legend</legend>

        <div class="widget-container">
          <label
              class="label--as-sibling label--above"
              for="form-tinkering-2__text-2"
          >
              Text 2
          </label>
          <input
              id="form-tinkering-2__text-2"
              type="text"
              class="input--oneliner"
          >
        </div>

      <div class="widget-container">
          <label
            class="label--as-sibling label--above"
            for="form-tinkering-3__text-3"
          >
            Text 3
          </label>
          <input
            id="form-tinkering-3__text-3"
            type="text"
            class="input--oneliner"
            disabled
          >
      </div>

    </fieldset>
</form>
