function valForm(){
var googleResponse = jQuery('#g-recaptcha-response').val();
    if (!googleResponse) {
        jQuery("#error_captcha").show();
        return false;
    } else {
        return true;
    }
}

var correctCaptcha = function (response){
    var googleResponse = jQuery('#g-recaptcha-response').val();
    if (!googleResponse) {
        jQuery("#error_captcha").show();
    } else {            
        jQuery("#error_captcha").hide();
    }
};