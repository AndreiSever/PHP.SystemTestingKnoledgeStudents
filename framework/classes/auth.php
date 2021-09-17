<?php	
	class auth
	{	public function confirm($email,$id) 
		{
			$to = $email;
			$subject = 'Изменения в вашей учетной записи.'; 
			$message = "Вы запросили внесение изменений в вашу учетную запись,а именно изменение адреса электронной почты. \r\n Чтобы изменения вступили в силу, пройдите ниже по сслыке.(Ссылка будет активна 5 минут) \r\n http://testlocal.net.host1582112.serv11.hostland.pro/users/change/".$id.""; 
			$message = wordwrap($message, 200);
			$headers = 'From: email@testlocal.ru' . "\r\n" .    
				    
				'X-Mailer: PHP/' . phpversion();
			// формируем расширенные заголовки	
			mail($to, $subject, $message, $headers); 
		}
		public function recovery($email, $password) 
		{
			$to = $email;
			$subject = 'Восстановление пароля прошло успешно.'; 
			$message = "Ваш новый пароль - ".$password.""; 
			$message = wordwrap($message, 70);
			$headers = 'From: pass@testlocal.ru' . "\r\n" .    
				    
				'X-Mailer: PHP/' . phpversion();
			// формируем расширенные заголовки	
			mail($to, $subject, $message, $headers); 
		}
	}
?>