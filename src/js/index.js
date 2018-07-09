// login triggers
const student_login_button = document.querySelector("#student");
const admin_login_button = document.querySelector("#admin");
const accademic_login_button = document.querySelector("#accademic");
const field_login_button = document.querySelector("#field");

// login forms
const student_login_form = document.querySelector("#student-form");
const admin_login_form = document.querySelector("#admin-form");
const accademic_login_form = document.querySelector("#college-supervisor-form");
const field_login_form = document.querySelector("#field-supervisor-form");

// login and register triggers
const login_trigger = document.querySelector("#login-trigger");
const register_trigger = document.querySelector("#register-trigger");

// overly element
const overlay = document.querySelector("#overlay");

// modal close buttons
const login_modal_close = document.querySelector("#login-close");
const reg_modal_close = document.querySelector("#reg-close");

// modals
const login_modal = document.querySelector("#login-modal");
const reg_modal = document.querySelector("#reg-modal");

// first login triggers
const first_field_login_trigger = document.querySelector("#field-first-login");
const first_accademic_login_trigger = document.querySelector("#accademic-first-login");

// first login form 
const first_field_login_form = document.querySelector("#field-form-2");
const first_accademic_login_form = document.querySelector("#accademic-form-2");


let studentClicked = () => {
    if(student_login_form.classList.contains("d-none")){
        student_login_form.classList.remove("d-none");
    }
    if(!student_login_button.classList.contains("active")){
        student_login_button.classList.add("active");
    }
    if(admin_login_button.classList.contains("active")){
        admin_login_button.classList.remove("active");
    }
    if(accademic_login_button.classList.contains("active")){
        accademic_login_button.classList.remove("active");
    }
    if(field_login_button.classList.contains("active")){
        field_login_button.classList.remove("active");
    }
    if(!admin_login_form.classList.contains("d-none")){
        admin_login_form.classList.add("d-none");
    }
    if(!accademic_login_form.classList.contains("d-none")){
        accademic_login_form.classList.add("d-none");
    }
    if(!field_login_form.classList.contains("d-none")){
        field_login_form.classList.add("d-none");
    }
    // first login forms
    if(!first_field_login_form.classList.contains("d-none")){
        first_field_login_form.classList.add("d-none");
    }
    if(!first_accademic_login_form.classList.contains("d-none")){
        first_accademic_login_form.classList.add("d-none");
    }
    // 
}

let adminClicked = () => {
    if(admin_login_form.classList.contains("d-none")){
        admin_login_form.classList.remove("d-none");
    }
    if(!admin_login_button.classList.contains("active")){
        admin_login_button.classList.add("active");
    }
    if(student_login_button.classList.contains("active")){
        student_login_button.classList.remove("active");
    }
    if(accademic_login_button.classList.contains("active")){
        accademic_login_button.classList.remove("active");
    }
    if(field_login_button.classList.contains("active")){
        field_login_button.classList.remove("active");
    }
    if(!student_login_form.classList.contains("d-none")){
        student_login_form.classList.add("d-none");
    }
    if(!accademic_login_form.classList.contains("d-none")){
        accademic_login_form.classList.add("d-none");
    }
    if(!field_login_form.classList.contains("d-none")){
        field_login_form.classList.add("d-none");
    }
    // first login forms
    if(!first_field_login_form.classList.contains("d-none")){
        first_field_login_form.classList.add("d-none");
    }
    if(!first_accademic_login_form.classList.contains("d-none")){
        first_accademic_login_form.classList.add("d-none");
    }
    // 
}


let fieldClicked = () => {
    if(field_login_form.classList.contains("d-none")){
        field_login_form.classList.remove("d-none");
    }
    if(!field_login_button.classList.contains("active")){
        field_login_button.classList.add("active");
    }
    if(student_login_button.classList.contains("active")){
        student_login_button.classList.remove("active");
    }
    if(accademic_login_button.classList.contains("active")){
        accademic_login_button.classList.remove("active");
    }
    if(admin_login_button.classList.contains("active")){
        admin_login_button.classList.remove("active");
    }
    if(!student_login_form.classList.contains("d-none")){
        student_login_form.classList.add("d-none");
    }
    if(!accademic_login_form.classList.contains("d-none")){
        accademic_login_form.classList.add("d-none");
    }
// first login forms
    if(!first_field_login_form.classList.contains("d-none")){
        first_field_login_form.classList.add("d-none");
    }
    if(!first_accademic_login_form.classList.contains("d-none")){
        first_accademic_login_form.classList.add("d-none");
    }
//
    if(!admin_login_form.classList.contains("d-none")){
        admin_login_form.classList.add("d-none");
    }
}

let accademicClicked = () => {
    if(accademic_login_form.classList.contains("d-none")){
        accademic_login_form.classList.remove("d-none");
    }
    if(!accademic_login_button.classList.contains("active")){
        accademic_login_button.classList.add("active");
    }
    if(student_login_button.classList.contains("active")){
        student_login_button.classList.remove("active");
    }
    if(field_login_button.classList.contains("active")){
        field_login_button.classList.remove("active");
    }
    if(admin_login_button.classList.contains("active")){
        admin_login_button.classList.remove("active");
    }
    if(!student_login_form.classList.contains("d-none")){
        student_login_form.classList.add("d-none");
    }
    // first login forms
    if(!first_field_login_form.classList.contains("d-none")){
        first_field_login_form.classList.add("d-none");
    }
    if(!first_accademic_login_form.classList.contains("d-none")){
        first_accademic_login_form.classList.add("d-none");
    }
    // 
    if(!admin_login_form.classList.contains("d-none")){
        admin_login_form.classList.add("d-none");
    }
    if(!field_login_form.classList.contains("d-none")){
        field_login_form.classList.add("d-none");
    }
}

let loginTrigger = () => {
   login_modal.classList.remove('d-none');
   overlay.classList.remove('d-none');
}
let regTrigger = () => {
    reg_modal.classList.remove('d-none');
    overlay.classList.remove('d-none');
}
let overlayClicked = () => {
    overlay.classList.add('d-none');
    if(!login_modal.classList.contains("d-none")){
        login_modal.classList.add('d-none');
    }
    if(!reg_modal.classList.contains("d-none")){
        reg_modal.classList.add('d-none');
    }
}
let closeLogin = () => {
    overlay.classList.add('d-none');
    login_modal.classList.add('d-none');
}
let closeReg = () => {
    overlay.classList.add('d-none');
    reg_modal.classList.add('d-none');
}
let firstFieldLogin = () => {
    field_login_form.classList.add("d-none");
    first_field_login_form.classList.remove("d-none");
}
let firstAccademicLogin = () => {
    accademic_login_form.classList.add("d-none");
    first_accademic_login_form.classList.remove("d-none");
}
student_login_button.addEventListener("click", studentClicked, false);
admin_login_button.addEventListener("click", adminClicked, false);
field_login_button.addEventListener("click", fieldClicked, false);
accademic_login_button.addEventListener("click", accademicClicked, false);

login_trigger.addEventListener("click", loginTrigger, false);
register_trigger.addEventListener("click", regTrigger, false);

overlay.addEventListener("click", overlayClicked, false);

login_modal_close.addEventListener("click", closeLogin, false);
reg_modal_close.addEventListener("click", closeReg, false);

first_field_login_trigger.addEventListener("click", firstFieldLogin, false);
first_accademic_login_trigger.addEventListener("click", firstAccademicLogin, false);