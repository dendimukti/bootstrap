
    <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Edit User</h1>
            
        </div>
        
                <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li><a href="users.html">Users</a> <span class="divider">/</span></li>
            <li class="active">User</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
      <li><a href="#edit" data-toggle="tab">Edit Profile</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="profile">
      	<label><b>Username</b></label>
        <input type="text" value="<?php echo $usr[0];?>" class="input-xlarge" readonly="">
        <label><b>First Name</b></label>
        <input type="text" value="<?php echo $first_name[0];?>" class="input-xlarge" readonly="">
        <label><b>Last Name</b></label>
        <input type="text" value="<?php echo $last_name[0];?>" class="input-xlarge" readonly="">
        <label><b>Email</b></label>
        <input type="text" value="<?php echo $email[0];?>" class="input-xlarge" readonly="">
        <label><b>Address</b></label>
        <textarea value="Smith" rows="3" class="input-xlarge" readonly=""><?php echo $address[0];?></textarea>    
      </div>
      <div class="tab-pane fade" id="edit">
        <?php				
		echo form_open('app/procEditMember');
	?>
        <label>Username</label>
        <input type="text" value="<?php echo $usr[0];?>" class="input-xlarge" name="username" readonly="">
        <label>First Name</label>
        <input type="text" value="<?php echo $first_name[0];?>" class="input-xlarge" name="first_name" maxlength="50">
        <label>Last Name</label>
        <input type="text" value="<?php echo $last_name[0];?>" class="input-xlarge" name="last_name" maxlength="50">
        <label>Email</label>
        <input type="text" value="<?php echo $email[0];?>" class="input-xlarge" name="email" maxlength="50">
        <label>Address</label>
        <textarea value="Smith" rows="3" class="input-xlarge" name="address"><?php echo $address[0];?></textarea>        
        <div class="btn-toolbar">
		    <input type="submit" value="Save" class="btn btn-primary" name="submit">
		    <input type="button" value="Reset" class="btn" name="reset" id="reset">
			  <div class="btn-group">
			  </div>
		</div>
    
      </div>
  </div>
<font color="red"><b><?php if(!empty($pesan)) echo $pesan;?></b></font>
</div>

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Delete Confirmation</h3>
  </div>
  <div class="modal-body">
    
    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-danger" data-dismiss="modal">Delete</button>
  </div>
</div>



