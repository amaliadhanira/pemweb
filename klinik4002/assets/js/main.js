jQuery(".form-control")
  .on("blur", function() {
    if (jQuery(this).val().length <= 0) {
      jQuery(this)
        .siblings("label")
        .removeClass("moveUp");
      jQuery(this).removeClass("outline");
    }
  })
  .on("focus", function() {
    if (jQuery(this).val().length >= 0) {
      jQuery(this)
        .siblings("label")
        .addClass("moveUp");
      jQuery(this).addClass("outline");
    }
  });
