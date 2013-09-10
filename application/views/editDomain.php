    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>BlackTieAdmin/build/lib/bootstrap/css/bootstrap.css">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>BlackTieAdmin/build/stylesheets/theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>BlackTieAdmin/build/lib/font-awesome/css/font-awesome.css">

<script>
	$(document).ready(function(){
		$('#domain').keyup(function(){
			var domain = $('#domain').val();
			var status = $('#status').val();
			if(domain=="" || status==""){
				document.getElementById("submit").disabled=true;
			}else{
				document.getElementById("submit").disabled=false;
			}
		})
		
		$('#status').keypress(function (data){
			if(data.which==8 || data.which==0 || data.which==13 || (data.which>=48 && data.which<=57)){				
				}
			else return false;		
		})
		
		$('#status').keyup(function(){			
			var domain = $('#domain').val();
			var status = $('#status').val();
			if(domain=="" || status==""){
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
            <p class="block-heading">Edit Domain</p>
            <div class="block-body">
				<?php				
		        echo form_open('admin/procEditDomain');
				?>
                    <label>Edit Domain</label>
                    <input type="text" class="span12" name="domain" id="domain" value="<?php echo $domain[0];?>">
                    <input type="text" class="span12" name="status" id="status" value="<?php echo $status[0];?>" maxlength="1">   
                    <input type="hidden" name="id" value="<?php echo $id[0];?>">
                    <input type="hidden" name="page" value="<?php echo $page;?>">
                    <input type="submit" value="Edit" class="btn btn-primary pull-right" name="submit" id="submit">
                    <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

