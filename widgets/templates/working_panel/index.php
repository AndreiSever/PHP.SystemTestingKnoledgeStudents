<?php
$EFabc = new EFabc();
global $db;
if ($EFabc->user->privateRoleOnly()){
echo '
  <body class="nav-md" >
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
      
            <!-- /menu profile quick info -->

            <br/>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Навигация</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-user"></i> Список обучающихся <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu add">
					  <li><a href="/adminpanel/create_group_student">Создать группу</a></li>';
					    $result = mysqli_query($db,"SELECT * FROM student_group")or die(mysql_error());
						while ($group=mysqli_fetch_array($result,MYSQLI_ASSOC)){
							echo '<li class="Delete"><a  href="/adminpanel/table_list_student/'.$group['name'].'">'.$group['name'].'</a></li>';
						}
                  echo  '</ul>
                  </li>
                  <li><a><i class="fa fa-question"></i> Список вопросов <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/adminpanel/directions/">Дисциплины</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-list-alt"></i> Тест <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/adminpanel/create_config_test/">Создать тест</a></li>
					  <li><a>Список тестов<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu add">';
						  $result = mysqli_query($db,"SELECT * FROM student_group")or die(mysql_error());
						  while ($group=mysqli_fetch_array($result,MYSQLI_ASSOC)){
							echo '<li class="Delete"><a  href="/adminpanel/list_name_config/'.$group['name'].'">'.$group['name'].'</a></li>';
						}
                        echo  '</ul>
                        </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Итоги тестирования <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu add">';
						$result = mysqli_query($db,"SELECT * FROM student_group")or die(mysql_error());
						while ($group=mysqli_fetch_array($result,MYSQLI_ASSOC)){
								echo '<li class="Delete"><a  href="/adminpanel/result_table/'.$group['name'].'">'.$group['name'].'</a></li>';
							}
                      
                    echo '</ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Выход" href="/users/logout/">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
         <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
			  <ul class="nav navbar-nav navbar-right">
                <li class>
                  <a  class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
				  $id_user=$EFabc->user->sanitizeMySql($EFabc->user->getId());
                  $result = mysqli_query($db,"SELECT * FROM users WHERE id='".$id_user."'")or die(mysql_error());
				  $name=mysqli_fetch_array($result,MYSQLI_ASSOC);  
				  echo $name['secondname']." ".$name['name']." ".$name['thirdname']." ";
                  echo  '<span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/users/profile/"> Профиль</a></li>
					<li ><a  href="/adminpanel/help/">Справка</a></li>
                    <li><a href="/users/logout/"><i class="fa fa-sign-out pull-right"></i> Выход</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
		<div class="right_col" role="main" style="min-height: 660px;">
		<!-- page content -->';
}else{ if ($EFabc->user->getRole()== "user"){
	echo '
	  <body class="nav-md" >
		<div class="container body">
		  <div class="main_container">
			<div class="col-md-3 left_col">
			  <div class="left_col scroll-view">
				<div class="clearfix"></div>

				<!-- menu profile quick info -->
		  
				<!-- /menu profile quick info -->

				<br/>

				<!-- sidebar menu -->
				<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
				  <div class="menu_section">
					<h3>Навигация</h3>
					<ul class="nav side-menu">
					  <li><a><i class="fa fa-list"></i> Список Тестов <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">';
						  $id_user=$EFabc->user->sanitizeMySql($EFabc->user->getId());
						  $result = mysqli_query($db,"SELECT * FROM users WHERE id='".$id_user."'")or die(mysql_error());
						  $group=mysqli_fetch_array($result,MYSQLI_ASSOC);
						  //echo $group['nickname'];
						  $result1 = mysqli_query($db,"SELECT * FROM list_students WHERE login='".$group['nickname']."'")or die(mysql_error());
						  $group1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
						  
						  $result2 = mysqli_query($db,"SELECT * FROM name_test WHERE id_group='".$group1['id_group']."'")or die(mysql_error());
						  while ($group2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
							$result3 = mysqli_query($db,"SELECT * FROM starttest WHERE id_name=".$group2['id']." and id_user='".$id_user."'")or die(mysql_error());
							$myrow3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
							if (empty($myrow3['id'])){
								$result4 = mysqli_query($db,"SELECT * FROM result_test WHERE id_name=".$group2['id']." and id_user='".$id_user."'")or die(mysql_error());
								$myrow4 = mysqli_fetch_array($result4,MYSQLI_ASSOC);
								if (!empty($myrow4['mark'])){
									echo '<li><a href="/userpanel/resulttest/'.$group2['id'].'">'.$group2['name'].'</a></li>';
								}else{
									echo '<li><a href="/userpanel/prewiewtest/'.$group2['id'].'">'.$group2['name'].'</a></li>';
								}
							}else{
								echo '<li><a href="/userpanel/test/'.$group2['id'].'">'.$group2['name'].'</a></li>';
							}	
						  }
						echo '</ul>
					  </li>
					</ul>
				  </div>
				</div>
				<!-- /sidebar menu -->

				<!-- /menu footer buttons -->
				<div class="sidebar-footer hidden-small">
				  <a data-toggle="tooltip" data-placement="top" title="Logout" href="/users/logout/">
					<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
				  </a>
				</div>
				<!-- /menu footer buttons -->
			  </div>
			</div>

			<!-- top navigation -->
			 <div class="top_nav">
			  <div class="nav_menu">
				<nav>
				  <div class="nav toggle">
					<a id="menu_toggle"><i class="fa fa-bars"></i></a>
				  </div>
				  <ul class="nav navbar-nav navbar-right">
					<li class>
					  <a  class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
					  $result = mysqli_query($db,"SELECT * FROM users WHERE id='".$id_user."'")or die(mysql_error());
					  $name=mysqli_fetch_array($result,MYSQLI_ASSOC);  
					  echo $name['secondname']." ".$name['name']." ".$name['thirdname']." ";
					  echo  '<span class=" fa fa-angle-down"></span>
					  </a>
					  <ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="/users/logout/"><i class="fa fa-sign-out pull-right"></i> Выход</a></li>
					  </ul>
					</li>
				  </ul>
				</nav>
			  </div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main" style="height: 660px;">

			
			<!-- page content -->';
	}	
}
?>