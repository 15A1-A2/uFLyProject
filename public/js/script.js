$(document).ready(function(){
  // Loads the datatable
  $('.overview-table').DataTable({
    "language": {
      // languagev .json file
      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Dutch.json"

      }
  });

  $('select').niceSelect();

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
      message = "Goedenavond"
    }

    else {
      message = "Goedenacht";
    }

    $(".greeting" ).append(message);


  }

  DayTimeFuc();

});
