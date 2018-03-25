<?php

// See https://twig.symfony.com/doc/2.x/api.html#environment-options
// See https://twig.symfony.com/doc/2.x/api.html#built-in-loaders

$templating_config = $processManager
    ->getConfig('config')['app']['templating'];


// #############################################################################
// Setting up template-containing directories.

$twig_loader = new Twig_Loader_Filesystem(TEMPLATES);

// One can use (and override existing) templates from the anypages' dir.
$anypage_templates = ANYPAGES . '/templates';
if (file_exists($anypage_templates)) {
    $twig_loader->prependPath($anypage_templates);
}

// One can use (and override existing) templates from the theme.
$path_to_theme = $processManager
    ->getInstruction('path-fragment-to-theme');
$theme_templates = PUBLIC_RESOURCES . '/' . $path_to_theme . '/templates';
if (file_exists($theme_templates)) {
    $twig_loader->prependPath($theme_templates);
}


// #############################################################################
// Instantiating Twig.

$twig_options = $templating_config['twig-renderer-options'];

$twig = new Twig_Environment($twig_loader, $twig_options);


// #############################################################################
// Extensions.

// see https://twig.symfony.com/doc/2.x/advanced.html#extending-twig

// -----------------------------------------------------------------------------
// Debugging features.

if ( ! empty($twig_options['debug'])) {
    $twig->addExtension(new Twig_Extension_Debug());
}

// -----------------------------------------------------------------------------
// Custom test: `numeric`.

$numeric_test = new Twig_Test('numeric', function($arg) {
    return is_numeric($arg);
});

$twig->addTest($numeric_test);

// -----------------------------------------------------------------------------
// Custom filter: `merge_r`.

// NOTE: highly experimental.

$filter_merge_recursive = new Twig_Filter('merge_r', function($arg1, $arg2) {
    if (is_array($arg1) && is_array($arg2)) {
        return array_merge_recursive($arg1, $arg2);
    }
    elseif ( ! is_array($arg1) && is_array($arg2)) {
        return $arg2;
    }
    elseif (is_array($arg1) && ! is_array($arg2)) {
        return $arg1;
    }
    else {
        return [];
    }
});

$twig->addFilter($filter_merge_recursive);

// -----------------------------------------------------------------------------
// Custom function: `extendAttrs`.

$extend_attributes_func = new Twig_Function('extendAttrs',
    function(
        Twig_Environment $env, $attributes = [], $key, $value = NULL, $force = false
    ) {

        if ( ! is_array($attributes)) {
            $attributes = [];
        }

        $isArrayHoldingAttribute =
            $GLOBALS['ap_security']->isArrayHoldingHtmlAttribute($key);

        if (is_null($value)) {
            $attributes[] = $key;
        }
        // Overriding / modifying existing attribute.
        elseif (array_key_exists($key, $attributes)) {
            if ($isArrayHoldingAttribute && is_string($value)) {
                $attributes[$key][] = $value;
            }
            elseif ($isArrayHoldingAttribute && is_array($value)) {
                $attributes[$key] = array_merge($attributes[$key], $value);
            }
            elseif ($force == true) {
                $attributes[$key] = $value;
            }
        }
        // Adding as a new attribute.
        else {
            if ($isArrayHoldingAttribute && is_string($value)) {
                $attributes[$key] = [$value];
            }
            else {
                $attributes[$key] = $value;
            }
        }

        return $attributes;
    },
    ['needs_environment' => true]
);

$twig->addFunction($extend_attributes_func);

// -----------------------------------------------------------------------------
// Custom function: `attr`.

// NOTE: UNSAFE.

// FIXME.
$GLOBALS['ap_security'] = $capacities->get('security');

$attributes_func = new Twig_Function('attr', function($attributes) {

    $output = [];

    $attribute_whitelist = $GLOBALS['ap_security']->html_attribute_whitelist;

    $arrayHoldingHtmlAttributes =
        $GLOBALS['ap_security']->arrayHoldingHtmlAttributes;

    foreach ($attributes as $key => $value) {
        $isArrayHoldingAttribute =
            $GLOBALS['ap_security']->isArrayHoldingHtmlAttribute($key);

        if (is_numeric($key)) {
            if ( ! in_array($value, $attribute_whitelist)) {
                continue;
            }

            $output[] = $value;
        }
        elseif ( ! empty($isArrayHoldingAttribute)) {
            if ( ! in_array($key, $attribute_whitelist)) {
                continue;
            }

            if (array_key_exists('separator', $arrayHoldingHtmlAttributes[$key])) {
                $glue = $arrayHoldingHtmlAttributes[$key]['separator'];
            }
            else {
                $glue = ' '; // Fallback.
            }

            $output[] = $key . '="' . implode($glue, $value) . '"';
        }
        elseif (in_array($key, $attribute_whitelist)) {
            $output[] = $key . '="' . $value . '"';
        }
    }
    unset($key, $value);

    return implode($output, ' ');

}, ['is_safe' => ['html']]);

$twig->addFunction($attributes_func);


// #############################################################################
// Return.

return $twig;
