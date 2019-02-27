<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

    require_once 'includes/class.query.php';
    $data = $_POST;

    if(!empty($data)) {

        if($data['type'] == "appointment") {
            
            // Table initialize
            $appointment = new Query;
            $appointment->access_table = "slr_appointment";

            // Insert submitted data - loan
            $user_insert_array = array('user_mobile'=>$data['phone'],'user_firstname'=>$data['fname'],'user_lastname'=>$data['lname'],'user_loans_id'=>$data['user_loans_id'],'user_appointment_date'=>$data['date'],'user_appointment_time'=>$data['time']);
            $user_insert = $appointment->insert(array('insert'=>$user_insert_array));
            
            if($user_insert['status'] == "true") {

                // $mail_msg = file_get_contents("includes/templates/appointment_template.html");
                // $mail_sub = "Appointment";
                // $variables['phone'] = $data['phone'];
                // $variables['fname'] = $data['fname'];
                // $variables['lname'] = $data['lname'];

                // foreach($variables as $key => $value)
                // {
                //     $mail_msg = str_replace('{{'.$key.'}}', $value, $mail_msg);
                // }

                // $send_mail = $appointment->send_to_mail($data['phone'],$mail_sub,$mail_msg);

                // if($send_mail) {
                //      echo json_encode(array('status'=>'true','message'=>'Your appointment has been submitted. We will contact you soon.'));
                // }
                // else {
                //     echo json_encode(array('status'=>'false','message'=>"Email doesn't send due to slow internet connection."));
                // }

                echo json_encode(array('status'=>'true','message'=>'Your appointment has been submitted. We will contact you soon.'));
            }
            else {
                echo json_encode(array('status'=>'false','message'=>'Technical error. Please try again later.'));
            }
        }
        else {
            
            // Table initialize
            $subscribers = new Query;
            $subscribers->access_table = "slr_subscribers";

            $select['select'] = array('subscribers_id');
            $select['conditions'] = "user_email = '".$data['email']."'";
            $select_user = $subscribers->select($select);
            if(!empty($select_user)) {
                echo json_encode(array('status'=>'false','message'=>'Already subscribed'));
            }
            else {

                // Insert submitted data - loan
                $user_insert_array = array('user_email'=>$data['email']);
                $user_insert = $subscribers->insert(array('insert'=>$user_insert_array));
               
                if($user_insert['status'] == "true") {

                    $mail_msg = file_get_contents("includes/templates/subscriber_template.html");
                    $mail_sub = "Subscribers";
                    $variables['email'] = $data['email'];

                    foreach($variables as $key => $value)
                    {
                        $mail_msg = str_replace('{{'.$key.'}}', $value, $mail_msg);
                    }

                    $send_mail = $subscribers->send_to_mail($data['email'],$mail_sub,$mail_msg);

                    if($send_mail) {
                        echo json_encode(array('status'=>'true','message'=>'You have subscribed successfully'));
                    }
                    else {
                        echo json_encode(array('status'=>'false','message'=>'Technical error. Please try again later.'));
                    }
                }
                else {
                    echo json_encode(array('status'=>'false','message'=>'Technical error. Please try again later.'));
                }
            }
        }
    }
}
else {
    echo "404";
}


