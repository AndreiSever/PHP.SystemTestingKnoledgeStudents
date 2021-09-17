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
						echo "Группа ".$EFabc->route->getId(); 
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
								<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="forename" placeholder = "Фамилия" />
								<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="name" placeholder="Имя" />
								<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="thirdname" placeholder="Отчество" />
								<button class="btn btn-primary" onclick="addRowStudent('datatable1','<?php echo $EFabc->route->getId(); ?>');return false;">Добавить</button>
								<button type="button" class="btn btn-default" onclick="deleteRowStudent('datatable1');return false;">Удалить</button>	
							</div>
						</div>
					</div>
					<br/>
					<div class="btn-group">
					  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Действие <span class="caret"></span></button> 
					  <ul class="dropdown-menu" role="menu">
						<li>
							<div class="file-upload btn-default" >
								 <label>
								 <form name="uploader" enctype="multipart/form-data" method="POST">
									  <input type="file" name="userfile" onchange="filel('uploader',this,'<?php echo $EFabc->route->getId(); ?>')" >
									  <span>Выгрузить из файла</span>
								 </form>
								 </label>
						  </div>
						</li>
						<li>
							<div class="file-upload btn-default" >
								 <label>
									  <span  onclick="saveToFile(this,'<?php echo $EFabc->route->getId(); ?>')">Сохранить в файл</span>
								 </label>
						  </div>
						</li>
					  </ul>
					 <div  id="preview" style="float:right;margin-top:10px;">	
					 </div>
					</div>
					
					<br/>
                    <p class="text-muted font-13 m-b-30">  
                    </p>
                   <table id="datatable1" class="table table-striped table-bordered jambo_table bulk_action">
                      <thead>
                        <tr>
                          <th class="thCheckbox"></th>
						  <th class="thCheckbox" style="display: none;"></th>
                          <th class="thStyleForListStudent">Фамилия</th>
                          <th class="thStyleForListStudent">Имя</th>
                          <th class="thStyleForListStudent">Отчество</th>
						  <th class="thStyleForListStudent">Логин</th>
						  <th class="thStyleForListStudent">Пароль</th>
						  <th class="ButtonRight"></th>
						  <th class="ButtonLeft"></th>
                        </tr>
                      </thead>

                      <tbody >
					  <?php
					$result = mysqli_query($db,"SELECT * FROM list_students WHERE id_group=".$group_id['id']."")or die(mysql_error());
					if (mysqli_num_rows ($result) !== 0){
						while ($group=mysqli_fetch_array($result,MYSQLI_ASSOC)){
						echo    '<tr class="even pointer">
									  <td class="a-center ">
										  <input type="checkbox" class="flat" name="table_records">
									  </td>
									  <td style="display: none;">
										<span class="" style="display: inline;">'.$group['id'].'</span>
									  </td>
									  <td >
										<span class="" style="display: inline;">'.$group['surname'].'</span>
										<input type="text" class="form-control" name="surname" value="'.$group['surname'].'" style="display: none;"  disabled/>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$group['name'].'</span>
										<input type="text" class="form-control" name="name" value="'.$group['name'].'" style="display: none;" disabled/>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$group['thirdName'].'</span>
										<input type="text" class="form-control" name="thirdName" value="'.$group['thirdName'].'" style="display: none;" disabled/>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$group['login'].'</span>
										<input type="text" class="form-control" name="login" value="'.$group['login'].'" style="display: none;" disabled/>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$group['password'].'</span>
										<input type="text" class="form-control" name="password" value="'.$group['password'].'" style="display: none;" disabled/>
									  </td>
									  <td ><button class="btn btn-default" onclick="editStyle(this);return false;" ><span class="glyphicon glyphicon-pencil" ></span> </button></td>
									  <td ><button class="btn btn-success" onclick="saveStyle(this);return false;" disabled><span class="glyphicon glyphicon-ok"></span> </button></td>
								</tr>';
							}
                        }else{
							echo '<tr class="default">
								<td>		
								</td>
								<td>		
								</td>
								<td>		
								</td>
								<td>
									Данные для это группы отсутствуют!
								</td>
								<td>		
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