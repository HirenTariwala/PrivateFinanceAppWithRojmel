<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DrawDbMod
 *
 * @author admin
 */
class SavingMod extends CI_Model {
    //put your code here
    public function newSavingInsert($data)
    {
     
        if($this->db->insert('tblsavingac',$data))
        {
            return true;
        }  
        
    }
    
     public function newSavingEdit($data,$getid)
    {
                    $this->db->set($data); 
                    
                    //$this->db->where("acid", $getid); 
                    $this->db->where("acid", $getid); 
                    if($this->db->update("tblsavingac",$data))
                    {
                        return TRUE;
                    }

        
    }
 
    
    
     public function newSavingDeactive($data,$acno)
        {
            $this->db->set($data);
            $this->db->where("acno",$acno);
            $this->db->update("tblsavingac",$data);
           
        }
        
        
         public function changeTraDate($data,$tid)
        {        //     echo 'hii';
             //print_r($data);
             //echo $tid;
            $this->db->set($data);
            $this->db->where("tid",$tid);
        if($this->db->update("tblsavingtra",$data))
        {
            return TRUE;
        }
           
        }
}
