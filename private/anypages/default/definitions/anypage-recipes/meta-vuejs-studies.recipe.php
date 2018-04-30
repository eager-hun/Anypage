<?php

echo $tools->render('page/page-title', [
    'page_title_text' => 'Meta: Vue.js studies'
]);

$page_contents = [];


// #############################################################################
// Study 1.

// -----------------------------------------------------------------------------
// Runtime-mode

$study_1_runtime_title = '<h2>Study 1 runtime-mode</h2>';

$example_vue_app_1_runtime_mode = <<<EOT
    <div
      id="example-vue-app-1"
      data-component-title="Example Vue Component 1 mounted as Vue App"
      data-payload="&lt;strong&gt;HTML string payload&lt;/strong&gt;"
      data-show-payload="true"
      data-pass-through="What &lt;strong&gt;a nice day&lt;/strong&gt; it is today!"
    >
        Example-vue-app-1, runtime-mode, not being mounted.
    </div>
EOT;

$page_contents[] = $study_1_runtime_title . $example_vue_app_1_runtime_mode;

// -----------------------------------------------------------------------------
// Compiler-dependent-mode.

$study_1_compiler_dep_title = '<h2>Study 1 compiler-dependent-mode</h2>';

$example_vue_app_1_compiler_dep_mode = <<<EOT
    <div class="vue-compiler-dependent-app">
        <example-component-1
            component-title="Example Vue Component 1 mounted as component"
            payload="&lt;strong&gt;HTML string payload&lt;/strong&gt;"
            :show-payload="true"
            pass-through="What &lt;strong&gt;a nice day&lt;/strong&gt; it is today!"
        >
            example-component-1, compiler-dependent-mode, not being mounted.
        </example-component-1>
    </div>
EOT;

$page_contents[] = $study_1_compiler_dep_title . $example_vue_app_1_compiler_dep_mode;


// #############################################################################
// Printing page.

foreach ($page_contents as $content) {
    echo $tools->render('layouts/stackable', [
        'wrapper_extra_classes' => 'stackable--major',
        'stackable_content' => $content
    ]);
}
