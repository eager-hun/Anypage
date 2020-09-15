# Anypage

Tool in the making, that aims to provide a friendly platform for:

- web UI quick tinkering / ideating / prototyping,
- producing — really basic — portable static websites,
- and possibly more.

## Description

Anypage is a php-based, simplified website engine that:

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


### Project state

This project is still not beyond the stage of being a hasty proof of concept.
There are plenty of missing-, unfinished, and to-be-improved features.

Also, this is the first time I build a working app in object-oriented php.
Rewrites still seem to be a regular occurrence.


### Application security (non-existent!)

The php script hardly has any security measures: it is meant to run only on
isolated developer machines.

**The php app should never be placed on any publicly accessible server.**

_The shareable deliverables are the generated, static .html-file-based copies
of the site._


### Platform compatibility

I've seen this project work well on Ubuntu and MacOS platforms.

I however don't test on, and don't maintain any Windows compatibility.


## Getting started

### Prerequisites

For installing and using the project, you need on your machine:

- [php][php],
- [Composer][composer],
- [Node.js / NPM][node],
- [Gulp][gulp] (installed globally)

Having [git][git] installed also helps.

### Installing

The repository defines the "[plain-theme][plain-theme-github]" and
"[frontend-seed][frontend-seed-github]" git submodules, which are — speaking in
CMS-terms — comparable to "themes".

Recursive cloning should set up the submodules in a single command:

    git clone --recursive https://github.com/eager-hun/anypage.git anypage

Installing backend dependencies:

    anypage/private$ composer install

The default `plain-theme` does not need any initialization.

The non-default `frontend-seed` theme would need initializing — although it is
not recommended, as this theme is sort of **abandonware**, and as such, may
contain several node.js security issues among its numerous dependencies that
could get executed, already during install. With that in consideration, the
commands are:

    anypage/public/themes/frontend-seed$ npm install
    anypage/public/themes/frontend-seed$ gulp compile


### Accessing the site

The quickest way is using [php's built-in web-server][php-server] on the command
line, from the project's `public` directory (where `index.php` resides).

    anypage/public$ php -S 127.0.0.1:8001

Then the site should be available on the `http://127.0.0.1:8001` URL in the
browser.

#### Configuration

The out of the box configuration is expected to work for a new installation.

In case of any errors showing up, configuration in the following places might
need adjusting:

    anypage/director.php

Additionally for the default site:

    anypage/private/anypages/example-website/config/*.php
    anypage/public/themes/plain-theme/build-setup/*.php

Additionally for the alternative (older) site:

    anypage/private/anypages/pattern-library-1/config/*.php
    anypage/public/themes/frontend-seed/build-setup/gulp-webpack-hybrid/gulp-setup.js


#### More options for serving

A full-fledged web-server with php integration — e.g. [Apache][apache], or
[Nginx][nginx] — can also be a good fit to run the project with.

If you don't want to set up the server yourself, you can possibly opt for a
prepared [Vagrant][vagrant] [box][vagrant-boxes] with the necessities already
set up, such as [Laravel Homestead][homestead].

## How to use

Documentation TODO.


[plain-theme-github]: https://github.com/eager-hun/plain-theme
[frontend-seed-github]: https://github.com/eager-hun/frontend-seed
[git]: https://git-scm.com/downloads
[php]: http://php.net/manual/en/install.php
[composer]: https://getcomposer.org/
[node]: https://nodejs.org/en/
[gulp]: https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md
[php-server]: http://php.net/manual/en/features.commandline.webserver.php
[apache]: https://httpd.apache.org/
[nginx]: https://www.nginx.com/resources/wiki/
[vagrant]: https://www.vagrantup.com/
[vagrant-boxes]: https://app.vagrantup.com/boxes/search
[homestead]: https://laravel.com/docs/master/homestead
