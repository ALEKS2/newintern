const deactivate = (element, lesson_total) => {
   if(element.classList.contains("btn-success")){
       let element_value = parseInt(element.value);
       let total = parseInt(lesson_total.value);
       let new_total = total - element_value;
       element.classList.remove("btn-success");
       lesson_total.value = new_total;
   }
}

const activate = (element, lesson_total) => {
   let total = null;
   if(lesson_total.value !== ''){
       total = parseInt(lesson_total.value);
   }else{
       total = 0;
   }
   let element_mark = parseInt(element.value);
   let new_total = total + element_mark;
   lesson_total.value = new_total;
   element.classList.add("btn-success");
}
module.exports = {
    deactivate, activate
}