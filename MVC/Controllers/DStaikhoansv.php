<?php
class DStaikhoansv extends controller
{
    private $DStaikhoansv;

  
    function Get_data()
    {
        $this->view('Masterlayout',
        [
            'page' =>'DStaikhoansv'
        ]);
    }

}