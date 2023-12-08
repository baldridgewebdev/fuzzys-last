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
  private function load_seed_cookie(){
    $seed = $_COOKIE[$this->cookie_name];
    if(isset($seed)){
      $this->seed = $this->convert_seed_to_indexs($seed);
      return true;
    }
    return false;
  }
  private function set_seed_cookie($seed){
    setcookie($this->cookie_name, $seed, time() + (86400 * 30), "/");
  }
  private function generate_new_seed($seed_length=5){
    $seed = "";
    for($i = 0; $i < $seed_length; $i++;){
      $seed += $this->generate_seed_part();
    }
    return $seed;
  }
  private function generate_seed_part(){
    return str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
  }
  private function convert_seed_to_indexs($seed){
    $indexes = str_split($seed,2);
    $indexes = array_map('intval',$indexes);
    return $indexes;
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
