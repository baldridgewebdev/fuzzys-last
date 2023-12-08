<?php

class Fuzzys_Last_View{
  function __construct(){
    
  }
  private function fuzzys_last_gameboard(){
    $html = '
    <div class="fuzzys-last">
      <div class="gameboard">
        <div class="words">
          <div id="fuzzy-word-1" class="word"></div>
          <div id="fuzzy-word-2" class="word"></div>
          <div id="fuzzy-word-3" class="word"></div>
          <div id="fuzzy-word-4" class="word"></div>
          <div id="fuzzy-word-5" class="word"></div>
        </div>
        <form class="fuzzy-input">
          <input id="fuzzy-guess-char-1" type="text" name="input1" maxlength="1" >
          <input id="fuzzy-guess-char-2" type="text" name="input2" maxlength="1" >
          <input id="fuzzy-guess-char-3" type="text" name="input3" maxlength="1" >
          <input id="fuzzy-guess-char-4" type="text" name="input4" maxlength="1" >
          <input id="fuzzy-guess-char-5" type="text" name="input5" maxlength="1" >
          <button name="submit" class="submit">Submit</button> <button name="new-game" class="new-game">New Game</button>
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
