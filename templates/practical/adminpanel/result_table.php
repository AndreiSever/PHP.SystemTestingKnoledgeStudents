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
                <h3><?php echo $group_id['name']." ";?><small>Итоги тестирования</small></h3>
              </div>
              <div class="title_right">  
				
                </div>
              </div>
            </div>
			<?php 
				//$result2 = mysqli_query($db,"SELECT * FROM result_test WHERE id_group=".$group_id['id']."")or die(mysql_error());
				$result2 = mysqli_query($db,"SELECT * FROM name_test WHERE id_group=".$group_id['id']."")or die(mysql_error());
				$myrow2=mysqli_num_rows($result2);
				if ($myrow2<>0){
					$i=1;
					while ($myrow21=mysqli_fetch_array($result2, MYSQLI_ASSOC)){
			?>
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php 
						echo $myrow21['name']; 
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
									  <span  onclick="saveToFileResult(this,'<?php echo $myrow21['id']; ?>')">Сохранить в файл</span>
								 </label>
						  </div>
						</li>
					  </ul>
					</div>
					<div id="popupEdit">
						 <div class="x_title">
							 <h2>Пройденные вопросы</h2>
							<div class="clearfix"></div>
						 </div>
						 <div class="view"></div>
						 <br/>
						<br/>
						<br/>
						<br/>
					</div>
					<br/>
                    <p class="text-muted font-13 m-b-30">  
                    </p>
					
                   <table id="datatable<?php echo $i;?>" class="table table-striped table-bordered jambo_table bulk_action">
                      <thead>
                        <tr>
						  <th class="thCheckboxQuestion" style="display: none;"></th>
                          <th >Фамилия</th>
						  <th >Имя</th>
						  <th >Отчество</th>
						  <th >Оценка</th>
						  <th class="ButtonLeft"></th>
                        </tr>
                      </thead>

                      <tbody >
					  <?php
					$i+=1;
					$result3 = mysqli_query($db,"SELECT * FROM result_test WHERE id_group=".$group_id['id']." and id_name='".$myrow21['id']."'")or die(mysql_error());
					if (mysqli_num_rows ($result3) !== 0){
						while ($group=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
						$result4 = mysqli_query($db,"SELECT * FROM users WHERE id=".$group['id_user']." ")or die(mysql_error());
						$myrow4=mysqli_fetch_array($result4, MYSQLI_ASSOC);
						echo    '<tr class="even pointer">
									  <td style="display: none;">
										<span class="" style="display: inline;">'.$group['id'].'</span>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$myrow4['secondname'].'</span>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$myrow4['name'].'</span>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$myrow4['thirdname'].'</span>
									  </td>
									  <td>
										<span class="" style="display: inline;">'.$group['mark'].'</span>
									  </td>
									  <td ><a class="demo-2 btn btn-default" onclick="viewQuestion(this)"><span class="glyphicon glyphicon-pencil" ></span></a></td>';
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
					}
				}
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