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
class LoanMod extends CI_Model {
    //put your code here
    public function newLoanInsert($data)
    {
     
        if($this->db->insert('tblloanac',$data))
        {
            return true;
        }  
        
    }
    
     public function newLoanEdit($data,$getid)
    {
     
                    $this->db->set($data); 
                    $this->db->where("acno", $getid); 
                    if($this->db->update("tblloanac",$data))
                    {
                        return TRUE;
                    }

        
    }
        
     public function newLoanDeactive($data,$acno)
        {
            $this->db->set($data);
            $this->db->where("acno",$acno);
            $this->db->update("tblloanac",$data);
           
        }
        
        public function insertIntrest($data)
        {
            $this->db->insert("tblloantra",$data);
        }
        
         public function  DepLoan_tblloantra($traData)
        {
     
            if($this->db->insert('tblloantra',$traData))
            {
                return true;
            }  
        
        }
        
        public function addInt_tblloanac($dataTblloanac,$acno)
    {
        
       // $this->db->query("update tblfdac set interest = interest + $amount where acno = $acno");
       $this->db->set($dataTblloanac); 
                    $this->db->where("acno", $acno); 
                    if($this->db->update("tblloanac",$dataTblloanac))
                    {
                        return TRUE;
                    }
   
          
    }
    
    
}
