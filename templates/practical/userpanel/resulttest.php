<?php 
$EFabc = new EFabc();
global $db;
if ($EFabc->user->getRole()== "user"){ 
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
			if (!empty($myrow2['mark'])){
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
			<h4>Оценка за тест выставляется в соответствии с количеством правильных ответов. 
			Если Вы набрали:</h4> 
			<p>- менее 50% - тестирование не пройдено «неуд»; 
			<p>- от 50 до 72% - оценка «удовлетворительно» (3); 
			<p>- от 73 до 85% - оценка «хорошо» (4); 
			<p>- от 86 до 100%- оценка «отлично» (5).
			<h4>Ваша оценка по данному тесту <?php echo $myrow2['mark'];?>.</h4>
			<p>Если ваша оценка «неуд» обратитесь к преподавателю , чтобы он создал новый тест, который будет являтся пересдачей.
            </p>  
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