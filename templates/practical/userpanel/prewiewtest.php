<?php 
$EFabc = new EFabc();
global $db;
if ( $EFabc->user->getRole()== "user"){ 
if (!empty($EFabc->route->getId())){
	$result = mysqli_query($db,"SELECT * FROM name_test WHERE id=".$EFabc->route->getId()."")or die(mysql_error());
	$group_id=mysqli_fetch_array($result,MYSQLI_ASSOC);
	if (!empty($group_id['id'])){
		$id_user=$EFabc->user->sanitizeMySql($EFabc->user->getId());
		$result1 = mysqli_query($db,"SELECT * FROM starttest WHERE id_name=".$group_id['id']." and id_user=".$id_user."")or die(mysql_error());
		$myrow1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		if (empty($myrow1['id'])){
			$result2 = mysqli_query($db,"SELECT * FROM result_test WHERE id_name=".$group_id['id']." and id_user=".$id_user."")or die(mysql_error());
			$myrow2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
			if (empty($myrow2['mark'])){
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
			<?php echo ucfirst($group_id['name']);?>
			</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <p class="text-muted font-13 m-b-30">  
			Внимание после начала тестирования ваше время не будет ограничиватся, но после того как вы его сдадите, пересдать уже не сможете. 
			<p>Все вопросы выбираются в случайном порядке из базы.			
			<p>Для пересдачи обратитесь к преподавателю, чтобы он создал новый тест.
			<p>Тестирование начнется, когда Вы нажмете кнопку "Продолжить".
            </p>  
			<button class="btn btn-default" onclick="startTest('<?php echo $group_id['id'];?>');">Продолжить</button>
			<hr>
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