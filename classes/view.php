<?php
/**
 * Class Fuzzys_Last_View
 * Represents the view for the Fuzzy's Last game.
 */
class Fuzzys_Last_View {
  
  /**
   * Constructor for the Fuzzys_Last_View class.
   * Initializes the object.
   */
  function __construct() {
    // Constructor logic (if any)
  }

  /**
   * Generates the HTML for the Fuzzy's Last gameboard.
   *
   * @param int $word_count   Number of words to display on the gameboard.
   * @param int $word_length  Length of each word to be guessed.
   * @return string           HTML code for the gameboard.
   */
  public function fuzzys_last_gameboard($word_count = 5, $word_length = 5) {
    // Initialize HTML string with gameboard structure
    $html = '
    <div class="fuzzys-last">
      <div class="gameboard">
        <div class="words">';

    // Generate HTML for each word on the gameboard
    for ($i = 1; $i <= $word_count; $i++) {
      $html .= '<div id="fuzzy-word-' . $i . '" class="word" title="Word ' . $i . '">5</div>';
    }

    // Complete the words section and start the form
    $html .= '</div>
		  <form class="fuzzy-form">
			<div class="fuzzy-inputs">';

    // Generate HTML for the input fields for guessing characters
    for ($i = 1; $i <= $word_length; $i++) {
      $html .= '<input id="fuzzy-guess-char-' . $i . '" type="text" name="fuzzy-input' . $i . '" maxlength="1" >';
    }

    // Complete the form and add button area
    $html .= '</div><div class="button-area">
          <button name="submit" class="submit">Submit</button> <button name="new-game" class="new-game">New Game</button>
		  </div>
        </form>
      </div>
      <div class="instructions">
      </div>
      <div class="winner-modal hidden">
        <div class="inner-content">Yay!  You won!<button class="modal-close">close</button></div>
      </div>
    </div>
    ';

    // Return the generated HTML
    return $html;
  }
}