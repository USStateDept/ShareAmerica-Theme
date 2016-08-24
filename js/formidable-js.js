jQuery(window).load(function(){

  var frmClosed = getCookie('formidable-closed');

  if (frmClosed == null) {
    document.cookie = "formidable-closed=false; path=/";
    frmClosed = getCookie('formidable-closed');
  }

  if ( frmClosed == "false" ) {
    jQuery('.td-footer-wrapper .frm_form_fields fieldset').append("<i class='fa fa-times-circle-o formidable-close' aria-hidden='true'></i>");
    jQuery('.td-footer-wrapper').show();
  }
  
  jQuery('.formidable-close').click(function(){
    jQuery('.td-footer-wrapper').hide();
    document.cookie = "formidable-closed=true; path=/";
  });

});

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length >= 2) return parts.pop().split(";").shift();
}