<?php

// See http://symfony.com/doc/current/components/http_foundation/introduction.html .
// See http://symfony.com/doc/current/book/http_fundamentals.html .

//var_dump($Request->getPathInfo());
//var_dump($Request->getContent());
//var_dump($Request->attributes);
//var_dump($Request->request);
//var_dump($Request->query);
//var_dump($Request->server);
//var_dump($Request->files);
//var_dump($Request->cookies);
//var_dump($Request->headers);


// With no arguments given at all, we serve the homepage.
if (empty($Request->server->get('REQUEST_URI'))) {
  $ProcessInfo->set('page_id', 'home');
}
else {
  $routing = array();
  $routing['uri_path'] =
    ltrim(strtok($Request->server->get('REQUEST_URI'), '?'), '/');

  if (!empty($routing['uri_path'])) {

    $routing['uri_path_items'] = explode('/', $routing['uri_path']);

    // Determining special task.
    if (!empty($Config->get('env')['working_dir'])) {
      $working_dir_items = explode('/', $Config->get('env')['working_dir']);
      $pivotal_key = count($working_dir_items);
      $special_task = array_search(
        $routing['uri_path_items'][$pivotal_key],
        $Config->get('app')['reserved_paths']
      );
    }
    else {
      $special_task =
        array_search(
          $routing['uri_path_items'][0],
          $Config->get('app')['reserved_paths']
        );
    }

    // Passing on findings.
    if ($special_task !== FALSE) {
      $ProcessInfo->set('task_type', $special_task);
    }
    else {
      $ProcessInfo->set('task_type', 'page');

      if (!empty($Config->get('env')['working_dir'])) {
        $home_path = $Config->get('env')['working_dir'] . '/';

        if ($routing['uri_path'] == $home_path) {
          $ProcessInfo->set('task_type', 'page');
          $ProcessInfo->set('page_id', 'home');
        }
        // Else the page_id will be identified later on.
      }
      // And the page_id will be identified later on.
    }
  }
  // No path given in the URI, so homepage gets served.
  else {
    $ProcessInfo->set('task_type', 'page');
    $ProcessInfo->set('page_id', 'home');
  }
}

if ($ProcessInfo->get('task_type') == 'page'
  && !empty($Request->query->get('gen'))) {
  $ProcessInfo->set('building_static_file', TRUE);
}

function determine_page_id($Config, $ApsSetup, $ProcessInfo, $routing) {
  // As of now, only 'page' type tasks will require a page_id.
  // It also might happen that we already have identified the homepage to be
  // served.
  if ($ProcessInfo->get('task_type') != 'page'
    || !empty($ProcessInfo->get('page_id'))) {
    return;
  }

  $pages = $ApsSetup->get('pages');

  // Find out how the path would look like without the working dir.
  if (empty($Config->get('env')['working_dir'])) {
    $prepared_uri_path = $routing['uri_path'];
  }
  // Else find out how it looks when there is a working dir.
  else {
    $to_trim = $Config->get('env')['working_dir'] . '/';
    $prepared_uri_path = substr($routing['uri_path'], strlen($to_trim));
  }

  // Decide the page_id by comparing the path to our path records.
  $path_records = [];

  // Building a searchable array of the existing paths.
  // This would be expensive for a large project but ours is expected to have
  // only 5-20 pages.
  foreach ($pages as $id => $data) {
    $path_records[$id] = $data['path'];
  }

  if (($index = array_search($prepared_uri_path, $path_records)) !== FALSE) {
    $ProcessInfo->set('page_id', $index);
  }
  // Else 404.
  else {
    $ProcessInfo->set('page_id', 'app_404');
  }
}

determine_page_id($Config, $ApsSetup, $ProcessInfo, $routing);

//var_dump($ProcessInfo->get('task_type'));
//var_dump($ProcessInfo->get('page_id'));

$document = $PageProvider->renderPage();

