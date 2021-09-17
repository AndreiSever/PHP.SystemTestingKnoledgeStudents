<?php 
$EFabc = new EFabc();
global $db;
if ($EFabc->user->privateRoleOnly()){ 
if (!empty($EFabc->route->getId())){
	$result = mysqli_query($db,"SELECT * FROM sub_themes WHERE id=".$EFabc->route->getId()."")or die(mysql_error());
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
					  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Действие <span class="caret"></span></button> 
					  <ul class="dropdown-menu" role="menu">
						<li>
							<div class="file-upload btn-default" >
								 <label>
								 <form name="uploader" enctype="multipart/form-data" method="POST">
									  <input type="file" name="userfile" onchange="filelQuestion('uploader',this,'<?php echo $EFabc->route->getId(); ?>')" >
									  <span>Выгрузить из файла</span>
								 </form>
								 </label>
						  </div>
						</li>
						<li>
							<div class="file-upload btn-default" >
								 <label>
									  <span  onclick="saveToFileQuestion('<?php echo $EFabc->route->getId(); ?>')">Сохранить в файл</span>
								 </label>
						  </div>
						</li>
					  </ul>
					 <span style="padding-left:5px;"> <a class="demo-1 btn btn-info"><span class="glyphicon glyphicon-plus" ></span></a></span>
					 <span style="padding-left:5px;"> <button class="btn btn-danger" onclick="deleteRowQuestion('datatable1','<?php  echo "/adminpanel/question_sql/"; ?>');return false;" ><span class="glyphicon glyphicon-remove" ></span> </button></span>
					 <div  id="preview" style="float:right;margin-top:10px;">	
					 </div>
					 <div id="popupAdd">
						 <div class="x_title">
							 <h2>Добавить вопрос</h2>
							<div class="clearfix"></div>
						 </div>
						<div class="form-group">
							<label for="exampleTextarea">Текст вопроса</label>
							<textarea class="form-control"  rows="10"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 1:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 2:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 3:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 4:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 5:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 6:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 1:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 2:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 3:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 4:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 5:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 6:</label>
							<input type="number" class="form-control"  >
						</div>
						<button type="submit" class="btn btn-primary" onclick="addRowQuestion(this,'datatable1','<?php  echo $EFabc->route->getId(); ?>');return false;">Добавить</button>
						<br/>
						<br/>
						<br/>
					</div>
					<div id="popupEdit">
						 <div class="x_title">
							 <h2>Редактировать вопрос</h2>
							<div class="clearfix"></div>
						 </div>
						<div class="form-group">
							<label for="exampleTextarea">Текст вопроса</label>
							<textarea class="form-control"  rows="10"></textarea>
						</div>
						<div class="relcontent">	
						</div>
						<div class="image"></div>
						<br>	
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 1:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 2:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 3:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 4:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 5:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Вариант ответа 6:</label>
							<textarea class="form-control"  rows="2"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 1:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 2:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 3:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 4:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 5:</label>
							<input type="number" class="form-control"   >
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Ответ 6:</label>
							<input type="number" class="form-control"  >
						</div>
						<div class="form-group" style="display: none;">
							<input type="number" class="form-control"  disabled>
						</div>
						<button type="submit" class="btn btn-primary" onclick="UpdateRowQuestion(this,'datatable1','<?php  echo $EFabc->route->getId(); ?>');return false;">Сохранить</button>
						<br/>
						<br/>
						<br/>
					</div>
					</div>
					<br/>
                    <p class="text-muted font-13 m-b-30">  
                    </p>
					
                   <table id="datatable1" class="table table-striped table-bordered jambo_table bulk_action">
                      <thead>
                        <tr>
                          <th class="thCheckboxQuestion"></th>
						  <th class="thCheckboxQuestion" style="display: none;"></th>
                          <th >Название</th>
						  <th class="ButtonLeft"></th>
                        </tr>
                      </thead>

                      <tbody >
					  <?php
					$result = mysqli_query($db,"SELECT * FROM question WHERE id_sub=".$group_id['id']." ")or die(mysql_error());
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
										<span class="" >'.$group['name'].'</span>
									  </td>
									  <td ><a class="demo-2 btn btn-default" onclick="editQuestion(this)"><span class="glyphicon glyphicon-pencil" ></span></a></td>';
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