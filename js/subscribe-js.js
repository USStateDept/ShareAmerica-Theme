// Subscribe button functionality
document.addEventListener("DOMContentLoaded", function() {
  /* Create and add functionality to subscribe menu collapse-button */
  // Get the footer container
  const footerWrapper = document.querySelector(".td-footer-wrapper");

  // Place arrow to collapse the Subscribe Menu
  footerWrapper.innerHTML += '<i class="td-icon-menu-down arrow-collapse"></i>';
  const footerArrow = document.querySelector(".arrow-collapse");

  // Remove class that will collapse Subscribe Menu
  footerArrow.addEventListener("click", () => {
    footerWrapper.classList.remove("subscribeActive");
  });

  //Subscribe btn function
  const topMobileToggle = document.getElementById("td-top-mobile-toggle");

  const setSubscribe = () => {
    footerWrapper.style.display = "inline-block";
    footerWrapper.classList.add("subscribeActive");
    const topMobileStyle = getComputedStyle(topMobileToggle).getPropertyValue(
      "display"
    );

    if (topMobileStyle !== "none") {
      document
        .querySelector(".td-mobile-close")
        .querySelector("a")
        .click();
    }
  };

  /* Add functionality to Subscribe button */
  //Subscribe btn functionality for Tablet/Desktop
  const subscribeBtn = document
    .querySelector(".sf-menu")
    .querySelector(".menu-item-subscribe");

  subscribeBtn.addEventListener("click", e => {
    e.preventDefault();
    setSubscribe();
  });

  //Subscribe btn functionality for Mobile
  const subscribeBtnMobile = document
    .querySelector(".td-mobile-main-menu")
    .querySelector(".menu-item-subscribe");

  subscribeBtnMobile.addEventListener("click", e => {
    e.preventDefault();
    setSubscribe();
  });

  // Place the Subscribe and Language button as a block to conform to browser screen scrolling and resize
  const spLogo = document.querySelector(".td-header-sp-logo");

  const languageBtn = document
    .querySelector(".sf-menu")
    .querySelector(".menu-item-language");

  const setUL = () => {
    const ww = window.innerWidth;
    const spLogoStyled = getComputedStyle(spLogo).getPropertyValue("display");

    if (spLogoStyled == "none" && ww > 1016 && ww < 1140) {
      subscribeBtn.classList.remove("menu-item-subscribe-position");
      languageBtn.classList.remove("menu-item-language-current");
    } else if (spLogoStyled == "block") {
      subscribeBtn.classList.add("menu-item-subscribe-position");
      languageBtn.classList.add("menu-item-language-current");
    }
  };
  setUL();

  //Set header menu UL when scrolling
  window.addEventListener("scroll", setUL, false);
  window.addEventListener("resize", setUL, false);
});
