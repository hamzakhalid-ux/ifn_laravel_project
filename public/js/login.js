window.intlTelInputGlobals.loadUtils("../public/js/utils.js?1590403638580");

var mobile = document.querySelector("#mobile"),
    errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// initialise plugin
iti = window.intlTelInput(mobile, {
    initialCountry: 'pk',
    nummberType: 'mobile',
    preferredCountries: ["pk"],
    separateDialCode: true
});

var reset = function () {
    mobile.classList.remove("error");
    errorMsg.innerHTML = "Error";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
};

// on blur: validate
mobile.addEventListener('blur', function () {
    getOnBlur(mobile, iti , validMsg , errorMsg);
});


function getOnBlur(obj,iniObj , validObj , errorObj) {
    reset();
    if (obj.value.trim()) {
        if (iniObj.isValidNumber()) {
            validObj.classList.remove("hide");
        } else {
            obj.classList.add("error");
            var errorCode = iniObj.getValidationError();
            errorObj.innerHTML = errorMap[errorCode];
            errorObj.classList.remove("hide");
        }
    }
}
// on keyup / change flag: reset
mobile.addEventListener('change', reset);
mobile.addEventListener('keyup', reset);