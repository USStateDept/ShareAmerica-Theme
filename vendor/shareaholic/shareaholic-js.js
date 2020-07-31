const createDownloadBtn = () => {
    /*  The inner contents of download button */
    let shareDownloadInner = '<div class="shareaholic-share-button-container shr-outline" aria-label="Download to Device" tabindex="0" role="button">';
    shareDownloadInner += '<div class="shareaholic-share-button-sizing " style="">';
    shareDownloadInner += '<a class="shareaholic-service-icon shareaholic-service-default" style=""></a>';
    shareDownloadInner += '<span class="shr-share-button-verb" style="color:#fff!important">Download</span>';
    shareDownloadInner += '</div>';
    shareDownloadInner += '</div>';

    /* Create Download Button and add class, attributes, innerHTML, styles */
    let shareDownloadBtn = document.createElement("LI");
    shareDownloadBtn.classList.add("shareaholic-share-button");
    shareDownloadBtn.setAttribute("style", "display:list-item;padding: 0 0 5px 0 !important; opacity: 1;");
    shareDownloadBtn.setAttribute("title", "Download");
    shareDownloadBtn.innerHTML = shareDownloadInner;
    
    /* Create style for download button...FontAwesome icon */
    let downloadBtnStyle = document.createElement("style");
    let css = '.shareaholic-share-button[title=Download] a.shareaholic-service-icon:before {font-family: "FontAwesome" !important; content: " \u005c\u0066019" !important;}';
    downloadBtnStyle.innerHTML = css;

    /* Add link to Button */
    const downloadBtnRef = () => {
        let shareImgCurrentSRC = document.querySelector(".shareaholic-media-target-hover-state").src;
        window.location.href = 'http://share.dev.local/wp-content/themes/shareamerica/vendor/shareaholic/imgretrieve.php?src=' + shareImgCurrentSRC;
    }
    
    /* Wait for Shareaholic API then append created download button */
    let findUL = setInterval(function(){ 
        ulShareList = document.querySelector(".shareaholic-share-buttons");
        if (typeof(ulShareList) != 'undefined' && ulShareList != null) {
            ulShareList.appendChild(shareDownloadBtn);
            shareDownloadBtn.addEventListener("click", function() {
                downloadBtnRef();
            });
            ulShareList.appendChild(downloadBtnStyle);
            clearInterval(findUL);
        }
    }, 3000);
}

/* Loop through images turning on/off sharing by removing "data" attribute */
const imgLoop = () => {
    let imgShareCount = 0;

    let imgs = document.querySelectorAll("img");
    imgs.forEach(function (item) {
        if (item.classList.contains("shareable")) {
            item.removeAttribute("data-pin-nopin");
            imgShareCount++;
            if (imgShareCount == 1) {
                createDownloadBtn();
                console.log("Done");
            }
        } else {
            item.setAttribute("data-pin-nopin", "true");
        }
    });
}

imgLoop();