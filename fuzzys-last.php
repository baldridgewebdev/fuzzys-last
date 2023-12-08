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
  private $view;
  public function __construct(  ) {
    $this->init_ajax();
    $this->init_classes();
    $this->init_scripts();
  }
  private function init_classes(){
    require_once __DIR__ . '/classes/model.php';
    require_once __DIR__ . '/classes/view.php';
    $this->view = new Fuzzys_Last_View();
  }
  private function init_scripts(){
    add_action( 'wp_enqueue_scripts', function(){
      wp_enqueue_script( 'fuzzys-last-behaviours', plugins_url( '/assets/behaviours.js' , __FILE__ ), array( 'jquery' ) );
      wp_enqueue_style( 'fuzzys-last-style', plugins_url( '/assets/style.css' , __FILE__ ));
    } );
  }
  private function init_ajax(){
    add_action( 'wp_ajax_guess', array($this,'ajax_guess') );
    add_action( 'wp_ajax_nopriv_guess', array($this,'ajax_guess') );
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
  private function ajax_guess(){
    $this->load_game();
    die();
  }
}
$fuzzys = new Fuzzys_Last();
