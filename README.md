# Anypage

Tool in the making, that aims to provide a friendly platform for:

- web UI quick tinkering / ideating / prototyping,
- producing — really basic — portable static websites,
- and possibly more.

## Description

It is a php-based, simplified website engine that:

- offers a fast and simple environment for creating web pages and user interface
  components,
- helps prototyping in the browser by offering reusability: variables,
  templates, and functions for commonly needed tasks.

Further key features:

- Twig- and/or php-based templating,
- processing Markdown,
- simple static site generator for portable, standalone project snapshots,
- when used together with the [frontend-seed][frontend-seed-github] project:
    - Gulp / Webpack hybrid frontend build tooling with:
        - livereload (for a customizable range of files),
        - Vue.js pre-installed / configured.
        

## Project state

This project is still not beyond the stage of being a hasty proof of concept.
There are plenty of missing-, unfinished, and to-be-improved features.

Also, this is the first time I build a working app in object-oriented php.
Rewrites still seem to be a regular occurrence.


## Warnings

### Application security

The php script does hardly have any security measures: it is meant to run only
on isolated developer machines.

**The php app should never be placed on any publicly accessible server.**

The shareable deliverables are the generated, static .html-file-based copies of
the site.

### If you are new to node.js and npm:

Learn how npm's procedures may affect your life, depending on your operating
system. E.g.:

- you will not want to get stuck with your `node_modules` folders on Windows
  machines; see: http://stackoverflow.com/q/28175200


## Getting started

The easiest way to try out what this project does is cloning it into
a php-equipped server's virtual host.

If you manage to achieve the following path:

    <web-document-root>/index.php

then the default config might work out of the box.

If your path differs, you might need to update config and options entries, as
discussed later.

### Installation

#### Prerequisites

- For the installation, you need on your machine:
    - [git][git],
    - [php][php],
    - [Composer][composer],
    - [Node.js / NPM][node],
    - [Gulp][gulp] (installed globally).
- To use the installed site, you need a php-equipped server solution — e.g.
[Apache][apache], or [Nginx][nginx], or possibly a [Vagrant][vagrant] box with
Nginx already set up, like [Laravel Homestead][homestead].
  
(Laravel Homestead has php and Composer set up in it, so — if need be — it is
possible to install the site's Composer dependencies inside the Homestead
virtual machine.)

#### Installing

The repository defines the "[frontend-seed][frontend-seed-github]"
git submodule, which is — speaking in CMS-terms — comparable to a "theme".

    git clone --recursive https://github.com/eager-hun/anypage.git

    private$ composer install
    
    public/themes/frontend-seed$ npm install
    public/themes/frontend-seed$ gulp compile
    
Review configs:
    
    director.php
    private/config/config.php
    public/themes/frontend-seed/build-setup/gulp-webpack-hybrid/gulp-setup.js
    
After this point the site should be ready to be viewed in a browser.


## How to use

Documentation TODO.


[frontend-seed-github]: https://github.com/eager-hun/frontend-seed
[git]: https://git-scm.com/downloads
[php]: http://php.net/manual/en/install.php
[composer]: https://getcomposer.org/
[node]: https://nodejs.org/en/ 
[gulp]: https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md
[apache]: https://httpd.apache.org/
[nginx]: https://www.nginx.com/resources/wiki/
[vagrant]: https://www.vagrantup.com/
[homestead]: https://laravel.com/docs/master/homestead 