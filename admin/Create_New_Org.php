
<?php  include('header.php'); ?>
<?php include('session.php');
	$status = FALSE;
if ( authorize($_SESSION["access3"]["sConfig"]["asi"]["create"]) || 
authorize($_SESSION["access3"]["sConfig"]["asi"]["edit"]) || 
authorize($_SESSION["access3"]["sConfig"]["asi"]["view"]) || 
authorize($_SESSION["access3"]["sConfig"]["asi"]["delete"]) ) {
 $status = TRUE;
}
 ?>

 <?php include('admin_slidebar.php'); ?>
    <?php include('navbar.php');
	if ($status === FALSE) {
//die("You dont have the permission to access this page");
message("You don't have the permission to access this page", "error");
		        redirect('./'); 
} ?>
  <?php $get_RegNo = isset($_GET['id']) ? $_GET['id'] : ''; ?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
<div class="title_left">
<h3>New School Configuration
</h3>
</div>
</div><div class="clearfix"></div>
          

            <div class="row">
              <div class="col-md-12">
                
				 <!-- /Organization Setup Form -->
				
					<?php 
					$num=$get_RegNo;
				if (!empty($get_RegNo)){include('editCompany.php');}else{ include('addCompany.php'); }?>
				
                   <!-- /Organization Setup Form End -->
                 
                  
                  
                </div>
              </div>
            </div>



             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php
													$user_query = mysqli_query($condb,"select * from schoolsetuptd")or die(mysqli_error($condb));
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['id'];
													?>
                    <h2> Edit Company Configuration</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                  
                    </p>
                    <form action="Delete_school.php" method="post">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                    <?php   if (authorize($_SESSION["access3"]["sConfig"]["asi"]["delete"])){ ?>
                    	<a data-placement="right" title="Click to Delete check item"   data-toggle="modal" href="#Delete_school" id="delete"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show');
									 $('#delete').tooltip('hide');
									 });
									</script><?php } ?>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                         <th></th>
                          <th>School Name</th>
                          <th>Initial</th>
                          <th>Address</th>
                          <th>Office Phone</th>
                          <th>State</th>
                          <th>Web Address</th>
                          <th>Date Of Last Update</th>
                          <th>Action</th>
                        </tr>
                      </thead>
<tbody>
                        <tr>
                        	<td width="30">
												<input id="optionsCheckbox" class="uniform_on1" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
                          <td><?php echo $row['SchoolName']; ?></td>
                          <td><?php echo $row['initial']; ?></td>
                          <td><?php echo $row['Address']; ?></td>
                          <td><?php echo $row['OfficePhone']; ?></td>
                          <td><?php echo $row['State']; ?></td>
                          <td><?php echo $row['WebAddress']; ?></td>
                          <td><?php echo $row['DateCreated']; ?></td>
                          	<td width="120">  <?php   if (authorize($_SESSION["access3"]["sConfig"]["asi"]["edit"])){ ?>
												<a rel="tooltip"  title="Edit School Details" id="<?php echo $id; ?>" href="Create_New_Org.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="fa fa-pencil icon-large"> Edit Record</i></a><?Php } ?>
												</td>
                        </tr>
                     
                     
                      
                      
                      
                      
                      
                       
                       
                       
                      
                      
                      
                        <?php } ?>
                      </tbody>
                      	</form>
                    </table>
                  </div>
                </div>
              </div>



            
            
          </div>
        </div>
        <!-- /page content -->
        
  
         <?php include('footer.php'); ?>