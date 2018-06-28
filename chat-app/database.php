<?php

/**
 * 
 */
class database 
{

	var $link;
	
	function __construct()
	{
		
	//$this->link = mysqli_connect("localhost", "root","","chatapp");
		$this->link =  mysqli_connect("http://sql213.epizy.com", "epiz_20770907","DXDJXgSHpu","epiz_20770907_reactApp");;
	if (!$this->link) 
	{
    echo "Error: Unable to connect to MySQL.";
    echo "Debugging errno: " . mysqli_connect_errno();
    echo "Debugging error: " . mysqli_connect_error();
    exit;
				}
	

	}



public function query($sql)
{
    	
                                        
		$result=mysqli_query($this->link, $sql);
                
     if(!$result)
        {

        	 echo "query_error:".$sql; 
    		die("eror".mysqli_error($this->link));
		}
    return $result;
                    
}

	public function __destruct()
	{

		mysqli_close($this->link);
	}

}



?>