<?php

class ListDo extends Controller{


    

    public function getlistDo(){
        
       
        $data= $this->model('ListCericetSoDoModel')->getdata($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }
}