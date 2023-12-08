<?php

/**
 * Plugin Name:       Fuzzy's Last
 * Plugin URI:        https://baldridgeweb.dev
 * Description:       A small code sample of a silly game.
 * Version:           0.1
 * Author:            Jenifer
 * GitHub Plugin URI: https://github.com/baldridgewebdev/fuzzys-last
 */

class Fuzzys_Last{
  private $cookie_name = 'fuzzys_last';
  public function __construct(  ) {
      $this->init_ajax();
    }
  private function load_game(){
    
  }
  private function fuzzy_search($query, $items, $threshold = 2) {
    $results = [];

    foreach ($items as $item) {
      $distance = levenshtein(strtolower($query), strtolower($item));

      if ($distance <= $threshold) {
        $results[$item] = $distance;
      }
    }

    asort($results); // Sort results by distance (lower is better)

    return $results;
  }
  private function init_ajax(){
    add_action( 'wp_ajax_guess', array($this,'ajax_guess') );
    add_action( 'wp_ajax_nopriv_guess', array($this,'ajax_guess') );
  }
  private function ajax_guess(){
    $this->load_game();
    die();
  }
}
$fuzzys = new Fuzzys_Last();
