<?php

require_once 'class.db.php';
require_once 'class.constants.php';

class Query extends Database
{

	public $access_table; 
		
	/* ===========      Insert query     ================ */
	public function insert($params) {

		$insert_keys   = array_keys($params['insert']);
		$insert_values = array_values($params['insert']);

		$sql = "INSERT INTO ".$this->access_table." (".implode(',', $insert_keys).") VALUES ('".implode("','", $insert_values)."')";
		$sql_result = mysqli_query($this->con, $sql);

		if($sql_result)
		{
			return array("status"=>"true", "insert_id"=>mysqli_insert_id($this->con));  
		}
		else
		{
			return array("status"=>"false");  
		}	
	}

	/* ============    Select query     ================= */
	public function select($params) 
	{
		$sort_order = '';
        $limit = '';
        $group_by = '';
        $row_data = array();
        $where_condition = $params['conditions'];

        // Sorting
        if(!empty($params['sort'])) {
            $sort_order .= 'ORDER BY ' . $params['sort'];
        }
        // Limit
        if(!empty($params['limit'])) {
            $limit .= 'LIMIT ' . $params['limit'];
        }
        // Group
        if(!empty($params['group'])) {
            $group_by .= 'GROUP BY ' . $params['group'];
        }
        // Query in String
        $sql = "SELECT ".implode(',', $params['select'])." FROM ".$this->access_table." WHERE $where_condition ".$sort_order." ".$limit." ".$group_by."";
		// Execute Query
		$sql_result = mysqli_query($this->con, $sql);
		if($sql_result->num_rows > 0)
		{
			while($row = mysqli_fetch_assoc($sql_result))
		 	{	
		 		// Fetch data
		 		$row_data[] = $row;
		 	}
		 	$row_data['count'] = $sql_result->num_rows;
		}

		return $row_data;	
	}

	/* ============    Send mail     ================= */
	public function send_to_mail($to, $subject, $message)
    {
	
	    require 'includes/phpmailer/PHPMailerAutoload.php';

        /* Configuration Parameters*/
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = ADMIN_EMAIL;
        $mail->Password = ADMIN_PASSWORD;
        $mail->IsHTML(true);
        $mail->setFrom(ADMIN_EMAIL, ADMIN_NAME);
        $mail_receiver = 'sivaramakannan.s@pickzy.com';
        $mail->addAddress($mail_receiver, "");
        $mail->Subject = $subject;
        $mail->Body = $message;
       
        return $mail->send() ? true : false;        //send the message, check for errors
            
    }

} // End class
?>