# Anypage

Tool (in the making) for:

- web UI prototyping,
- presenting a styleguide / pattern-library.

## Description

It is a php-based, simplified website engine that:

- offers a fast, simple, and flexible environment for developing web pages and
  user interface components,
- attempts to optimize the workload of prototyping in the browser by offering
  reusability: variables, functions, templates.

It also has a built-in way to generate all results into self-containing,
portable, static .html based copies of the site (instances/iterations of
a styleguide, possibly).

Further key features:

- Twig- and/or php-based templating,
- processing Markdown,
- gulp script complete with processing and bundling frontend assets.


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


## Installation & getting going

The easiest way to try out what this project does is cloning it into
a php-equipped server's virtual host, with its directory name kept at the
original: "anypage".

If you manage to achieve the following path:

    web_document_root/anypage/index.php

then a large part of the default config will work out of the box.

If your path differs, you might need to update config and options entries in
the following places:

    [TODO: documentation]

The repository defines the "[theme-seed][theme-seed-github]"
git submodule, which is - speaking in CMS-terms - comparable to a "theme".

    git clone https://github.com/eager-hun/anypage.git anypage
    cd anypage
    git submoule init
    git submodule update
    cd private
    composer install
    cd ../public/themes/theme-seed
    npm install
    gulp compile

After this point the site should be ready to be viewed in a browser.

[theme-seed-github]: https://github.com/eager-hun/theme-seed
