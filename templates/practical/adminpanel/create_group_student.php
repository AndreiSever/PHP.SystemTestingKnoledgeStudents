<?php
$EFabc = new EFabc();
if ($EFabc->user->privateRoleOnly()){ 
?>
<div class="row">
<div class="page-title">
              <div class="title_left">
                <h3><small></small></h3>
              </div>
              <div class="title_right">  
				
                </div>
              </div>
            

            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Создать группу</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				    <div class="form-inline">
						<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="number"  id="group" value="" placeholder = "Номер группы"/> 
						<input type="button" class="btn btn-primary" onclick="addRow('datatableAdd');return false;" value='Добавить'/>
						<input type="button" class="btn btn-default" onclick="deleteRow('datatableAdd');return false;" value='Удалить'/>
					</div>
					<br/>
                    <p class="text-muted font-13 m-b-30">  
                    </p>
                    <table id="datatableAdd" class="table table-striped table-bordered jambo_table bulk_action">
                      <thead>
                        <tr>
                          <th class="thCheckbox"></th>
                          <th>Номер группы</th>
                        </tr>
                      </thead>
                      <tbody >	
					<?php
					global $db;
					$result = mysqli_query($db,"SELECT * FROM student_group")or die(mysql_error());
					if (mysqli_num_rows ($result) !== 0){
						while ($group=mysqli_fetch_array($result,MYSQLI_ASSOC)){
							echo    "<tr class='even pointer'>
										<td class='a-center '>
											  <input type='checkbox' class='flat' name='table_records'>
										 </td>
										  <td>".$group['name']. "</td>
									</tr>";
						}
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
			  </div>
 <?php 
}	
?>   