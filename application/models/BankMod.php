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
class BankMod extends CI_Model {
    //put your code here
    public function newDrawInsert($data)
    {
     
        if($this->db->insert('tbldrawmaster',$data))
        {
            return true;
        }  
        
    }
    
     public function newDrawEdit($data,$getid)
    {
     
                    $this->db->set($data); 
                    $this->db->where("drawid", $getid); 
                    if($this->db->update("tbldrawmaster",$data))
                    {
                        return TRUE;
                    }

        
    }
    
    
    
    public function addUser($tbldata)
    {
            if( $this->db->insert('tbluser',$tbldata))
            {
                return TRUE;
            }
        }
    
        
     public function userEdit($data,$getid)
    {
     
                    $this->db->set($data); 
                    $this->db->where("uid", $getid); 
                    if($this->db->update("tbluser",$data))
                    {
                        return TRUE;
                    }

        
    }
    
    
    public function newDrawAcInsert($tbldata)
    {
            if( $this->db->insert('tbldrawac',$tbldata))
            {
                return TRUE;
            }
        }
        
        public function newDrawAcEdit($data,$getid)
    {
     
                    $this->db->set($data); 
                    $this->db->where("acid", $getid); 
                    if($this->db->update("tbldrawac",$data))
                    {
                        return TRUE;
                    }

        
    }
    
    

    public function getDepDrawName()
         {
             $query = $this->db->get('tbldrawmaster');
                 return $query->result();
          
        }
        
        public function getDepSavingName()
        {
              $query = $this->db->get_where('tblsavingac',array("isActive"=>'1'));
                 return $query->result();
          
        }
        
        public function getDepFdName()
        {
              $query = $this->db->get_where('tblfdac',array("isActive"=>'1'));
                 return $query->result();
          
        }
        
        public function getDepLoanName()
        {
              $query = $this->db->get_where('tblloanac',array("isActive"=>'1'));
                 return $query->result();
          
        }
        public function setActiveDraw($data,$did,$data1)
        {
            $this->db->set($data);
            $this->db->where("drawid",$did);
            $this->db->update("tbldrawmaster",$data);
            
             $this->db->set($data1);
            $this->db->where("drawid != ",$did);
            $this->db->update("tbldrawmaster",$data1);
            
            
            
            
            
        }
       
        public function newDrawDeactive($data,$acno)
        {
            $this->db->set($data);
            $this->db->where("acno",$acno);
            $this->db->update("tbldrawac",$data);
           
        }
}
