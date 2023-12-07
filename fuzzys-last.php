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
  public function __construct(  ) {
		$this->load_game();
    $this->init_ajax();
	}
  private function load_game(){
    $this->fuzzy = $this->load_fuzzy();
  }
  private function load_fuzzy(){
    require_once __DIR__ . "/fuzzy.php";
  }
  private init_ajax(){
    add_action( 'wp_ajax_guess', array($this,'ajax_guess') );
		add_action( 'wp_ajax_nopriv_guess', array($this,'ajax_guess') );
  }
	private ajax_guess(){
		die();
	}
}
$fuzzys = new Fuzzys_Last();