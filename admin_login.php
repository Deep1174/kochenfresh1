<!doctype html>
<html>
<head>
<!-- Meta -->
<meta charset="utf-8">
<META name="robots" content="index,follow">
<META name="author" content="">
<META name="copyright" content="Copyright 2016">
<META name="description" content="">
<META name="keywords" content="">
<meta name="revisit-after" content="7 days" />
<title> Kochen Fresh </title>
<!-- Mobile Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1" user-scalable="no">
<!-- Favicons -->
<link rel="shortcut icon" href="<?= base_url()?>images/favicon.ico">
<link rel="apple-touch-icon" href="<?= base_url()?>img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url()?>img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url()?>img/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url()?>img/apple-touch-icon-144x144.png">
<!-- Web Fonts  -->
<!-- CSS -->
<link rel="stylesheet" href="<?= base_url()?>css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>css/bootstrap.min.css"/>
<link href="<?= base_url()?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?= base_url()?>css/style.css" rel="stylesheet" type="text/css">
    
</head>
<body>
		<div id="wrapper">
        	<div class="outer">
            	<div class="middle">
                	<div class="inner">
                    	<div class="login-container">
                        	<div class="login-logo"> <img src="<?php base_url()?>/KochenFresh/images/logo.png"  alt=""> </div>
                            	<div class="login-form">
                                <p>Admin Login </p>
                            	<form action="<?php echo base_url()?>Login/save" method="POST" >
              								  <?php if($this->session->flashdata('fail')!=''){ ?>
                                	<div class="alert alert-danger"><?=$this->session->flashdata('fail')?>
                                  </div>
              								  <?php } ?>
                                	<div class="form-group ">
                                  	<div class="input-icon">
                                      <i class="fa fa-user" aria-hidden="true"></i>

                                 		 <input type="email" class="form-control" id="email" name="email" placeholder="Username" data-validation="email" data-validation-error-msg="Please Enter Email">
                                       </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="input-icon">
                                       <i class="fa fa-lock" aria-hidden="true"></i>
                                       <input type="Password" class="form-control" id="Password" name="Password" placeholder="Password" data-validation="required" data-validation-error-msg="Please Enter Password">
                                       </div>
                                  </div>

                                  <div class="form-group">
                                  	<label style="display:block; padding-bottom:5px;">Captcha</label>
                                  	<div class="input-icon">
                                 		 <input type="text" class="form-control" id="captcha" name="captcha" autocomplete="off" placeholder="Enter Captcha Code Shown below" data-validation="required" data-validation-error-msg="Please Enter Capcha">
                                    </div>
                                  </div>

                                  <div class="clearfix"></div>
            											<div class="captch-bg"><!--your capcha code is:-->
                                    <span style="color:green"><?php echo $rand_number = rand(1000,100000);?></span>
                                  </div>
            											<input type="hidden" name="capcha_code" value="<?=$rand_number ?>">
            											<input type="hidden" name="super_admin" value="admin">
                                                   
                									 <div class="clearfix"></div>
                									<div class="form-group btn-login">
                                    <input name="" type="submit" value="Login" class=" btn yellow btn-radius" style="display:block; width:100%;">
                                    <div class="clearfix"></div>
                                  </div>
                                  <!--<div class="forgot-password"><a href="#">Forgot your password?</a></div>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   <script>
   function get_year(obj)
	{
		 var comp_id = $(obj).val();
			   var url = "<?= base_url() ?>Login/get_financial_year";
			   $.ajax({
              method:"POST",
              url:url,
              dataType:'json',
              data: {'comp_id':comp_id},
			  
              success: function (data, textStatus, jqXHR){
				  $('#year').html('');
				  var html = '<option value="">Select financial year</option>';
				
                if(data.length>0)
				{
					
					for(var i=0; i<data.length; i++)
					{
						 html+='<option value="'+data[i].year_id+'">'+data[i].year_name+'</option>';
					}
					
					
				}
				 $('#year').html(html);
              }
            });
	}
</script>   
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script>
    $.validate({
        lang: 'en'
    });
	
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
    $(".alert-success").delay(2000).fadeOut(2000);
    $(".alert-danger").delay(2000).fadeOut(2000);
    });
  </script>

</body>
</html>
