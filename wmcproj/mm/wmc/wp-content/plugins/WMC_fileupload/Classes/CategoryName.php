<?php
class CategoryName
{
    const NO_CATEGORIES = 10;             // this must be increased if more categories is to be added
    public function No_of_Categories(){
        return self::NO_CATEGORIES;
    }    
    
    function document_kategori($intverdi) 
    {      
        if ($intverdi > $this->No_of_Categories())
            return null;

        switch ($intverdi)
        {
    	    case 0: return "Udefinert"; break;
    	    case 1: return "Sertifikat"; break;
    	    case 2: return "Epikrise"; break;
    	    case 3: return "Forsikring"; break;
    	    case 4: return "Journal"; break;
    	    case 5: return "Testamente"; break;
    	    case 6: return "Pass"; break;
    	    case 7: return "Resept"; break;
    	    case 8: return "Reisedokument"; break;
    	    case 9: return "Røntgen"; break;
    	    case 10: return "Annet"; break;
        }   // switch
   
    }
        
    function Kategori_number($CategoryName)
    {
        for ($c=1; $c<= $this->No_of_Categories(); $c++){
            if ($this->document_kategori($c) == $CategoryName)
                return($c);
        }
        return null;
    }
    
    function KategoriList()
    {
        $retarr=array();
        for ( $c=1; $c<=$this->No_of_Categories(); $c++){
            $retarr[]= $this->document_kategori($c);
        }
        return $retarr;
    }
    
}
        // NB! Oversetting

?>