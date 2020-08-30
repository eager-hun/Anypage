<?php
/**
 * @file
 * Php functions created here will be available in the anypage recipes.
 */

function helper_path_to_image($tools, $img) {
    return $tools->pathToPayloadFiles() . '/images/' . $img;
}

