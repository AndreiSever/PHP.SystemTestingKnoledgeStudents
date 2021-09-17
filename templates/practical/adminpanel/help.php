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
			Справка
			</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <p class="text-muted font-13 m-b-30">  
			<h4>Выгрузка из файла для студентов. 
			Обозначение столбцов в файле Excel:</h4> 
			<p>- A - Фамилия;
			<p>- B - Имя; 
			<p>- С - Отчетсво; 
			<h4>Сохранение в файл для обучаюшихся. 
			Обозначение столбцов в файле Excel:</h4> 
			<p>- A - Фамилия;
			<p>- B - Имя; 
			<p>- С - Отчетсво; 
			<p>- D - Логин;
			<p>- E - Пароль; 
			<h4>Сохранение в файл/Выгрузка из файла вопросов. 
			Обозначение столбцов в файле Excel:</h4> 
			<p>- A - Название вопроса;
			<p>- B - Вариант ответа 1; 
			<p>- С - Вариант ответа 2; 
			<p>- D - Вариант ответа 3;
			<p>- E - Вариант ответа 4; 
			<p>- F - Вариант ответа 5; 
			<p>- G - Вариант ответа 6;
			<p>- H - Номер правильного ответа 1; 
			<p>- I - Номер правильного ответа 2; 
			<p>- J - Номер правильного ответа 3;
			<p>- K - Номер правильного ответа 4; 
			<p>- L - Номер правильного ответа 5; 
			<p>- M - Номер правильного ответа 6;
			<h4>Сохранение в файл результатов тестирования. 
			Обозначение столбцов в файле Excel:</h4> 
			<p>- A - Фамилия;
			<p>- B - Имя; 
			<p>- С - Отчетсво;
			<p>- D - Оценка;
 
			<hr>
        </div>
    </div>
</div>
<?php 

}else{
	$EFabc->route->applyError();
	$EFabc->route->applyErrorCopy();
						
	}

?>