const Edufunctions = require('./edufunctions.js');

/**
 * lesson 1
 * ===========================================================================
 */
    let first_lesson_marksp1 = document.querySelectorAll(".l1p1btn"),
        first_lesson_marksp2 = document.querySelectorAll(".l1p2btn"),
        first_lesson_marksp3 = document.querySelectorAll(".l1p3btn"),
        first_lesson_marksp4 = document.querySelectorAll(".l1p4btn"),
        first_lesson_total_marks = document.querySelector("#l1marks");

    let firstLesonMarkClickedp1 = (event, first_lesson_mark) => {
        first_lesson_marksp1.forEach((element) => {
        Edufunctions.deactivate(element, first_lesson_total_marks);
        });
        
        Edufunctions.activate(first_lesson_mark, first_lesson_total_marks);
    }

    let firstLesson_marksp2Clicked = (event, element) => {
        first_lesson_marksp2.forEach((mark_element) => {
            Edufunctions.deactivate(mark_element, first_lesson_total_marks);
        });

        Edufunctions.activate(element, first_lesson_total_marks);
    }

    let firstLessonMarksp3Clicked = (event, element) => {
        first_lesson_marksp3.forEach((mark_element) => {
            Edufunctions.deactivate(mark_element, first_lesson_total_marks);
        });
        Edufunctions.activate(element, first_lesson_total_marks);
    }

    let firstLessonMarksp4Clicked = (event, element) => {
        first_lesson_marksp4.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, first_lesson_total_marks);
        });
        Edufunctions.activate(element, first_lesson_total_marks);
    }


    // add a click event listener to the buttons in lesson one paragraph one
    first_lesson_marksp1.forEach((first_lesson_mark) => {
        first_lesson_mark.addEventListener("click", (event)=> {
            firstLesonMarkClickedp1(event, first_lesson_mark);
        } , false);
    });

    // add a click event listener to the buttons in lesson one paragraph two
    first_lesson_marksp2.forEach((element) => {
        element.addEventListener("click", (event) => {
            firstLesson_marksp2Clicked(event, element);
        }, false);
    });
    // add a click event listener to the buttons in lesson one paragraph three
    first_lesson_marksp3.forEach((element) => {
        element.addEventListener("click", (event) => {
            firstLessonMarksp3Clicked(event, element);
        }, false);
    });
    // add a click event listener to the buttons in lesson one paragraph four
    first_lesson_marksp4.forEach((element) => {
        element.addEventListener("click", (event) => {
            firstLessonMarksp4Clicked(event, element);
        }, false);
    });

/**
 * Second Lesson
 * =========================================================================
 */
    const second_lesson_marksp1 = document.querySelectorAll(".l2p1btn"),
        second_lesson_marksp2 = document.querySelectorAll(".l2p2btn"),
        second_lesson_marksp3 = document.querySelectorAll(".l2p3btn"),
        second_lesson_marksp4 = document.querySelectorAll(".l2p4btn"),
        second_lesson_marksp5 = document.querySelectorAll(".l2p5btn"),
        second_lesson_total_marks = document.querySelector("#l2marks");
    
    const secondLessonMarksp1Clicked = (event, element) => {
        second_lesson_marksp1.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, second_lesson_total_marks);
        });

        Edufunctions.activate(element, second_lesson_total_marks);
    }

    const secondLessonMarksp2Clicked = (event, element) => {
        second_lesson_marksp2.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, second_lesson_total_marks);
        });

        Edufunctions.activate(element, second_lesson_total_marks);
    }

    const secondLessonMarksp3Clicked = (event, element) => {
        second_lesson_marksp3.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, second_lesson_total_marks);
        });

        Edufunctions.activate(element, second_lesson_total_marks);
    }

    const secondLessonMarksp4Clicked = (event, element) => {
        second_lesson_marksp4.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, second_lesson_total_marks);
        });

        Edufunctions.activate(element, second_lesson_total_marks);
    }

    const secondLessonMarksp5Clicked = (event, element) => {
        second_lesson_marksp5.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, second_lesson_total_marks);
        });

        Edufunctions.activate(element, second_lesson_total_marks);
    }




    // add a click event listener to the buttons in lesson two paragraph one
    second_lesson_marksp1.forEach(element => {
        element.addEventListener("click", event => {
            secondLessonMarksp1Clicked(event, element);
        }, false);
    });
    // add a click event listener to the buttons in lesson two paragraph two
    second_lesson_marksp2.forEach(element => {
        element.addEventListener("click", event => {
            secondLessonMarksp2Clicked(event, element);
        }, false);
    });
    // add a click event listener to the buttons in lesson two paragraph three
    second_lesson_marksp3.forEach(element => {
        element.addEventListener("click", event => {
            secondLessonMarksp3Clicked(event, element);
        }, false);
    });
    // add a click event listener to the buttons in lesson two paragraph four
    second_lesson_marksp4.forEach(element => {
        element.addEventListener("click", event => {
            secondLessonMarksp4Clicked(event, element);
        }, false);
    });
    // add a click event listener to the buttons in lesson two paragraph four
    second_lesson_marksp5.forEach(element => {
        element.addEventListener("click", event => {
            secondLessonMarksp5Clicked(event, element);
        }, false);
    });

/**
 * Lesson 3
 * ================================================================
 */
    const third_lesson_marksp1 = document.querySelectorAll(".l3p1btn"),
          third_lesson_marksp2 = document.querySelectorAll(".l3p2btn"),
          third_lesson_marksp3 = document.querySelectorAll(".l3p3btn"),
          third_lesson_marksp4 = document.querySelectorAll(".l3p4btn"),
          third_lesson_total_marks = document.querySelector("#l3marks");


    
    const thirdLessonMarksp1Clicked = (event, element)=> {
        third_lesson_marksp1.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, third_lesson_total_marks);
        });
        Edufunctions.activate(element, third_lesson_total_marks)
    }

    const thirdLessonMarksp2Clicked = (event, element)=> {
        third_lesson_marksp2.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, third_lesson_total_marks);
        });
        Edufunctions.activate(element, third_lesson_total_marks)
    }
    
    const thirdLessonMarksp3Clicked = (event, element)=> {
        third_lesson_marksp3.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, third_lesson_total_marks);
        });
        Edufunctions.activate(element, third_lesson_total_marks)
    }

    const thirdLessonMarksp4Clicked = (event, element)=> {
        third_lesson_marksp4.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, third_lesson_total_marks);
        });
        Edufunctions.activate(element, third_lesson_total_marks)
    }


    // add a click event listener to the elements of the third lesson paragraph one
    third_lesson_marksp1.forEach(element => {
        element.addEventListener("click", event => {
            thirdLessonMarksp1Clicked(event, element);
        }, false);
    });   
    // add a click event listener to the elements of the third lesson paragraph two
    third_lesson_marksp2.forEach(element => {
        element.addEventListener("click", event => {
            thirdLessonMarksp2Clicked(event, element);
        }, false);
    });
    
    // add a click event listener to the elements of the third lesson paragraph three
    third_lesson_marksp3.forEach(element => {
        element.addEventListener("click", event => {
            thirdLessonMarksp3Clicked(event, element);
        }, false);
    });   

    // add a click event listener to the elements of the third lesson paragraph four
    third_lesson_marksp4.forEach(element => {
        element.addEventListener("click", event => {
            thirdLessonMarksp4Clicked(event, element);
        }, false);
    });   

/**
 * Lesson 4
 * ================================================================================================
 */
    const lesson_four_marksp1 = document.querySelectorAll(".l4p1btn"),
        lesson_four_marksp2 = document.querySelectorAll(".l4p2btn"),
        lesson_four_marksp3 = document.querySelectorAll(".l4p3btn"),
        lesson_four_marksp4 = document.querySelectorAll(".l4p4btn"),
        lesson_four_marksp5 = document.querySelectorAll(".l4p5btn"),
        lesson_four_total_marks = document.querySelector("#l4marks");

    const lessonFourMarksp1Clicked = (event, element)=> {
        lesson_four_marksp1.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_four_total_marks);
        });
        Edufunctions.activate(element, lesson_four_total_marks)
    }

    const lessonFourMarksp2Clicked = (event, element)=> {
        lesson_four_marksp2.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_four_total_marks);
        });
        Edufunctions.activate(element, lesson_four_total_marks)
    }

    const lessonFourMarksp3Clicked = (event, element)=> {
        lesson_four_marksp3.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_four_total_marks);
        });
        Edufunctions.activate(element, lesson_four_total_marks)
    }
    const lessonFourMarksp4Clicked = (event, element)=> {
        lesson_four_marksp4.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_four_total_marks);
        });
        Edufunctions.activate(element, lesson_four_total_marks)
    }
    const lessonFourMarksp5Clicked = (event, element)=> {
        lesson_four_marksp5.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_four_total_marks);
        });
        Edufunctions.activate(element, lesson_four_total_marks)
    }


    // add a click event listener to the elements of lesson four paragraph one
    lesson_four_marksp1.forEach(element => {
        element.addEventListener("click", event => {
            lessonFourMarksp1Clicked(event, element);
        }, false);
    });  
    // add a click event listener to the elements of lesson four paragraph two
    lesson_four_marksp2.forEach(element => {
        element.addEventListener("click", event => {
            lessonFourMarksp2Clicked(event, element);
        }, false);
    });  
    // add a click event listener to the elements of lesson four paragraph three
    lesson_four_marksp3.forEach(element => {
        element.addEventListener("click", event => {
            lessonFourMarksp3Clicked(event, element);
        }, false);
    });  
    // add a click event listener to the elements of lesson four paragraph four
    lesson_four_marksp4.forEach(element => {
        element.addEventListener("click", event => {
            lessonFourMarksp4Clicked(event, element);
        }, false);
    });  
    // add a click event listener to the elements of lesson four paragraph five
    lesson_four_marksp5.forEach(element => {
        element.addEventListener("click", event => {
            lessonFourMarksp5Clicked(event, element);
        }, false);
    });  

/**
 * Lesson 5
 * ====================================================================================
 */
    const lesson_five_marksp1 = document.querySelectorAll(".l5p1btn"),
      lesson_five_marksp2 = document.querySelectorAll(".l5p2btn"),
      lesson_five_marksp3 = document.querySelectorAll(".l5p3btn"),
      lesson_five_marksp4 = document.querySelectorAll(".l5p4btn"),
      lesson_five_marksp5 = document.querySelectorAll(".l5p5btn"),
      lesson_five_total_marks = document.querySelector("#l5marks");

    const lessonFiveMarksp1Clicked = (event, element)=> {
        lesson_five_marksp1.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_five_total_marks);
        });
        Edufunctions.activate(element, lesson_five_total_marks)
    }

    const lessonFiveMarksp2Clicked = (event, element)=> {
        lesson_five_marksp2.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_five_total_marks);
        });
        Edufunctions.activate(element, lesson_five_total_marks)
    }
    const lessonFiveMarksp3Clicked = (event, element)=> {
        lesson_five_marksp3.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_five_total_marks);
        });
        Edufunctions.activate(element, lesson_five_total_marks)
    }
    const lessonFiveMarksp4Clicked = (event, element)=> {
        lesson_five_marksp4.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_five_total_marks);
        });
        Edufunctions.activate(element, lesson_five_total_marks)
    }
    const lessonFiveMarksp5Clicked = (event, element)=> {
        lesson_five_marksp5.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_five_total_marks);
        });
        Edufunctions.activate(element, lesson_five_total_marks)
    }
    
    
      // add a click event listener to the elements of lesson five paragraph one
    lesson_five_marksp1.forEach(element => {
        element.addEventListener("click", event => {
            lessonFiveMarksp1Clicked(event, element);
        }, false);
    });
     // add a click event listener to the elements of lesson five paragraph two
     lesson_five_marksp2.forEach(element => {
        element.addEventListener("click", event => {
            lessonFiveMarksp2Clicked(event, element);
        }, false);
    });
     // add a click event listener to the elements of lesson five paragraph three
     lesson_five_marksp3.forEach(element => {
        element.addEventListener("click", event => {
            lessonFiveMarksp3Clicked(event, element);
        }, false);
    });
     // add a click event listener to the elements of lesson five paragraph four
     lesson_five_marksp4.forEach(element => {
        element.addEventListener("click", event => {
            lessonFiveMarksp4Clicked(event, element);
        }, false);
    });
     // add a click event listener to the elements of lesson five paragraph five
     lesson_five_marksp5.forEach(element => {
        element.addEventListener("click", event => {
            lessonFiveMarksp5Clicked(event, element);
        }, false);
    });  

/**
 * Lesson 6
 * ==============================================================================
 */
    const lesson_six_marksp1 = document.querySelectorAll(".l6p1btn"),
          lesson_six_marksp2 = document.querySelectorAll(".l6p2btn"),
          lesson_six_marksp3 = document.querySelectorAll(".l6p3btn"),
          lesson_six_marksp4 = document.querySelectorAll(".l6p4btn"),
          lesson_six_marksp5 = document.querySelectorAll(".l6p5btn"),
          lesson_six_total_marks = document.querySelector("#l6marks");

    const lessonSixMarksp1Clicked = (event, element)=> {
        lesson_six_marksp1.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_six_total_marks);
        });
        Edufunctions.activate(element, lesson_six_total_marks)
    }
    const lessonSixMarksp2Clicked = (event, element)=> {
        lesson_six_marksp2.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_six_total_marks);
        });
        Edufunctions.activate(element, lesson_six_total_marks)
    }
    const lessonSixMarksp3Clicked = (event, element)=> {
        lesson_six_marksp3.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_six_total_marks);
        });
        Edufunctions.activate(element, lesson_six_total_marks)
    }
    const lessonSixMarksp4Clicked = (event, element)=> {
        lesson_six_marksp4.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_six_total_marks);
        });
        Edufunctions.activate(element, lesson_six_total_marks)
    }
    const lessonSixMarksp5Clicked = (event, element)=> {
        lesson_six_marksp5.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_six_total_marks);
        });
        Edufunctions.activate(element, lesson_six_total_marks)
    }
    
    // add a click event listener to the elements of lesson six paragraph one
    lesson_six_marksp1.forEach(element => {
        element.addEventListener("click", event => {
            lessonSixMarksp1Clicked(event, element);
        }, false);
    });

    // add a click event listener to the elements of lesson six paragraph two
    lesson_six_marksp2.forEach(element => {
        element.addEventListener("click", event => {
            lessonSixMarksp2Clicked(event, element);
        }, false);
    });

    // add a click event listener to the elements of lesson six paragraph three
    lesson_six_marksp3.forEach(element => {
        element.addEventListener("click", event => {
            lessonSixMarksp3Clicked(event, element);
        }, false);
    });

    // add a click event listener to the elements of lesson six paragraph four
    lesson_six_marksp4.forEach(element => {
        element.addEventListener("click", event => {
            lessonSixMarksp4Clicked(event, element);
        }, false);
    });

    // add a click event listener to the elements of lesson six paragraph five
    lesson_six_marksp5.forEach(element => {
        element.addEventListener("click", event => {
            lessonSixMarksp5Clicked(event, element);
        }, false);
    });


/**
 * Lesson 7
 */
    const lesson_seven_marksp1 = document.querySelectorAll(".l7p1btn"),
          lesson_seven_marksp2 = document.querySelectorAll(".l7p2btn"),
          lesson_seven_marksp3 = document.querySelectorAll(".l7p3btn"),
          lesson_seven_total_marks = document.querySelector("#l7marks");

    const lessonSevenMarksp1Clicked = (event, element)=> {
        lesson_seven_marksp1.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_seven_total_marks);
        });
        Edufunctions.activate(element, lesson_seven_total_marks)
    }
    const lessonSevenMarksp2Clicked = (event, element)=> {
        lesson_seven_marksp2.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_seven_total_marks);
        });
        Edufunctions.activate(element, lesson_seven_total_marks)
    }
    const lessonSevenMarksp3Clicked = (event, element)=> {
        lesson_seven_marksp3.forEach(mark_element => {
            Edufunctions.deactivate(mark_element, lesson_seven_total_marks);
        });
        Edufunctions.activate(element, lesson_seven_total_marks)
    }


   // add a click event listener to the elements of lesson seven paragraph one
    lesson_seven_marksp1.forEach(element => {
        element.addEventListener("click", event => {
            lessonSevenMarksp1Clicked(event, element);
        }, false);
    });

    // add a click event listener to the elements of lesson seven paragraph two
    lesson_seven_marksp2.forEach(element => {
        element.addEventListener("click", event => {
            lessonSevenMarksp2Clicked(event, element);
        }, false);
    });

    // add a click event listener to the elements of lesson seven paragraph three
    lesson_seven_marksp3.forEach(element => {
        element.addEventListener("click", event => {
            lessonSevenMarksp3Clicked(event, element);
        }, false);
    });

/**
 * final marks
 */
  const final = document.querySelector("#marks");

  const windowChanged = () => {
      let lesson1 = parseInt(first_lesson_total_marks.value),
          lesson2 = parseInt(second_lesson_total_marks.value),
          lesson3 = parseInt(third_lesson_total_marks.value),
          lesson4 = parseInt(lesson_four_total_marks.value),
          lesson5 = parseInt(lesson_five_total_marks.value),
          lesson6 = parseInt(lesson_six_total_marks.value),
          lesson7 = parseInt(lesson_seven_total_marks.value);
      let sum = lesson1 + lesson2 + lesson3 + lesson4 + lesson5 + lesson6 + lesson7;
      final.value = sum;
  }

  window.addEventListener("click", windowChanged, false);