<?php

class ProcessInfo {

  public function get($property) {
    if (property_exists('ProcessInfo', $property)) {
      return $this->$property;
    }
    else {
      // TODO: error message?
      echo 'No such property to get in ProcessInfo.';
    }
  }

  public function set($property, $value) {
    if (property_exists('ProcessInfo', $property)) {
      $this->$property = $value;
    }
    else {
      // TODO: error message?
      echo 'No such property to set in ProcessInfo.';
    }
  }

  // --------------------------------------------------------------------------
  // PROPS.

  private $task_type            = 'page'; // Default.
  private $page_id              = '';
}

