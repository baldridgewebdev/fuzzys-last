<?php

class Fuzzys_Last_View{
  function __construct(){
    
  }
  public function fuzzys_last_gameboard($word_count = 5, $word_length = 5){
    $html = '
    <div class="fuzzys-last">
      <div class="gameboard">
        <div class="words">';
		for($i = 1; $i <= $word_count; $i++){
			$html .= '<div id="fuzzy-word-'.$i.'" class="word"></div>';
		}
    $html = '</div>
		  <form class="fuzzy-form">
			<div class="fuzzy-inputs"';
		for($i = 1; $i <= $word_length; $i++){
			$html .= '<input id="fuzzy-guess-char-'.$i.'" type="text" name="fuzzy-input'.$i.'" maxlength="1" >';
		}
    $html = '</div><div class="button-area">
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
    return $html;
  }
}
