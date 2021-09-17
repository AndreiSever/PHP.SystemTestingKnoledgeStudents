<?php 
$EFabc = new EFabc();
global $db;
if ($EFabc->user->privateRoleOnly()){ 
if (!empty($EFabc->route->getId())){
	$result = mysqli_query($db,"SELECT * FROM directions WHERE id=".$EFabc->route->getId()."")or die(mysql_error());
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
					<ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-linkEdit"><i class="fa fa-chevron-down"></i></a>
                      </li>
                    </ul>
						<div class="x_contentEdit" style="display: none;">
							<div class="form-inline">
								<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="name" placeholder = "Название" />
								<button class="btn btn-primary" onclick="addRowDirect('datatable1','<?php  echo "/adminpanel/sub_themes_sql/".$EFabc->route->getId(); ?>','/adminpanel/questions/');return false;">Добавить</button>
								<button type="button" class="btn btn-default" onclick="deleteRowDirect('datatable1','<?php  echo "/adminpanel/sub_themes_sql/"; ?>');return false;">Удалить</button>	
							</div>
						</div>
					</div>
					<br/>
					
					<br/>
                    <p class="text-muted font-13 m-b-30">  
                    </p>
                   <table id="datatable1" class="table table-striped table-bordered jambo_table bulk_action">
                      <thead>
                        <tr>
                          <th class="thCheckbox"></th>
						  <th class="thCheckbox" style="display: none;"></th>
                          <th class="thStyleForListDirections">Название</th>
                          <th class="thStyleForListDirections">Вопросы</th>
						  <th class="ButtonRight"></th>
						  <th class="ButtonLeft"></th>
                        </tr>
                      </thead>

                      <tbody >
					  <?php
					$result = mysqli_query($db,"SELECT * FROM sub_themes WHERE id_direct=".$group_id['id']." ")or die(mysql_error());
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
										<input type="text" class="form-control" name="password" value="'.$group['name'].'" style="display: none;" disabled/>
									  </td>
									  <td >
										<span class="" style="display: inline;"><a href="/adminpanel/questions/'.$group['id'].'">Посмотреть вопросы</a></span>
									  </td>
									  <td ><button class="btn btn-default" onclick="editStyleForDirect(this);return false;" ><span class="glyphicon glyphicon-pencil" ></span> </button></td>';
						?>			  
									  <td ><button class="btn btn-success" onclick="saveStyleForDirect(this,'/adminpanel/sub_themes_sql/<?php echo $EFabc->route->getId();?>');return false;" disabled><span class="glyphicon glyphicon-ok"></span> </button></td>
								</tr>
						<?php	}
                        }else{
							echo '<tr class="default">
								<td>		
								</td>
								<td>	
									Данные отсутствуют!
								</td>
								<td>	
								</td>
								<td>		
								</td>
								<td>		
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