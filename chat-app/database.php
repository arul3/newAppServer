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
				$this->link =  mysqli_connect("sql2.freemysqlhosting.net", "sql2245028","kL2%yU7*","sql2245028");
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