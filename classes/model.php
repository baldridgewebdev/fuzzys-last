<?php
class Fuzzys_Last_Model{
  private $seed = [];
  private $cookie_name = '';
  private $master_word_list = [
    "apple", "beach", "charm", "dusty", "every", "fifty", "glass", "happy", "ideal", "jolly",
    "knees", "lemon", "magic", "noble", "opera", "piano", "quick", "rainy", "salty", "tiger",
    "uncle", "vapor", "watch", "zebra", "amber", "blend", "hello", "dance", "eagle", "flame",
    "grime", "honey", "image", "juicy", "karma", "laugh", "mango", "nexus", "olive", "pilot",
    "quirk", "razor", "shine", "tramp", "unity", "venom", "whisk", "xenon", "yearn", "zesty",
    "alive", "brave", "cocoa", "diary", "erupt", "flint", "glide", "hound", "irish", "joust",
    "koala", "lingo", "mango", "nylon", "opium", "plump", "quest", "rocky", "snare", "trace",
    "unify", "vortex", "wharf", "xerox", "yahoo", "zilch", "agile", "blink", "cobra", "dusk",
    "ember", "fjord", "grist", "havoc", "inert", "jaded", "kiosk", "lurch", "mural", "nymph",
    "overt", "prank", "quash", "relay", "skimp", "tryst", "usher", "venom", "whelp", "yodel"
  ];
  private $game_word_list = [];
  function __construct($cookie_name){
    $this->cookie_name = $cookie_name;
    if(!$this->load_seed_cookie()){
      $seed = $this->generate_new_seed($seed_length=5);
      set_seed_cookie($seed);
      $this->seed = $this->convert_seed_to_indexs($seed);
    }
    $this->set_game_list();
  }

  public function get_game_word_list(){
    return $this->game_word_list;
  }
  private function set_game_word_list(){
    $game_list = [];
    foreach($this->seed as $i){
      $game_list[] = $master_word_list[$i];
    }
    $this->game_word_list = $game_list;
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
    for($i = 0; $i < $seed_length; $i++){
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
  
}
