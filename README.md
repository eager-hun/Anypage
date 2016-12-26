# Anypage

Tool (in the making) for:

- web UI prototyping,
- presenting a styleguide / pattern-library.

## Description

It is a php-based, simplified website engine that:

- offers a fast, simple, and flexible environment for developing web pages and
  website user interface components,
- attempts to reduce workload and improve refactor-ability by offering
  reusability: variables, functions, templates,
- is organized to fit the needs when demonstrating a complete page's design.

It also has a built-in way to generate all results into self-containing,
portable, static .html based copies of the site (instances/iterations of
a styleguide, possibly).

Further key features:

- Twig- and/or php-based templating,
- processing Markdown,
- gulp script complete with processing and bundling frontend assets,


## Warnings

### Application security

The php script does hardly have any security measures: it is meant to run only
on isolated developer machines.

The php app should never be placed on any publicly available server.

The shareable deliverables are the generated, static .html-file-based copies of
the site.

### If you are new to node.js and npm:

Learn how npm's procedures may affect your life, depending on your operating
system. E.g.:

- you will not want to get stuck with your `node_modules` directories on
  Windows machines; see: http://stackoverflow.com/q/28175200


## Project status

This project is hardly beyond the stage of being a hasty proof of concept.
There are plenty of unfinished features and processes.

Also, this is the first time I try to build a working app in OO php.


## Installation & getting going

The easiest way to try out what this project does is cloning it into
a php-equipped server's virtual host, with its directory name kept at the
original: "anypage".

If you manage to achieve the following path:

    web_document_root/anypage/index.php

then a large part of the default config will work out of the box.

If your path differs, you might need to update config and options entries in
the following places:

    controlroom/Config.php
    themes/theme-seed/gulpfile.js

The recursive cloning will also pull in the "theme-seed" git submodule, which
is - speaking in CMS-terms - comparable to a "theme".

    git clone --recursive https://github.com/eager-hun/anypage.git anypage
    cd anypage
    composer install
    cd themes/theme-seed
    npm install
    gulp compile

After this point the site should be ready to be viewed in a browser.


## Usage instructions

### Attitude

Each initiated instance of this project should be considered a standalone,
throwaway instance. This means that, I for one, so far, wouldn't worry about
keeping application logic untouched for the sake of upgradeability, or updates
or anything.

It should be subject of hacking apart however seems neccessary. I guess. At
this point.

### Good to know

Whereever the like of "aps" substring appears, it likely intends to hint at the
concept of "anypages".

### Basic config

The places to change application-related config are:

    controlroom/Config.php
    themes/theme-seed/gulpfile.js

and regarding the output of the website:

    controlroom/ApsSetup.php

### Adding a new page

In `controlroom/ApsSetup.php` enter a new nested array into the `$pages` array.

See inline documentation there.

### Defining contents for a new page

You will need to create a new content file with the extension of
`.prescription.php` for the new page, as documented in the inline documentation
of `$apsSetup->$pages` property.

This prescription file will get included in the script using output buffering,
which means that you don't have to send or store content in any kind of API:
instead, the way to go is to `echo` whatever, however you wish; all that will
become the page's content.

Essential/useful functionality will be available through the `$apsHelper`
object.

In this file you will be able to send pieces of content through templates (see
more about that below), and also, to pull in various predefined contents from
external files, such as ones in `anypages/contents/arbitrary/`. (Note that the
useful `$apsHelper` object is available also in these included extra content
files (as long as they are processed as php upon "importing").)

You are also free to define further utilities for yourself (possibly in the
`ApsHelper` class definition).

At this point it could be useful to:

- look into `anypages/ApsHelper.php` to see what the `$apsHelper` object
  offers,
- see how things are done in some of the existing prescription files, in
  `anypages/definitions/page-prescriptions/`.

### Using templates

The primary templating engine is Twig.

The secondary, plain php-based templating procedure can be activated (only on
a per template basis, as of now) by passing a corresponding argument to the renderer
method.

Templates can be organized in `anypages/templates/`.

Template filename extensions can be defined/changed in `controlroom/Config.php`.

Templates can be rendered using `$apsHelper->render()`, whereever the
`$apsHelper` object is available. See inline documentation by the method
definition.

### Using livereload

Livereload can either reload .css or .js files in the browser window, or can
reload the complete page, when it detects specified changes (defined in
`themes/theme-seed/gulpfile.js`) in the filetree.

To enable:

- edit `themes/theme-seed/gulpfile.js` and
  - update your site instance's domain name at the `reloadPage` entry in the
    `livereload` key in `options` object.
- set `enable_livereload` to true in `engineroom/Config.php`

Then in cli:

    cd themes/theme-seed
    gulp

Then visit the site in a browser.

(Note: you will not need a browser plugin for livereload: the
`enable_livereload` config item triggers the addition of a special `<script>`
tag on pages that makes things work.)

