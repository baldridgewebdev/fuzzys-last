<?php

/**
 * Class Fuzzys_Last_Model
 * Represents a model for handling Fuzzy's Last game logic.
 */
class Fuzzys_Last_Model {
  // Private properties
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
    "unify", "jerky", "wharf", "xerox", "yahoo", "zilch", "agile", "blink", "cobra", "dusk",
    "ember", "fjord", "grist", "havoc", "inert", "jaded", "kiosk", "lurch", "mural", "nymph",
    "overt", "prank", "quash", "relay", "skimp", "tryst", "usher", "venom", "whelp", "yodel"
  ];

  /**
   * Constructor for Fuzzys_Last_Model class.
   * Initializes the object with a given cookie name.
   *
   * @param string $cookie_name The name of the cookie to be used.
   */
  function __construct($cookie_name) {
    $this->cookie_name = $cookie_name;

    // Check if seed cookie exists, otherwise generate a new seed.
    if (!$this->load_seed_cookie()) {
      $seed = $this->generate_new_seed($seed_length = 5);
      $this->set_seed_cookie($seed);
      $this->seed = $this->convert_seed_to_indexs($seed);
    }

    // Set the game word list.
    $this->set_game_word_list();
  }

  /**
   * Gets the current game word list.
   *
   * @return array The array containing the game word list.
   */
  public function get_game_word_list() {
    return $this->game_word_list;
  }

  /**
   * Sets the game word list based on the current seed.
   */
  private function set_game_word_list() {
    $game_list = [];
    foreach ($this->seed as $i) {
      $game_list[] = $this->master_word_list[$i];
    }
    $this->game_word_list = $game_list;
  }

  /**
   * Loads the seed from the cookie and initializes the object's seed property.
   *
   * @return bool Returns true if the seed cookie exists and is loaded successfully, false otherwise.
   */
  private function load_seed_cookie() {
    $seed = $_COOKIE[$this->cookie_name];
    if (isset($seed)) {
      $this->seed = $this->convert_seed_to_indexs($seed);
      return true;
    }
    return false;
  }

  /**
   * Sets the seed cookie with the given seed value.
   *
   * @param string $seed The seed value to be set in the cookie.
   */
  private function set_seed_cookie($seed) {
    setcookie($this->cookie_name, $seed, time() + (86400 * 30), "/");
  }

  /**
   * Generates a new seed of a specified length.
   *
   * @param int $seed_length The length of the seed to be generated.
   * @return string The generated seed.
   */
  private function generate_new_seed($seed_length = 5) {
    $seed = "";
    for ($i = 0; $i < $seed_length; $i++) {
      $seed .= $this->generate_seed_part();
    }
    return $seed;
  }

  /**
   * Generates a part of the seed by creating a two-digit random number as a string.
   *
   * @return string The generated seed part.
   */
  private function generate_seed_part() {
    return str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
  }

  /**
   * Converts a seed string into an array of integers representing indexes.
   *
   * @param string $seed The seed string to be converted.
   * @return array The array of integers representing indexes.
   */
  private function convert_seed_to_indexs($seed) {
    $indexes = str_split($seed, 2);
    $indexes = array_map('intval', $indexes);
    return $indexes;
  }
}