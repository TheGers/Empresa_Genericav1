<?php 

	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}	
        
    public function getTotales($table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE status = 1";
        return $this->select($sql);
    }

    
	}
 ?>