
    


    
    <div class="sidebar-nav">
        <form class="search form-inline">
            <input type="text" placeholder="Search...">
        </form>

        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><a href="http://<?php echo base_url();?>">Home</a></li>
            <?php 
            if($admin){	
            ?>
            <li><a href="http://<?php echo base_url();?>index.php/admin/members">Members</a></li>
            <?php
            }
            if($log){
            ?>
            <li><a href="http://<?php echo base_url();?>index.php/app/editMember">Edit Account</a></li>
            <?php
            }
            ?>
            <li ><a href="media.html">Media</a></li>
            <li ><a href="calendar.html">Calendar</a></li>
            
        </ul>

        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Account<span class="label label-info"><?php echo ($log)?"+1":"+2";?></span></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
        <?php if(!$log){?>
            <li ><a href="http://<?php echo base_url();?>index.php/app/formLogin">Sign In</a></li>
            <li ><a href="http://<?php echo base_url();?>index.php/app/signUp">Sign Up</a></li>
            <?php }else{?>
            <li ><a href="http://<?php echo base_url();?>index.php/app/resetPwd">Reset Password</a></li>
            <?php }?>
        </ul>


        <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Legal</a>
        <ul id="legal-menu" class="nav nav-list collapse">
            <li ><a href="privacy-policy.html">Privacy Policy</a></li>
            <li ><a href="terms-and-conditions.html">Terms and Conditions</a></li>
        </ul>

        <a href="help.html" class="nav-header" ><i class="icon-question-sign"></i>Help</a>
        <a href="faq.html" class="nav-header" ><i class="icon-comment"></i>Faq</a>
    </div>
    

    
