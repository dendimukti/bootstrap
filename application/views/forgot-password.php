<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $judul;?></title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>BlackTieAdmin/build/lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>BlackTieAdmin/build/stylesheets/theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>BlackTieAdmin/build/lib/font-awesome/css/font-awesome.css">

    <script src="<?php echo base_url();?>BlackTieAdmin/build/lib/jquery-1.7.2.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){		
		$('#email').keyup(function(){
			var email = $('#email').val();
			if(email==""){
				document.getElementById("submit").disabled=true;
			}else{
				document.getElementById("submit").disabled=false;
			}
		});
	});
</script>
    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url();?>BlackTieAdmin/build/lib/font-awesome/docs/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>BlackTieAdmin/build/lib/font-awesome/docs/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>BlackTieAdmin/build/lib/font-awesome/docs/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>BlackTieAdmin/build/lib/font-awesome/docs/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>BlackTieAdmin/build/lib/font-awesome/docs/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                </ul>
                <a class="brand" href="index.html"><span class="first">Your</span> <span class="second">Company</span></a>
        </div>
    </div>
    


    

    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Forgot your password ?<font color="red"><b><?php if(!empty($pesan)) echo "- ".$pesan;?></b></font></p>
            <div class="block-body">
                <?php				
		        echo form_open('app/procForgotPassword');
				?>
                    <label>Your Email</label>
                    <input type="text" class="span12" name="email" id="email">
                    <input type="submit" value="Send" class="btn btn-primary pull-right" name="submit" disabled="" id="submit">
                    <div class="clearfix"></div>
            </div>
            <p class="block-heading" align="left">
			We'll Send your password to your email
				
			</p>
        </div>
        <a href="<?php echo base_url()?>">Sign in to your account</a>
    </div>
</div>


    


    <script src="<?php echo base_url();?>BlackTieAdmin/build/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


