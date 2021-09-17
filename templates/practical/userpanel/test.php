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
		if (!empty($myrow1['id'])){
			$result2 = mysqli_query($db,"SELECT * FROM result_test WHERE id_name=".$group_id['id']." and id_user=".$id_user."")or die(mysql_error());
			$myrow2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
			if (empty($myrow2['mark'])){
				$result3 = mysqli_query($db,"SELECT * FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
				$countmyrow3=mysqli_num_rows($result3);
				$count=0;
				while($myrow3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
					//$countconfig+=1;
					//$maxcountconfig[$countconfig]=$myrow1['kolvo_quest'];
					//$count=0;
					$result4 = mysqli_query($db,"SELECT * FROM question WHERE id='".$myrow3['id_question']."' and name<>'' and (var1<>'' or var2<>'' or var3<>'' or var4<>'' or var5<>'' or var6<>'') and (ans1<>'' or ans2<>'' or ans3<>'' or ans4<>'' or ans5<>'' or ans6<>'')")or die(mysql_error());
					//while (){
					$myrow4 = mysqli_fetch_array($result4, MYSQLI_ASSOC);
					if (!empty($myrow4['id'])){
						$flag1=0;
						for ($g=1;$g<=6;$g++){
							
							if ($myrow4['ans'.$g]<>""){
								if (is_numeric($myrow4['ans'.$g]) && $myrow4['ans'.$g]<=6){
									
									if ($myrow4['var'.$myrow4['ans'.$g]]==""){
										$flag1=1;
										//echo "fgs";
									}
								}else{
									$flag1=1;
									//echo $myrow4['ans'.$g];
									//echo "fdsf";
								}
							}
						}
					}else{
						$flag1=1;
					}
					if ($flag1==0){
						$count+=1;
					}
				}
				if ($count<>$countmyrow3){
					$flag=1;
				}
			if ($flag==0){	
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
			
            </p>  
			<ul class="nav nav-tabs">
			<?php 
				$result3 = mysqli_query($db,"SELECT * FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
				while($myrow3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
					$result4 = mysqli_query($db,"SELECT * FROM question WHERE id='".$myrow3['id_question']."'")or die(mysql_error());
					$myrow4 = mysqli_fetch_array($result4,MYSQLI_ASSOC);
					$number+=1;
					echo "<li ><a id='".$myrow4['id']."' href='#".$number."' onclick='activeTab(this)' data-toggle='tab'>".$number."</a></li>";
				}
			?>
			  <li><a href='#end' data-toggle='tab'>Закончить</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
			<?php	
				$number=0;
				$result3 = mysqli_query($db,"SELECT * FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
				while($myrow3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)){
					$result4 = mysqli_query($db,"SELECT * FROM question WHERE id='".$myrow3['id_question']."'")or die(mysql_error());
					$myrow4 = mysqli_fetch_array($result4,MYSQLI_ASSOC);
					$number+=1;
					echo "
					  <div class='tab-pane' id='".$number."'>
						<br>
						<div class='viewtest'>";
					echo "<p>".$myrow4['name']."";
					if ($myrow4['image']!=""){
						echo "<br/><br/><div class='image'><img src='/image/".$myrow4['image']."' alt='' /></div><br/>";
					}
					for ($x=1;$x<=6;$x++){
						if ($myrow4['var'.$x]<>""){
							echo "<div class='checkbox'>
									<p><label>
										<input type='checkbox' value='' >";
							echo	"<span>".$myrow4['var'.$x]."</span>";
							echo	"</label>
								</div>";
							  
						}
					}
					echo "<br></div></div>";
				}
			  ?>
			  <div class="tab-pane" id='end'>
				<br>
				<div class='viewtest'>
					<p>Помните, что после нажатия сохранятся все ответы и выведется оценка.
					<p>Пересдать тест не получиться!
					<p>Для сохранения текущих данных нажмите "Закончить тест".
					<p><a class="btn btn-default" onclick="saveResultTest('<?php echo $EFabc->route->getId();?>')">Закончить тест</a>
				</div>
			  </div>
			</div>
			<br>
			<br>
        </div>
    </div>
</div>
<?php 			
				}else{
					mysqli_query($db,"DELETE FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
					mysqli_query($db,"DELETE FROM starttest WHERE id_name='".$group_id['id']."' and id_user='".$id_user."'")or die(mysql_error());
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
}else{
	$EFabc->route->applyError();
	$EFabc->route->applyErrorCopy();
						
	}
}	
?> 