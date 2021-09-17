<?php 
$EFabc = new EFabc();
global $db;
if ($EFabc->user->privateRoleOnly()){ 

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
                    <h2>
					Создать тест	
					</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					  <div>
						<br/>
						<div class="input-group">
							<label for="date" class="input-group-addon"> Номер группы </label>
							<select class="form-control" id="direct">
							<?php 
								$result = mysqli_query($db,"SELECT * FROM student_group")or die(mysql_error());			
								while($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)){	
									echo '<option value="'.$myrow['id'].'">'.$myrow['name'].'</option>';
								}  
							?>
							</select>
						</div>
						<div class="input-group">
							<label class="input-group-addon"> Название теста </label>
							<input class="form-control" id="nameTest" maxlength="30"/>
						</div>
						<a class="create-day btn btn-default" onclick='addTableTest(this);' style="margin-bottom: 10px;">Добавить дисциплину </a>
								  
						<br/>
						<div class="table-day">
						  <table class="table table-striped">
							<thead>
							  <tr>
								<th>
								  <div class="input-group">
									<label  class="input-group-addon"> Дисциплина </label>
										<select class="form-control" onchange='selchange(this,this.value);'>
										<?php 
										$result = mysqli_query($db,"SELECT * FROM directions")or die(mysql_error());
										
										while($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)){	
											echo '<option value="'.$myrow['id'].'">'.$myrow['name'].'</option>';
										}  
										//echo "sdfsdf";
										?>
										</select>
								  </div>
								</th>
								<th>
								 <a class="delete-day btn btn-danger" onclick="deleteTestConfig(this)" style="margin-bottom: 10px;">Удалить дисциплину</a> 
								</th>
							  </tr>
							</thead>
							<tbody>
							  <tr class="crudable">
								<td>
								  <div class="input-group">
									<label class="input-group-addon"> Темы </label>
									<select class="form-control" >
									<?php 
										$result = mysqli_query($db,"SELECT * FROM directions")or die(mysql_error());
										$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
										$result1 = mysqli_query($db,"SELECT * FROM sub_themes WHERE id_direct='".$myrow['id']."'")or die(mysql_error());
										while($myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){	
											echo '<option value="'.$myrow1['id'].'">'.$myrow1['name'].'</option>';
										}  
										//echo "sdfsdf";
									?>
									</select>
								  </div>
								</td>
								<td>
								  <div class="input-group">
									<label class="input-group-addon"> Количество вопросов </label>
									<input class="form-control" value="" name="time" type="number">
								  </div>
								</td>
								<td>
								  <div class="crudable-create btn btn-info">+</div>
								</td>
								<td>
								  <div class="crudable-delete btn btn-danger">-</div>
								</td>
							  </tr>
							</tbody>
						  </table>
						</div>
					</div>
					 <div class="ln_solid"></div>
					 <div class="form-group col-md-6 col-md-offset-1">
                          <input id="send" type="submit" onclick="saveConfigTest()"class="btn btn-success" name="submit" value="Создать тест"/>
					 </div>
					</div>
                  </div>
                </div>
              
<?php 
}	
?> 