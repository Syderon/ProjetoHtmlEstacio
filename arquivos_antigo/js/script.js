$(document).ready(function () {
  $("#filter-button").on("click", function () {
    var filter = $("#filter-input").val().toLowerCase();
    $("#anime-list li").each(function () {
      var title = $(this).find("strong").text().toLowerCase();
      if (title.includes(filter)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});
