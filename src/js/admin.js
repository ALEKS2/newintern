// modals
const supervisor_modal = document.querySelector("#supervisor-modal");
const student_modal = document.querySelector("#student-modal");

// modal triggers
const supervisor_modal_trigger = document.querySelector("#add-supervisor-toggler");
const student_modal_trigger = document.querySelector("#add-student-toggler");

// overlay
const overlay = document.querySelector("#admin-overlay");

// modal closers
const close_supervisor_modal = document.querySelector("#close-supervisor-modal");
const close_student_modal = document.querySelector("#close-student-modal");

// student excell form trigger
const student_excel_form_trigger = document.querySelector("#student-excel-trigger");

// student excell form
const student_excel_form = document.querySelector("#student-excel-form");

// supervisor excel form plus trigger and Supervisor normal form
const supervisor_excel_form = document.querySelector("#supervisor-excel-form"),
      supervisor_excel_form_trigger = document.querySelector("#supervisor-excel-trigger"),
      supervisor_normal_form = document.querySelector("#supervisor-form");

// student normal form
const student_normal_form = document.querySelector("#student-form");
let overlayClicked = () => {
    overlay.classList.add("d-none");
    if(!supervisor_modal.classList.contains("d-none")){
        supervisor_modal.classList.add("d-none");
    }
    if(!student_modal.classList.contains("d-none")){
        student_modal.classList.add("d-none");
    }
}

let closeSupervisorModal = () => {
    overlay.classList.add("d-none");
    supervisor_modal.classList.add("d-none");
}
let closeStudentModal = () => {
    overlay.classList.add("d-none");
    student_modal.classList.add("d-none");
}
let triggerSupervisorModal = () => {
    if(overlay.classList.contains("d-none")){
        overlay.classList.remove("d-none");
    }
    supervisor_modal.classList.remove("d-none");
    if(!student_modal.classList.contains("d-none")){
        student_modal.classList.add("d-none");
    }
}
let triggerStudentModal = () => {
    if(overlay.classList.contains("d-none")){
        overlay.classList.remove("d-none");
    }
    student_modal.classList.remove("d-none");
    if(!supervisor_modal.classList.contains("d-none")){
        supervisor_modal.classList.add("d-none");
    }
}

let studentExcelTriggered = () => {
    if(!student_normal_form.classList.contains("d-none")){
        student_normal_form.classList.add("d-none");
    }
    if(student_excel_form.classList.contains("d-none")){
        student_excel_form.classList.remove("d-none");
    }
    if(!student_excel_form_trigger.classList.contains("d-none")){
        student_excel_form_trigger.classList.add("d-none");
    }

}

let supervisorExcelTriggered = () => {
	if(!supervisor_normal_form.classList.contains("d-none")){
		supervisor_normal_form.classList.add("d-none");
    }
    if(supervisor_excel_form.classList.contains("d-none")){
    	supervisor_excel_form.classList.remove("d-none");
    }
    if(!supervisor_excel_form_trigger.classList.contains("d-none")){
    	supervisor_excel_form_trigger.classList.add("d-none");
    }
}
overlay.addEventListener("click", overlayClicked, false);
close_supervisor_modal.addEventListener("click", closeSupervisorModal, false);
close_student_modal.addEventListener("click", closeStudentModal, false);
supervisor_modal_trigger.addEventListener("click", triggerSupervisorModal, false);
student_modal_trigger.addEventListener("click", triggerStudentModal, false);
student_excel_form_trigger.addEventListener("click", studentExcelTriggered, false);
supervisor_excel_form_trigger.addEventListener("click", supervisorExcelTriggered, false);