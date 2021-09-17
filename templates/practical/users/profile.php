<?php
$EFabc = new EFabc();
global $db;
$id=$EFabc->user->sanitizeMySql($EFabc->user->getId());
$hash=$EFabc->user->sanitizeMySql($EFabc->user->getHash());
$result = mysqli_query($db,"SELECT * FROM users WHERE id='".$id."' and hash_pass='".$hash."'")or die(mysql_error());
$data=mysqli_fetch_array($result,MYSQLI_ASSOC);
if ($EFabc->user->privateRoleOnly()){ 
	if (!empty($data['id'])){ 
?>
<div class>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Редактирование Профиля</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" >
					<!-- Вот та самая форма-->
                    <form    class="form-horizontal form-label-left"  novalidate><!--action='/users/profile/' method='Post'-->
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Логин <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  id="login" class="form-control col-md-7 col-xs-12"  name="login" type="text" required="required" value="<?php echo $data['nickname'];?>" />
                        </div>
                      </div>
                      <div class="item form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Фамилия <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" >
                          <input id="forename" class="form-control col-md-7 col-xs-12" name="forename"  type="text" required="required" value="<?php echo $data['secondname'];?>" />
                        </div>
                      </div>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Имя <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  id="name" class="form-control col-md-7 col-xs-12"  name="name" type="text" required="required" value="<?php echo $data['name'];?>" />
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Отчество <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="thirdname" class="form-control col-md-7 col-xs-12"  name="thirdname"  type="text" required="required" value="<?php echo $data['thirdname'];?>" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email"  id="email" name="email"  placeholder="name@example.ru"  required="required"  class="optional  form-control col-md-7 col-xs-12" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Старый пароль<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="oldPassword" type="password" name="oldPassword"  class="form-control col-md-7 col-xs-12" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Новый пароль</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required" />
                        </div>
                      </div>
					  <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Повторите пароль</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required" />
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      
                    </form>
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
						  <!-- Вот та кнопка которая не работает-->
                          <input  id='profile' type="submit" class="btn btn-success"    value="Сохранить"/>
						  
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
 </div>  
<?php 
	}
}	
?> 