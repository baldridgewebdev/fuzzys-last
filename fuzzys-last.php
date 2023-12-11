<?php

/**
 * Plugin Name:       Fuzzy's Last
 * Plugin URI:        https://baldridgeweb.dev
 * Description:       A small code sample of a silly game.
 * Version:           0.8
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
    $this->init_shortcodes();
  }
  private function init_classes(){
    require_once __DIR__ . '/classes/model.php';
    require_once __DIR__ . '/classes/view.php';
    $this->view = new Fuzzys_Last_View();
  }
  private function init_scripts(){
    add_action( 'wp_enqueue_scripts', function(){
      wp_enqueue_script( 'fuzzys-last-behaviours', plugins_url( '/assets/behaviours.js' , __FILE__ ), array( 'jquery' ) );
	  wp_localize_script('fuzzys-last-behaviours', 'alfred', array('ajax_url' => admin_url('admin-ajax.php')));
      wp_enqueue_style( 'fuzzys-last-style', plugins_url( '/assets/style.css' , __FILE__ ));
    } );
  }
  private function init_shortcodes(){
    add_shortcode('fuzzys_last', array($this,'fuzzys_last_shortcode'));
  }
  public function fuzzys_last_shortcode(){
    return $this->view->fuzzys_last_gameboard();
  }
  private function init_ajax(){
    add_action( 'wp_ajax_guess', array($this,'ajax_guess') );
    add_action( 'wp_ajax_nopriv_guess', array($this,'ajax_guess') );
  }
  private function load_game(){
    $this->model = new Fuzzys_Last_Model($this->cookie_name);
  }
  private function fuzzy_search($query, $items) {
    $results = [];

    foreach ($items as $item) {
      $distance = levenshtein(strtolower($query), strtolower($item));

        $results[] = $distance;
    }
	if(empty($results)) return $results;

    return $results;
  }
  public function ajax_guess(){
    $this->load_game();
	$query = substr($_POST['guess'],0,5);
	$items = $this->model->get_game_word_list();
	$results = $this->fuzzy_search($query, $items);
	echo json_encode($results);
    die();
  }
}
$fuzzys = new Fuzzys_Last();
