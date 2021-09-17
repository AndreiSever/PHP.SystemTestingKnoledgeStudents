<?php 

$EFabc = new EFabc();  
if ($EFabc->user->isGuest()){
	echo <<<_END
	<body class="login">
		<div>
		  <a class="hiddenanchor" id="signup"></a>
		  <a class="hiddenanchor" id="signin"></a>

		  <div class="login_wrapper">
			<div class="animate form login_form">
			  <section class="login_content">
				<form action='/users/login/' method='Post' >
				  <h1>Авторизация</h1>
				  <div>
					<input type="text" class="form-control" name='nickname' placeholder="Логин" required="" />
				  </div>
				  <div>
					<input type="password" class="form-control" name='password' placeholder="Пароль" required="" />
				  </div>
				  <div>
					<input  style="margin-left:140px;" class="btn btn-default submit" type='submit' name='login' value='Вход'/> 
				  </div>

				  <div class="clearfix"></div>

				  <div class="separator">
					<p class="change_link">Забыли пароль?
					  <a href="#signup" class="to_register"> Восстановление пароля </a>
					</p>

					<div class="clearfix"></div>
					<br />

					<div>
					  <h1><i ></i> ЮУрГУ</h1>
					  <p>©2017 Все права защищены.</p>
					</div>
				  </div>
				</form>
			  </section>
			</div>

			<div id="register" class="animate form registration_form">
			  <section class="login_content">
				<form action="/users/recovery/" method="Post">
				  <h1>Восстановление</h1>
				  <p>Введите свой Email, на него будет выслан новый пароль.<p/>
				  <div>
					<input type="email" class="form-control" placeholder="Email" name="email" required="" />
				  </div>
				  <div>
					<input  style="margin-left:120px;" class="btn btn-default submit" type='submit' name="submit" value='Отправить'/> 
				  </div>

				  <div class="clearfix"></div>

				  <div class="separator">
					<p class="change_link">Уже вспомнил ?
					  <a href="#signin" class="to_register"> Вход </a>
					</p>

					<div class="clearfix"></div>
					<br />

					<div>
					  <h1><i></i> ЮУрГУ</h1>
					  <p>©2017 Все права защищены.</p>
					</div>
				  </div>
				</form>
			  </section>
			</div>
		  </div>
		</div>
_END;
	}
 ?>