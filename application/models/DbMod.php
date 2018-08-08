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
class DbMod extends CI_Model {
    //put your code here
    public function traRojmel($dbdata)
    {
     
        if($this->db->insert('tblrojmel',$dbdata))
        {
            return true;
        }  
        
    }
    public function traDepDraw($traData)
    {
     
        if($this->db->insert('tbldrawtra',$traData))
        {
            return true;
        }  
        
    } 
    
    public function dataRojmel($first_date,$second_date){
        
        //echo 'db model';
        //$this->db->where("date BETWEEN $first_date AND $second_date");

            //return $this->db->get('tblrojmel');
             $query=$this->db->query("select * from tblrojmel where (date>='".$first_date."' and date<='".$first_date."') order by date,rid desc");
             return $query->result();
    }
              
    public function  traDepSaving($traData)
   {
     
        if($this->db->insert('tblsavingtra',$traData))
        {
            return true;
        }  
        
    } 
    
    public function traDepSavingAddDep($amount,$acno)
    {
        
        $this->db->query("update tblsavingac set amount = amount + $amount where acno = $acno");
        {
        return true;
        }
        
       }
    
    
    public function traDepSavingSubWith($amount,$acno)
    {
        
        $this->db->query("update tblsavingac set amount = amount - $amount where acno = $acno");
        {
        return true;
        }
    }
    
     public function  traWithLoan($traData)
   {
     
        if($this->db->insert('tblloantra',$traData))
        {
            return true;
        }  
        
    } 
    
    public function setLoanIntDate($remDate,$intDate,$acno)
    {
         $this->db->query("update tblloanac set remDate='$remDate' , intdate='$intDate' where acno = $acno" );
        {
        return true;
        }
    }
           
    public function updateIsPaidLoan($tid)
    {
         $this->db->query("update tblloantra set isPaid=1 where tid = $tid" );
        {
        return true;
        }
    }
        
}
