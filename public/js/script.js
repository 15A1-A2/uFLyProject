$(document).ready(function(){
  function DayTimeFuc() {
  var date = new Date();
  var hours = date.getHours();

  var message;
  if (hours >= 6 && hours < 12 ) {
    message = "Goedemorgen"
  }

  else if (hours >= 12 && hours < 18) {
    message = "Goedemiddag"
  }

  else if (hours >= 18 && hours < 24) {
    message = "Goedeavond"
  }

  else {
    message = "Goedenacht";
  }

  document.getElementById('greeting').innerHTML = message;

  var timeOut = setTimeout(DayTimeFuc, 1000);

}

DayTimeFuc();

});
