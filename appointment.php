<?php

// Check the page is called by post method or not
if(empty($_POST)) {
   header('Location: index.php');
   exit;
}
else {
    $data = $_POST;
}

require_once 'includes/class.query.php';

// Table initialize
$user_loans = new Query;
$user_loans->access_table = "slr_user_loans";

$loan_scheme = new Query;
$loan_scheme->access_table = "slr_loan_scheme";

$currency_format = ['$',',',' '];
$actual_format = ['','',''];

$data['ela'] = str_replace($currency_format, $actual_format, $data['ela']);
$data['agi'] = str_replace($currency_format, $actual_format, $data['agi']);

// Get load scheme
$select['conditions'] = "annual_income = '".$data['agi']."'";
$select['select'] = array('loan_scheme');
$loan_schemes = $loan_scheme->select($select);

$selected_amount = 0;
if(!empty($loan_schemes)) {
    $loan_scheme_list = json_decode($loan_schemes[0]['loan_scheme'],true);
    $selected_amount = (!empty($loan_scheme_list[$data['family_size']])) ? $loan_scheme_list[$data['family_size']] : 0;
}

// Insert submitted data - loan
$user_insert_array = array('user_loans_ela'=>$data['ela'],'user_loans_agi'=>$data['agi'],'user_family_size'=>$data['family_size'],'user_state'=>$data['state'],'user_email'=>$data['email'],'user_mobile'=>$data['mobile'],'user_ibr'=>$selected_amount,'user_status'=>1);
$user_insert = $user_loans->insert(array('insert'=>$user_insert_array));

$user_loans_id = (!empty($user_insert['insert_id'])) ? $user_insert['insert_id'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student Loan Repayment</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Retina.js - Load first for faster HQ mobile images. -->
    <script src="assets/js/plugins/retina/retina.min.js"></script>
    <!-- Font Awesome -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Default Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- Plugin CSS -->
    <link href="assets/css/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="assets/css/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css">
    <link href="assets/css/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css">
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet" type="text/css">
    <link href="assets/css/plugins/background.css" rel="stylesheet" type="text/css">
    <link href="assets/css/plugins/animate.css" rel="stylesheet" type="text/css">    
    <link id="changeable-colors" rel="stylesheet" href="assets/css/style.css">   
    <!--For IE Browser-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type='text/javascript' src="<a class="vglnk" href="http://html5shiv.googlecode.com/svn/trunk/html5.js" rel="nofollow"><span>http</span><span>://</span><span>html5shiv</span><span>.</span><span>googlecode</span><span>.</span><span>com</span><span>/</span><span>svn</span><span>/</span><span>trunk</span><span>/</span><span>html5</span><span>.</span><span>js</span></a>"></script>
      <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->  
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!--For IE Browser-->
    <!-- IE8 support for HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        /* Added by siva */
        .appoint_col_content {
          color: #000;
        }
        .repayment {
          border-bottom: 1px solid #333;
        }
    </style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <section class="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <p>Welcome to our Student Loan - Counselors</p>
                </div>
                <div class="col-md-4">
                    <p class="text-right">(888) 339-1720</p>
                </div>
            </div>
        </div>
    </section>  
    <div class="hash_strip"></div>     
    <section class="appointment">
        <div class="container wow fadeIn">
            <div class="row">
                <div class="col-lg-12 text-center appoint_col_content">
                    <h3>Based off your Income & Family size</h3>
                    <p>You qualify for an Income based repayment of <b>$ <span class="repayment"> <?php echo $selected_amount; ?> </span> 
                        <!-- <input type="text" name="repayment" class="input-control" value="" readonly /> -->
                          /mo</b></p>
                    <!-- <div class="note">
                        <p class="text-left hint">**Note** </p>
                        <p class="text-tab">
                            For Development 
                        </p>
                    </div> -->
                    <div class="appoint_col2">
                        <p>To Speak with a Student Loan Counselor & Get Enrolled Today</p>
                        <a href="tel:8881234567" class="btn btn-outline-dark call-btn"><b><i class="fa fa-phone"></i> Call:(888) 339-1720</b></a>
                        <p>OR</p>
                    </div>                               
                </div>
            </div>
        </div> 
        <div class="container-fluid appoint-cols">   
            <div class="row">
                <div class="col-lg-12 text-center appoint_col_content1">
                    <h3>Set up an appointment</h3>
                </div>
            </div>
            <div class="divider1"></div>
            <div class="row content-row appointment-content">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" data-form='appointment' novalidate>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 control-group">
                                <input type="text" class="form-control numeric" placeholder="Enter Phone" id="phone" required data-validation-required-message="Please enter Phone Number" maxlength="15" autocomplete="off" />
                                <p class="help-block text-danger"></p>
                            </div>                            
                        </div>                        
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 control-group">                                
                                <input type="text" class="form-control" placeholder="First Name " id="fname" required data-validation-required-message="Please enter First Name" />
                                <p class="help-block text-danger"></p>
                            </div>                            
                        </div>  
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 control-group">                                
                                <input type="text" class="form-control" placeholder="Last Name" id="lname" required data-validation-required-message="Please enter Last Name" />
                                <p class="help-block text-danger"></p>
                            </div>                            
                        </div>   
						<div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 control-group">  								
                                <input type="text" class="form-control datepicker" placeholder="Appointment Date" id="date" required data-validation-required-message="Please select date" />
                                <p class="help-block text-danger"></p>
                            </div>                            
                        </div> 
						<div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 control-group">  								
                               <select class="form-control" id="time"  required data-validation-required-message="Please select time" >
									<option value="">Select Appointment Time</option>
									<option value="9:00 am EST">9:00 am EST</option>
									<option value="9:15 am EST">9:15 am EST</option>
									<option value="9:30 am EST">9:30 am EST</option>
									<option value="9:45 am EST">9:45 am EST</option>
									<option value="10:00 am EST">10:00 am EST</option>
									<option value="10:15 am EST">10:15 am EST</option>
									<option value="10:30 am EST">10:30 am EST</option>
									<option value="10:45 am EST">10:45 am EST</option>
									<option value="11:00 am EST">11:00 am EST</option>
									<option value="11:15 am EST">11:15 am EST</option>
									<option value="11:30 am EST">11:30 am EST</option>
									<option value="11:45 am EST">11:45 am EST</option>
									<option value="12:00 pm EST">12:00 pm EST</option>
									<option value="12:15 pm EST">12:15 pm EST</option>
									<option value="12:30 pm EST">12:30 pm EST</option>
									<option value="12:45 pm EST">12:45 pm EST</option>
									<option value="1:00 pm EST">1:00 pm EST</option>
									<option value="1:15 pm EST">1:15 pm EST</option>
									<option value="1:30 pm EST">1:30 pm EST</option>
									<option value="1:45 pm EST">1:45 pm EST</option>
									<option value="2:00 pm EST">2:00 pm EST</option>
									<option value="2:15 pm EST">2:15 pm EST</option>
									<option value="2:30 pm EST">2:30 pm EST</option>
									<option value="2:45 pm EST">2:45 pm EST</option>
									<option value="3:00 pm EST">3:00 pm EST</option>
									<option value="3:15 pm EST">3:15 pm EST</option>
									<option value="3:30 pm EST">3:30 pm EST</option>
									<option value="3:45 pm EST">3:45 pm EST</option>
									<option value="4:00 pm EST">4:00 pm EST</option>
									<option value="4:15 pm EST">4:15 pm EST</option>
									<option value="4:30 pm EST">4:30 pm EST</option>
									<option value="4:45 pm EST">4:45 pm EST</option>
									<option value="5:00 pm EST">5:00 pm EST</option>									
									<option value="5:15 pm EST">5:15 pm EST</option>									
									<option value="5:30 pm EST">5:30 pm EST</option>									
									<option value="5:45 pm EST">5:45 pm EST</option>									
									<option value="6:00 pm EST">6:00 pm EST</option>									
								</select>
                                <p class="help-block text-danger"></p>
                            </div>                            
                        </div>						
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12 text-center">
                                <button type="submit" class="btn btn-outline-dark">Confirm</button>
                            </div>
                        </div>
                        <input type="hidden" name="user_loans_id" id="user_loans_id" value="<?php echo $user_loans_id; ?>" />
                    </form>
                </div>
            </div>
        </div>
    </section> 
    <div class="hash_strip_white"></div>
     <section class="social">
        <div class="container">
            <div class="row contact_info">
                <div class="contact_content">
                    <div class="col-md-4 col-sm-4">
                        <div class="row">
                            <div class="col-sm-4 col-md-3">
                                <div class="contact_icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-9">
                                <p>(888) 339-1720</p>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 col-sm-4">
                        <div class="row">
                            <div class="col-sm-4 col-md-3">
                                <div class="contact_icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-9">
                                <p> support@loan-counselors.com</p>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 col-sm-4">
                        <div class="row">
                            <div class="col-sm-4 col-md-3">
                                <div class="contact_icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-9">
                                <p>(888) 339-1720</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="container">            
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <p>Follow Us</p>
                    <ul class="list-unstyled list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook" title="Facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter" title="Twitter"></i></a>
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-google-plus" title="Google Plus"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4">
                    <form class="newsletter" id="subscribers_form" method="post" action="#">
                        <p class="error_msg"></p>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 text-right">
                                <label >Subscribe to our Newsletter</label>
                                <input type="email" name="news" class="form-control" placeholder="Enter Email Address" id="email" />
                                <span class="send"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> 
    <section class="copy">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <p>Copyright &copy; 2018 Student Loan Repayment</p>
                </div>
                 <div class="col-md-4 col-sm-4 text-center">
                    <div class="row important_links">
                        <div class="col-md-6 col-sm-6">
                             <a href="#">Privacy policy</a>
                        </div>
                        <div class="col-md-6 col-sm-6">
                              <a href="#">Terms & Conditions</a>
                        </div>
                    </div>                 
                </div>
            </div>
        </div>
    </section>
    <!-- End Style Switcher -->
    <!-- Core Scripts -->
    <script src="assets/js/jquery.js"></script>
    <!-- <script type="text/javascript">
        $('html,body').animate({
            scrollTop: $(".appointment").offset().top},
        'slow');
    </script> -->
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugin Scripts -->
    <script src="assets/js/plugins/jquery.easing.min.js"></script>
    <script src="assets/js/plugins/classie.js"></script>
    <!-- <script src="assets/js/plugins/cbpAnimatedHeader.js"></script> -->
    <script src="assets/js/plugins/owl-carousel/owl.carousel.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/background/core.js"></script>
    <script src="assets/js/plugins/background/transition.js"></script>
    <script src="assets/js/plugins/background/background.js"></script>
    <script src="assets/js/plugins/jquery.mixitup.js"></script>
    <script src="assets/js/plugins/wow/wow.min.js"></script>
    <script src="assets/js/contact_me.js"></script>
    <script src="assets/js/plugins/jqBootstrapValidation.js"></script>
    <!-- Vitality Theme Scripts -->
    <script src="assets/js/vitality.js"></script> 
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	  $( function() {		
		$( ".datepicker" ).datepicker({ minDate: 0, dateFormat: 'yy-mm-dd' });
	  } );
	</script>	
</body>

</html>
