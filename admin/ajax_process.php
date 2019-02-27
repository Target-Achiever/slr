<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') 
{

    require_once '../includes/class.query.php';
    $data = $_POST;

    if(!empty($data)) {

        // Table initialize
        $loan_table = new Query;
        $loan_table->access_table = "slr_user_loans";
        $select['select'] = array('user_loans_ela,user_loans_agi,user_family_size,user_state,user_email,user_mobile,user_ibr');
        $select['conditions'] = "user_loans_id = '".$data['loan_id']."'";
        $loan_data = $loan_table->select($select);
        if(!empty($loan_data)) {
            unset($loan_data['count']);
            echo json_encode(array('status'=>'true','data'=>$loan_data[0]));
        }
        else {
            echo json_encode(array('status'=>'false'));
        }
    }
}
else {
    echo "404";
}


