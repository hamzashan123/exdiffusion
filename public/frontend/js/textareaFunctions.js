const pos_prompt = $('#prompt');
const neg_prompt = $('#neg_prompt');

var Prompt_denominatorLimit = 75;
pos_prompt.on('input', function() {

    var promptNominatorCount = $('#Prompt_nominatorCount').text(); 
    var text = $(this).val();
    var words = text.split(/\s+|(?=[,.])/).filter(Boolean);
    var wordCount = words.length;

    // Update the currentLimit when the word count reaches the current limit
    if (wordCount >= Prompt_denominatorLimit) {
      Prompt_denominatorLimit += 75;
    }

    // Decrease the currentLimit when the word count drops by 75
    if (wordCount < Prompt_denominatorLimit - 75) {
      Prompt_denominatorLimit -= 75;
    }

    $('#Prompt_nominatorCount').text("");
    $('#Prompt_nominatorCount').text(wordCount);

    $('#Prompt_denominatorCount').text("");
    $('#Prompt_denominatorCount').text(Prompt_denominatorLimit);
 

    // $(this).css('height', '0');
    // $(this).css('height', this.scrollHeight + 'px');
    this.style.height = 'auto';
    this.style.height = Math.max(50, this.scrollHeight) + 'px';
    
    var brackets = {
      '[': 0,
      '(': 0,
      '{': 0,
      '<': 0
      // Add more bracket types if needed
    };

    var error = false;
    $('.counterPrompt').css('border-color','#a157dc');
    $('#generateBtn').removeAttr('disabled');
    for (var i = 0; i < text.length; i++) {
          var char = text[i];
          if (char in brackets) {
              brackets[char]++;
          } else if (char === ']' || char === ')' || char === '}' || char === '>') {
              var correspondingOpenBracket = getCorrespondingOpenBracket(char);

              if (brackets[correspondingOpenBracket] === 0) {
                  error = true;
                  break;
              } else {
                  brackets[correspondingOpenBracket]--;
              }
          }
      }

      for (var bracket in brackets) {
          if (brackets[bracket] > 0) {
              error = true;
              break;
          }
      }

      if (error) {
          $('.counterPrompt').css('border-color','red');
          $('#generateBtn').attr('disabled','true');
          console.log('Error: Imbalanced brackets');
      }

});



neg_prompt.on('input', function() {

    var promptNominatorCount = $('#Neg_prompt_nominatorCount').text(); 
    var text = $(this).val();
    var words = text.split(/\s+|(?=[,.])/).filter(Boolean);
    var wordCount = words.length;

    // Update the currentLimit when the word count reaches the current limit
    if (wordCount >= Prompt_denominatorLimit) {
      Prompt_denominatorLimit += 75;
    }

    // Decrease the currentLimit when the word count drops by 75
    if (wordCount < Prompt_denominatorLimit - 75) {
      Prompt_denominatorLimit -= 75;
    }

    $('#Neg_prompt_nominatorCount').text("");
    $('#Neg_prompt_nominatorCount').text(wordCount);

    $('#Neg_prompt_denominatorCount').text("");
    $('#Neg_prompt_denominatorCount').text(Prompt_denominatorLimit);
 

    this.style.height = 'auto';
    this.style.height = Math.max(50, this.scrollHeight) + 'px';
    
    var brackets = {
      '[': 0,
      '(': 0,
      '{': 0,
      '<': 0
      // Add more bracket types if needed
    };

    var error = false;
    $('.counterNegPrompt').css('border-color','#a157dc');
    $('#generateBtn').removeAttr('disabled');
    for (var i = 0; i < text.length; i++) {
          var char = text[i];
          if (char in brackets) {
              brackets[char]++;
          } else if (char === ']' || char === ')' || char === '}' || char === '>') {
              var correspondingOpenBracket = getCorrespondingOpenBracket(char);

              if (brackets[correspondingOpenBracket] === 0) {
                  error = true;
                  break;
              } else {
                  brackets[correspondingOpenBracket]--;
              }
          }
      }

      for (var bracket in brackets) {
          if (brackets[bracket] > 0) {
              error = true;
              break;
          }
      }

      if (error) {
          $('.counterNegPrompt').css('border-color','red');
          $('#generateBtn').attr('disabled','true');
          console.log('Error: Imbalanced brackets');
      }

});

neg_prompt.on('input', function() {
    // $(this).css('height', '0');
    $(this).css('height', this.scrollHeight + 'px');
});


function getCorrespondingOpenBracket(closeBracket) {
    var bracketPairs = {
        ']': '[',
        ')': '(',
        '}': '{',
        '>': '<'
        // Add more bracket pairs if needed
    };
  
    return bracketPairs[closeBracket];
}