<?php 
	$EFabc=new EFabc();
	
	if ($EFabc->route->getControll()!== "create_group_sql" && $EFabc->route->getControll()!=="create_student_sql" && $EFabc->route->getControll()!=="directions_sql"&&$EFabc->route->getControll()!=="question_sql"&&$EFabc->route->getControll()!=="create_config_test_sql"&&$EFabc->route->getControll()!=="result_table_sql"&&$EFabc->route->getControll()!=="img_question_sql"){ 
	//header('X-Accel-Buffering: no');
	header("Cache-Control:no-cache,no-store, must-revalidate, max-age=0");
	header("Pragma:no-cache");
	header("Expires:0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-ru" xml:lang="ru-ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
	<meta http-equiv="Cache-control" content="no-cache,no-store, must-revalidate, max-age=0"> <!--,post-check=0,pre-check=0">-->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Vary" content="*">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Bootstrap -->
	<link href="<?php echo $siteName; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
    <!-- Font Awesome -->
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/animate.css/animate.min.css" rel="stylesheet">
	<!-- iCheck -->
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
     <link href="<?php echo $siteName; ?>/adminLibrary/build/css/custom.css" rel="stylesheet"> 
	<link href="<?php echo $siteName; ?>/simple-popup-js/dist/jquery.simple-popup.min.css" rel="stylesheet">
	<link href="<?php echo $siteName; ?>/customCss/custom1.css" rel="stylesheet">
    <title></title>
	<style>
	
	</style>
 </head>
  
		<?php 
		//echo $_SERVER['HTTP_USER_AGENT'];
		$EFabc->route->getWidget('working_panel');
		$EFabc->route->intro();
		//$EFabc->route->startController();
		if ($EFabc->user->privateRoleOnly() || $EFabc->user->getRole()== "user"){
			echo  '<div class="clearfix"></div></div>
			
			<footer id="foot">
				<div class="pull-right">
					ЮУрГу - система для тестирования обучаюшихся по экономиким дисциплинам.
				</div>
			<div class="clearfix"></div>
			</footer></div></div>';
		}
		?>

	
	
    <!-- jQuery -->
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/jquery/dist/jquery.min.js"></script>
   <!-- Bootstrap -->
	<script src="<?php echo $siteName; ?>/bootstrap/js/bootstrap.min.js"></script>
	
    <!-- FastClick -->
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo $siteName; ?>/adminLibrary/vendors/pdfmake/build/vfs_fonts.js"></script>
	<!--Validator-->
    <!--<script src="<?php //echo $siteName; ?>/adminLibrary/vendors/validator/validator.min.js"></script>-->
	<!-- Custom Theme Scripts -->
    <script src="<?php echo $siteName; ?>/adminLibrary/build/js/custom.min.js"></script>
	<script src="<?php echo $siteName; ?>/PluginPaginate/jquery-paginate.min.js"></script>
	<script src="<?php echo $siteName; ?>/simple-popup-js/src/jquery.simple-popup.js"></script>
	<script src="<?php echo $siteName; ?>/Lightweight_Crudable/crudable.js"></script>
	<script src="<?php echo $siteName; ?>/customJs/custom.js"></script>
	<script>
	
	</script>
  </body>
</html>
<?php }?>	