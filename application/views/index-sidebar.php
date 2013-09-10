
    


    
    <div class="sidebar-nav">
        <form class="search form-inline">
            <input type="text" placeholder="Search...">
        </form>

        
            <?php 
            if($admin){	
            ?>
            <a href="<?php echo base_url();?>admin/members" class="nav-header"><i class="icon-dashboard"></i>Members</a>
            <a href="<?php echo base_url();?>admin/domain" class="nav-header"><i class="icon-dashboard"></i>Domain</a>
            <?php
            }else
            	{
            ?>        
			<a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>
        	<ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><a href="<?php echo base_url();?>">Home</a></li> 
            </ul>
            
            <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Account<span class="label label-info">+2</span></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
        <?php if(!$log){?>
            <li ><a href="<?php echo base_url();?>app/formLogin">Sign In</a></li>
            <li ><a href="<?php echo base_url();?>app/signUp">Sign Up</a></li>
            <?php }else{?>
            <li><a href="<?php echo base_url();?>app/editMember">Profile</a></li>
            <li ><a href="<?php echo base_url();?>app/resetPwd">Reset Password</a></li>
            <?php }?>
        </ul>
            <?php
            }
            ?>
            
        

        

    </div>
    

    
