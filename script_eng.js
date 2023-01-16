function formValidation() {
    // Get all the fieldsets on the form
    const fieldsets = document.querySelectorAll("fieldset");
  
    // Loop through each fieldset
    for (let i = 0; i < fieldsets.length; i++) {
      // Get all the radio buttons within the fieldset
      let radios = fieldsets[i].querySelectorAll("input[type='radio']");
  
      // Variable to track if a radio button has been selected
      let selected = false;
  
      // Loop through each radio button
      for (let j = 0; j < radios.length; j++) {
        if (radios[j].checked) {
          // A radio button has been selected
          selected = true;
          break;
        }
      }
  
      if (!selected) {
        // No radio button was selected in this fieldset, display an error message
        alert("You did't answer question " + (i + 1));
        fieldsets[i].childNodes[0].focus();
        return false;
      }
    }
  
    // All fieldsets have a radio button selected, form is valid
    return true;
  }
  