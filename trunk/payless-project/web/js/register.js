var usernameError = document.getElementById("usernameError");
var nameError = document.getElementById("nameError");
var passwordError = document.getElementById("passwordError");
var cpasswordError = document.getElementById("cpasswordError");
var emailError = document.getElementById("emailError");
var birthError = document.getElementById("birthError");
var genderError = document.getElementById("genderError");
var avatarError = document.getElementById("avatarError");
var formName = "registerForm";
var invalidColor = 'rgba(255,0,0,0.5)';
var validColor = 'white';

DisableSubmitButton();

function DisableSubmitButton() {
    document.forms[formName]["signup"].style.backgroundColor = '#cccccc';
    document.forms[formName]["signup"].style.borderColor = '#eeeeee';
    document.forms[formName]["signup"].disabled = true;
}

function EnableSubmitButton() {
    document.forms[formName]["signup"].style.backgroundColor = '#0040db';
    document.forms[formName]["signup"].style.borderColor = '#00007d';
    document.forms[formName]["signup"].disabled = false;
}

function ValidateAll() {
    if (ValidateUsername() && 
        ValidatePassword() && 
        ValidateCPassword() &&
        ValidateName() &&
        ValidateEmail() &&
        ValidateBirthdate() &&
        ValidateGender() &&
        ValidateAvatar()) EnableSubmitButton();
    else DisableSubmitButton();
}

function ValidateUsername() {
    var uname = document.forms[formName]["username"].value;
    
    return (uname.length >= 5);
}

function ProcessUsername(obj) {
    if(!ValidateUsername()) {
        obj.style.backgroundColor = invalidColor;
        usernameError.style.display = 'block';
    } else {
        obj.style.backgroundColor = validColor;
        usernameError.style.display = 'none';
    }
    
    ValidateAll();
}

function ValidatePassword() {
    var uname = document.forms[formName]["username"].value;
    var upass = document.forms[formName]["password"].value;
    
    return (upass.length >= 8 && (upass != uname));
}

function ProcessPassword(obj) {
    if(!ValidatePassword()) {
        obj.style.backgroundColor = invalidColor;
        passwordError.style.display = 'block';
    } else {
        obj.style.backgroundColor = validColor;
        passwordError.style.display = 'none';
    }
    
    ValidateAll();
}

function ValidateCPassword() {
    var upass = document.forms[formName]["password"].value;
    var ucpass = document.forms[formName]["confirm"].value;
    
    return (ucpass == upass);
}

function ProcessCPassword(obj) {
    if(!ValidateCPassword()) {
        obj.style.backgroundColor = invalidColor;
        cpasswordError.style.display = 'block';
    } else {
        obj.style.backgroundColor = validColor;
        cpasswordError.style.display = 'none';
    }
    
    ValidateAll();
}

function ValidateEmail() {
    var pattern = /^[A-Za-z0-9_.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    return pattern.test(document.forms[formName]["email"].value);
}

function ProcessEmail(obj) {
    if(!ValidateEmail()) {
        obj.style.backgroundColor = invalidColor;
        emailError.style.display = 'block';
    } else {
        obj.style.backgroundColor = validColor;
        emailError.style.display = 'none';
    }
    
    ValidateAll();
}

function ValidateBirthdate() {
    var pattern = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
    return pattern.test(document.forms[formName]["birthdate"].value);
}

function ProcessBirthdate(obj) {
    if(!ValidateBirthdate()) {
        obj.style.backgroundColor = invalidColor;
        birthError.style.display = 'block';
    } else {
        obj.style.backgroundColor = validColor;
        birthError.style.display = 'none';
    }
    
    ValidateAll();
}

function ValidateGender() {
    return (document.forms[formName]["gender"].value!="none");
}

function ProcessGender(obj) {
    if(!ValidateGender()) {
        obj.style.backgroundColor = invalidColor;
        genderError.style.display = 'block';
    } else {
        obj.style.backgroundColor = validColor;
        genderError.style.display = 'none';
    }
    
    ValidateAll();
}

function ValidateAvatar() {
    var pattern = /^.+\.((jpg)|(jpeg))$/;
    return (document.forms[formName]["avatar"].value!="" && pattern.test(document.forms[formName]["avatar"].value));
}

function ProcessAvatar(obj) {
    if(!ValidateAvatar()) {
        obj.style.backgroundColor = invalidColor;
        avatarError.style.display = 'block';
    } else {
        obj.style.backgroundColor = validColor;
        avatarError.style.display = 'none';
    }
    
    ValidateAll();
}

function ValidateName() {
    var pattern = /^[A-Za-z]+ [A-Za-z ]+$/;
    return pattern.test(document.forms[formName]["name"].value);
}

function ProcessName(obj) {
    if(!ValidateName()) {
        obj.style.backgroundColor = invalidColor;
        nameError.style.display = 'block';
    } else {
        obj.style.backgroundColor = validColor;
        nameError.style.display = 'none';
    }
    
    ValidateAll();
}