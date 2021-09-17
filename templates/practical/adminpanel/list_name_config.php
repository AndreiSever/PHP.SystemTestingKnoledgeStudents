<?php 
$EFabc = new EFabc();
global $db;
if ($EFabc->user->privateRoleOnly()){ 
if (!empty($EFabc->route->getId())){
	$result = mysqli_query($db,"SELECT * FROM student_group WHERE name=".$EFabc->route->getId()."")or die(mysql_error());
	$group_id=mysqli_fetch_array($result,MYSQLI_ASSOC);
	if (!empty($group_id['id'])){
?>


<div class="">
<div class="page-title">
              <div class="title_left">
                <h3><small></small></h3>
              </div>
              <div class="title_right">  
              </div>
            </div>
        </div>

            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php 
						echo $group_id['name']; 
					?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <div class="x_panelEdit" >
					</div>
					<br/>
					<div class="btn-group">
					 <span > <button class="btn btn-danger" onclick="deleteRowNameTest('datatable1','<?php  echo "/adminpanel/list_name_config_sql/"; ?>');return false;" ><span class="glyphicon glyphicon-remove" ></span> </button></span>
					</div>
					<br/>
                    <p class="text-muted font-13 m-b-30">  
                    </p>
					
                   <table id="datatable1" class="table table-striped table-bordered jambo_table bulk_action">
                      <thead>
                        <tr>
                          <th class="thCheckboxQuestion"></th>
						  <th class="thCheckboxQuestion" style="display: none;"></th>
                          <th >Название теста</th>
                        </tr>
                      </thead>

                      <tbody >
					  <?php
					$result = mysqli_query($db,"SELECT * FROM name_test WHERE id_group=".$group_id['id']." ")or die(mysql_error());
					if (mysqli_num_rows ($result) !== 0){
						while ($group=mysqli_fetch_array($result,MYSQLI_ASSOC)){
						echo    '<tr class="even pointer">
									  <td class="a-center ">
										  <input type="checkbox" class="flat" name="table_records">
									  </td>
									  <td style="display: none;">
										<span class="" style="display: inline;">'.$group['id'].'</span>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$group['name'].'</span>
									  </td>';
						?>			  
								</tr>
						<?php	}
                        }else{
							echo '<tr class="default">
								<td>		
								</td>
								<td>	
									Данные отсутствуют!
								</td>
							</tr>';
						}
					?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
<?php 
	 }else{
		 $EFabc->route->applyError();
		$EFabc->route->applyErrorCopy();
	 }
}else{
	$EFabc->route->applyError();
	$EFabc->route->applyErrorCopy();
						
	}
}	
?> 