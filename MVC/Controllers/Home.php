<?php

class Home extends controller
{

   

    function Get_data()
    {
        $this ->view('Trangchu');
    }
    function Gioithieu()
    {
        $this ->view('Gioithieu');
    }
    function Tintuc()
    {
        $this ->view('Tintuc');
    }
    function Thongbao()
    {
        $this ->view('Thongbao');
    }
    function Lienhe()
    {
        $this ->view('Lienhe');
    }

    function admin()
    {
        $this->view('Masterlayout', [
            'page' => 'Home_admin_v'
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
