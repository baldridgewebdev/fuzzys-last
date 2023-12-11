(function($){
	$(document).ready(()=>{
		// Prevent form submission
        $('.fuzzy-form').submit(function (event) {
            event.preventDefault();
        });

        // Handle submit button click
        $('.submit').click(function () {
			var combinedString = '';
			$('.fuzzy-inputs input').each((index, e)=>{
				combinedString += $(e).val();
			});
			$('.fuzzys-last').addClass('loading');
            // Send AJAX request to the server
            $.ajax({
                type: 'POST',
                url: alfred.ajax_url,
                data: {
                    action: 'guess',
                    guess: combinedString
                },
                success: function (response) {
					$('.fuzzys-last').removeClass('loading');
					response = JSON.parse(response);
                    updateGameBoard(response);
                    console.log(response);
                },
                error: function (error) {
					$('.fuzzys-last').removeClass('loading');
					$('.fuzzys-last').addClass('error');
                    // Handle error
                    console.error(error);
                }
            });
		});
		// Function to handle the close button being pressed
		  $(".modal-close").on("click", function () {
			$(".winner-modal").addClass("hidden");
			resetGame();
		  });
		  // Function to handle the new game button being pressed
		$(".new-game").click(resetGame);
		
		var inputDirection = 0;
		$('.fuzzy-inputs input').keyup(function(event) {
		var currentInput = $(this);
		var currentIndex = currentInput.index();
		var inputValue = currentInput.val();

		if (inputDirection < 0) {
		  // Backspace pressed in an empty field
		  if (currentIndex > 0) {
			var prevInput = currentInput.prev();
			prevInput.focus().val('');
		  }
		} else if (inputDirection > 0) {
		  // Non-empty input, focus the next input
		  if (currentIndex < 4) {
			var nextInput = currentInput.next();
			window.setTimeout(function(){this.focus();}.bind(nextInput),1);
		  }
		}
		inputDirection = 0;
	  });
	  
	  $('.fuzzy-inputs input').keydown(function(event) {
		var currentInput = $(this);
		var inputValue = currentInput.val();
		inputDirection = 0;
		if (event.which === 8 && inputValue === '') {
		  // Backspace pressed in an empty field
		  inputDirection = -1;
		} else if (event.which >= 65 && event.which <= 90) {
		  // letter pressed
		  inputDirection = 1;
		}
	  });
	});
	function updateGameBoard(scores) {
    // Iterate through each score and update the corresponding word box
    scores.forEach(function (score, index) {
      // Build the selector for the current word box
      var selector = "#fuzzy-word-" + (index + 1);

      // Update the text content of the word box with the score
      $(selector).text(score);
    });

    // Check for victory condition (if any of the scores are 0)
    if (scores.some(score => score === 0)) {
      // Show the winner modal
      $(".winner-modal").removeClass("hidden");
    }
  }
  function resetGame() {
		document.cookie = "fuzzys_last=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
		$(".word").text("5");
		$('.fuzzy-inputs input').val('');
	}
})(jQuery);