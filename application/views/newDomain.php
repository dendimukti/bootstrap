    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>BlackTieAdmin/build/lib/bootstrap/css/bootstrap.css">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>BlackTieAdmin/build/stylesheets/theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>BlackTieAdmin/build/lib/font-awesome/css/font-awesome.css">

<script>
	$(document).ready(function(){		
		$('#domain').keyup(function(){
			var domain = $('#domain').val();
			if(domain==""){
				document.getElementById("submit").disabled=true;
			}else{
				document.getElementById("submit").disabled=false;
			}
		});
	});
</script>
<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Add New Domain</p>
            <div class="block-body">
				<?php				
		        echo form_open('admin/addDomain');
				?>
                    <label>Name Domain</label>
                    <input type="text" class="span12" name="domain" id="domain">                  
                    <input type="hidden" name="page" id="page" value="<?php echo $page;?>">                  
                    <input type="submit" value="Add" class="btn btn-primary pull-right" name="submit" id="submit" disabled="">
                    <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

