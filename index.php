<?php
require_once 'includes/class.query.php';

$loan_scheme = new Query;
$loan_scheme->access_table = "slr_loan_scheme";

// Get load scheme
$select['conditions'] = "loans_id!=0";
$select['select'] = array('annual_income');
$loan_schemes = $loan_scheme->select($select);

$loan_schemes_data = array();
if(!empty($loan_schemes)) {
    unset($loan_schemes['count']);
    $loan_schemes_data = $loan_schemes;
}

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
		video {
			width: 100%;
			height: 100%;
			cursor: pointer;
		}
		/*.playpause {
			background-image:url('assets/img/play.png');
			background-repeat:no-repeat;
			width:50%;
			height:50%;
			position:absolute;
			left:0%;
			right:0%;
			top:0%;
			bottom:0%;
			margin:auto;
			background-position: center;
			cursor: pointer;
		}*/
    </style>
</head>
<body>
    <section class="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <p>Welcome to our Student Loan - Counselors</p>
                </div>
                <div class="col-md-4 col-sm-4">
                    <p class="text-right">(888) 339-1720</p>
                </div>
            </div>
        </div>
    </section>
    <!-- <header class="video" data-video-options="muted: false">        
    </header> -->
	<!-- <video width="100%" height="auto" style="object-fit:fill;" autoplay loop>
	  <source src="assets/video/loan.mp4" type="video/mp4">
	</video> -->

    <div id="container" class="wrapper">
        <video id="video_block" class="video" loop="" controls>
            <source src="assets/video/loan.mp4" type="video/mp4">
        </video>
        <div class="playpause hidden-xs"></div>
    </div>	
    <div class="hash_strip"></div>   
    <section class="get-started">
        <div class="container wow fadeIn">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Get Started Below</h3>                   
                </div>
            </div>
            <div class="row content-row get-started-content">
                <div class="col-lg-12">
                    <form method="post" name="sentMessage" id="contactForm" action="appointment.php" novalidate>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6 col-md-6 control-group">
                                <input type="text" class="form-control numeric cost" placeholder="Estimated Loan Amount" id="amount" required data-validation-required-message="Please enter Estimated Loan Amount" name="ela" autocomplete="off" maxlength="20" />
                                <p class="help-block text-danger"></p>
                            </div>
                             <div class="form-group col-xs-12 col-sm-6 col-md-6 control-group">
                                <!-- <input type="text" class="form-control numeric cost" placeholder="Adjusted Gross Income(AGI)" id="agi" required data-validation-required-message="Please enter Adjusted Gross Income(AGI)" name="agi" autocomplete="off" maxlength="20" /> -->
                                <select class="form-control" id="agi" data-validation-required-message="Please enter Adjusted Gross Income(AGI)" name="agi" required>
                                    <option value=""> Adjusted Gross Income(AGI)</option>
                                    <option value="18000"> $0 - $18,000</option>
                                    <?php
                                    foreach ($loan_schemes as $value) {
                                        
                                        echo "<option value='".$value['annual_income']."'> $ ".number_format($value['annual_income'], 0,'.',',')." </option>";
                                    }
                                    ?>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6 col-md-6 control-group">   
                                <!-- <input type="text" class="form-control numeric" placeholder="Family Size / Number of Dependants" id="size" required data-validation-required-message="Please enter Family Size / Number of Dependants" name="family_size" autocomplete="off" maxlength="1" /> -->
                                <select class="form-control" id="size" data-validation-required-message="Please select Family Size / Number of Dependants" name="family_size" required>
                                    <option value=""> Please select family size</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>                           
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                             <div class="form-group col-xs-12 col-sm-6 col-md-6 control-group">
                                <input type="text" class="form-control" placeholder="State of Residency" id="state" required data-validation-required-message="Please enter State of Residency" name="state" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6 col-md-6 control-group">
                                <input type="email" class="form-control" placeholder="Email" id="email" required data-validation-required-message="Please enter Email" name="email" />
                                <p class="help-block text-danger"></p>
                            </div>
                             <div class="form-group col-xs-12 col-sm-6 col-md-6 control-group">
                                <input type="text" class="form-control numeric" placeholder="Phone number" id="size" required data-validation-required-message="Please enter Phone number" name="mobile" autocomplete="off" maxlength="15" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>                
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12 text-center">
                                <button type="submit" class="btn btn-outline-dark">Calculate My Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> 
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
                                <p>support@loan-counselors.com</p>
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
	    <script type="text/javascript">
        $(document).ready(function() {
            // var video = document.getElementById('video_block'); 
            // var isPlaying = video.currentTime > 0 && !video.paused && !video.ended && video.readyState > 2;
            // if (!isPlaying) {
            //   video.play();			  
            // }			
        });
    </script>

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
    <script src="assets/js/plugins/jquery.inputmask.bundle.js"></script>
    
    <script type="text/javascript">
        $('.cost').inputmask("numeric", {
            radixPoint: "",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '$ ', //Space after $, this will not truncate the first character.
            rightAlign: false,
        });
    </script>
    <!-- <script src="assets/js/plugins/jquery.vide.js"></script> -->
    <script src="assets/js/contact_me.js"></script>
    <script src="assets/js/plugins/jqBootstrapValidation.js"></script>
    
    <!-- Vitality Theme Scripts -->
    <script src="assets/js/vitality.js"></script> 
	
    </body>
</html>
