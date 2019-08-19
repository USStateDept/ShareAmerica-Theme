// Subscribe button functionality
document.addEventListener("DOMContentLoaded",function() {

    //Get the footer contaner
    const td_footer_wrapper = document.getElementById("td-outer-wrap").getElementsByClassName("td-footer-wrapper")[0]; // The root toggled header menu for mobile

    //Find the Subscibe btn for desktop/tablet menu via traversing down from mobile header menu root -- Works all languages
    const td_top_mobile_toggle = document.querySelector('#td-top-mobile-toggle'); // root toggled header menu for mobile
    const td_header_menu = document.getElementById('td-header-menu'); // root ID for header menu
    const menu_newspaper_taxonomy = td_header_menu.getElementsByTagName('div')[2].childNodes[0]; // main UL for header menu
    const subscribe_btn = menu_newspaper_taxonomy.getElementsByClassName('menu-item-subscribe')[0]; // Subscribe button
    const language_btn = menu_newspaper_taxonomy.getElementsByClassName('menu-item-language')[0]; // Subscribe button 

    //Find the Subscibe btn for mobile menu menu via traversing down from mobile menu root -- Works all languages
    const td_mobile_nav = document.querySelector('#td-mobile-nav'); // The root toggled header menu for mobile
    const td_mobile_container = td_mobile_nav.getElementsByClassName('td-mobile-container')[0]; // The root ID for header menu
    const td_mobile_content = td_mobile_container.getElementsByClassName('td-mobile-content')[0]; // The root ID for header menu
    const menu_newspaper_taxonomy_mobile = td_mobile_content.getElementsByTagName('div')[0].childNodes[0]; // The main UL for header menu
    const subscribe_btn_mobile = menu_newspaper_taxonomy_mobile.getElementsByClassName('menu-item-subscribe')[0]; // Subscribe button

    /* Get the necessary elements */
    const td_header_sp_logo = td_header_menu.parentNode.getElementsByClassName('td-header-sp-logo')[0]; // The root toggled header menu for mobile
    console.log(td_header_sp_logo.nodeName);
  
    /* Create and add functionality to subscribe menu collapse-button */
    //Place arrow to collapse the Subscribe Menu
    td_footer_wrapper.innerHTML += '<i class="td-icon-menu-down arrow-collapse"></i>'; 
    const td_footer_arrow = document.getElementById("td-outer-wrap").getElementsByClassName("arrow-collapse")[0];
  
    //Remove class that will collapse Subscribe Menu
    td_footer_arrow.addEventListener("click", ()=> {
      td_footer_wrapper.classList.remove("subscribeActive"); 
    });
  
    //Subscribe btn function
    const setSubscribe = ()=> {
        td_footer_wrapper.style.display = 'inline-block';
        td_footer_wrapper.classList.add("subscribeActive");
        let td_top_mobile_style = getComputedStyle(td_top_mobile_toggle, null).getPropertyValue("display");
        td_top_mobile_style !== "none" ?  document.getElementById("td-mobile-nav").getElementsByClassName("td-mobile-close")[0].getElementsByTagName("a")[0].click() : console.log("") ; 
    };

    /* Add functionality to Subscribe button */
    //Subscribe btn functionality for Tablet/Desktop
    subscribe_btn.addEventListener("click", (e)=> {
      e.preventDefault();
      setSubscribe();
    });

    //Subscribe btn functionality for Mobile
    subscribe_btn_mobile.addEventListener("click", (e)=> {
        e.preventDefault();
        setSubscribe();
    });

    // Place the Subscribe and Language button as a block to conform to browser screen scrolling and resize
    const setUL = () => {
      let ww = window.innerWidth;
      console.log(ww);
      let td_header_sp_logo_styled = getComputedStyle(td_header_sp_logo, null).getPropertyValue("display");

      if (td_header_sp_logo_styled == "none" && ww > 1016 && ww < 1140) {
        subscribe_btn.classList.remove("menu-item-subscribe-position");
        language_btn.classList.remove("menu-item-language-current"); 
      } else if (td_header_sp_logo_styled == "block")  {
        subscribe_btn.classList.add("menu-item-subscribe-position");
        language_btn.classList.add("menu-item-language-current");
      }
    };
    setUL();
  
    //Set header menu UL when scrolling 
    window.addEventListener('scroll', setUL, false)
    window.addEventListener('resize', setUL, false)
  
  });