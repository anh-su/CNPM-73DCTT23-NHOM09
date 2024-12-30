<?php

class Home extends controller
{

    function Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'Home_v'
        ]);
    }
    function student()
    {
        $this->view('Masterlayout_student', [
            'page' => 'Home_student_v'
        ]);
    }


    function teacher()
    {
        $this->view('Masterlayout_teacher', [
            'page' => 'Home_teacher_v'
        ]);
    }
}
