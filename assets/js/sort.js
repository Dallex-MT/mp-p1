$(document).ready(function () {
  $(".popular-menu__filter button").on("click", function () {
    var marca = $(this).data("filter");

    $(".popular-menu__filter button").removeClass("active");
    $(this).addClass("active");

    if (marca === "") {
      $(".beer-container").show();
    } else {
      $(".beer-container").hide();
      $(".beer-" + marca).show();
    }
  });
});
