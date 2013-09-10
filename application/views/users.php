
    <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Members</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span></li>
            <li class="active">Users</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Username</th>
          <th style="width: 26px;"></th>
        </tr>
      </thead>
      <tbody>
      <?php
      //print_r($usr);
      	for($i=0;$i<count($id);$i++){
      ?>
        <tr>
          <td><?php echo ($i+1)+(($page-1)*10);?></td>
          <td><?php echo $first_name[$i];?></td>
          <td><?php echo $last_name[$i];?></td>
          <td><?php echo $usr[$i];?></td>
          <td>
              <a href="user.html"><i class="icon-pencil"></i></a>
              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
</div>
<div class="pagination">
<font color="red"></font>
    <ul>    
    <?php for($i=1;$i<=$totpage;$i++){
    	if($i==$page)
    		echo "<li><a><font color='black'>".$i."</font></a></li>";
    	else
       		echo "<li><a href=\"".base_url()."admin/members/$i\">".$i."</a></li>";
        
     } ?>
    </ul>
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



