// js/custom-product-effects.js
jQuery(document).ready(function ($) {
  // Apply hue-rotate effect on product image when the page is loaded
  $(".woocommerce-product-gallery__image").each(function () {
    // Get the current hue-rotate value or set a default value
    var currentHueRotate = $(this).data("hue-rotate") || 0;

    // Increase the hue-rotate value by 30 degrees
    var newHueRotate = (currentHueRotate + 30) % 360;

    // Apply the new hue-rotate value and store it in the data attribute
    console.log(currentHueRotate);
    // $(this)
    //   .css("filter", "hue-rotate(" + newHueRotate + "deg)")
    //   .data("hue-rotate", newHueRotate);
    const that = this;
    // console.log("test");
    setInterval(function () {
      $(that)
        .css({
          filter: "hue-rotate(" + newHueRotate + "deg)",
          transition: "filter 1000ms ease-in-out", // Add transition property
        })
        .data("hue-rotate", newHueRotate);
      newHueRotate += 30;
      if (newHueRotate > 360) {
        newHueRotate = 0;
      }
    }, 1000);
  });
});
