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
class FdMod extends CI_Model {
    //put your code here
    public function newFdInsert($data)
    {
     
        if($this->db->insert('tblfdac',$data))
        {
            return true;
        }  
        
    }
    
     public function newFdEdit($data,$getid)
    {
     
                    $this->db->set($data); 
                    $this->db->where("acid", $getid); 
                    if($this->db->update("tblfdac",$data))
                    {
                        return TRUE;
                    }

        
    }
    
    
         public function newFdDeactive($data,$acno)
        {
            $this->db->set($data);
            $this->db->where("acno",$acno);
            $this->db->update("tblfdac",$data);
           
        }

        
        
    public function addAmount_tblfdac($dataTblfdac,$amount,$acno)
    {
        
        $this->db->query("update tblfdac set amount = amount + $amount where acno = $acno");
       $this->db->set($dataTblfdac); 
                    $this->db->where("acno", $acno); 
                    if($this->db->update("tblfdac",$dataTblfdac))
                    {
                       // return TRUE;
                    }
   
          
    }
    public function addInt_tblfdac($dataTblfdac,$acno)
    {
        
       // $this->db->query("update tblfdac set interest = interest + $amount where acno = $acno");
       $this->db->set($dataTblfdac); 
                    $this->db->where("acno", $acno); 
                    if($this->db->update("tblfdac",$dataTblfdac))
                    {
                        return TRUE;
                    }
   
          
    }
    
    
    public function subAmount_tblfdac($amount,$inte,$acno)
    {
        
        $this->db->query("update tblfdac set amount = amount - $amount,interest = interest - $inte where acno = $acno");
        {
        return true;
        }
    }
    
    public function  DepFd_tblfdtra($traData)
   {
     
        if($this->db->insert('tblfdtra',$traData))
        {
            return true;
        }  
        
    } 
    
    
    public function newLastAmount($amount,$acno)
    {
        $this->db->where("acno",$acno);
        $this->db->update("tblfdac",$amount);
    }
    
    
    public function changeLastamt($tid,$lastamt)
    {
        
        $this->db->where("tid",$tid);
        $this->db->update("tblfdtra",$lastamt);
             
    }
    
    public function changeDateIntamt($tid,$dateamt)
    {
        $this->db->where("tid",$tid);
        $this->db->update("tblfdtra",$dateamt);
    }
    
}
