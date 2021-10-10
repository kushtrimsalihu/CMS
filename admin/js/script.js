$(document).ready(function () {
  //EditorCKeditor
  ClassicEditor.create(document.querySelector("#body")).catch((error) => {
    console.error(error);
  });

  //All code below ---


  //select boxes with , publish ,
  // ,delete ,clone etc.

  $(document).ready(function () {
    $("#selectAllBoxes").click(function (event) {
      if (this.checked) {
        $(".checkBoxes").each(function () {
          this.checked = true;
        });
      } else {
        $(".checkBoxes").each(function () {
          this.checked = false;
        });
      }
    });
  });



  
//loader
  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  $("body").prepend(div_box);

  $("#load-screen")
    .delay(600)
    .fadeOut(600, function () {
      $(this).remove();
    });
});


//online users
function loadUSersOnline() {
  $.get("functions.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
  });
}
setInterval(function () {
  loadUSersOnline();
}, 500);
loadUSersOnline();
