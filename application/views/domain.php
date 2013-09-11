    <link rel="stylesheet" href="<?php echo base_url();?>jquery-ui-1.8.1.custom/css/custom-theme/jquery-ui-1.8.1.custom.css">
    <script src="<?php echo base_url();?>jquery-ui-1.8.1.custom/js/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		$('#baten').click(function(){
			$('#new').html('');
			var alamat = $(this).parents().attr('href');
			$('#new').load(alamat);
			$('#new').dialog('destroy');
			$('#new').dialog({
			
			modal : true,
			height :380,
			width : 500,
			title : "New Domain",
			});
			return false;
		});
		
      <?php
      	for($a=0;$a<count($id);$a++){
      ?>
		$('#edt<?php echo $id[$a];?>').click(function(){
			$('#new').html('');
			var alamat = $(this).parents().attr('href');
			$('#new').load(alamat);
			$('#new').dialog('destroy');
			$('#new').dialog({
			
			modal : true,
			height :380,
			width : 500,
			title : "Edit Domain",
			});
			return false;
		});
		<?php
        }
        ?>
	});
</script>
<div id="new"></div>

    <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Domain</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span></li>
            <li class="active">Domain</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    <a href="<?php echo base_url();?>admin/newDomain/<?php echo $totpage;?>">
		<button class="btn btn-primary" id="baten"><i class="icon-plus"></i> New Domain</button>
	</a>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Domain</th>
          <th>Status</th>
          <th style="width: 26px;"></th>
        </tr>
      </thead>
      <tbody>
      <?php
      	for($i=0;$i<count($id);$i++){
      ?>
        <tr>
          <td><?php echo ($i+1)+(($page-1)*10);?></td>
          <td><?php echo ".".$domain[$i];?></td>
          <td><?php echo $status[$i];?></td>
          <td>
              <a href="<?php echo base_url();?>admin/editDomain/<?php echo $id[$i]."/".$page;?>"><i class="icon-pencil" id="edt<?php echo $id[$i];?>"></i></a>
              <a href="<?php echo base_url();?>admin/delDomain/<?php echo $id[$i];?>" role="button" onClick="return confirm('Are you really want to remove this data?');"><i class="icon-remove"></i></a>
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
       		echo "<li><a href=\"".base_url()."admin/domain/$i\">".$i."</a></li>";
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



