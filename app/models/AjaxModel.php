<?php

/**
 * 
 * Что такое "вас ист дас" ?
 * Евразийский пидарас,
 * Пьёт текилу, пьёт портвейн,
 * Ах ты сука - нихьт ферштейн.
 */

use Upload\Upload;
use Mailer\PHPMailer;
use Mailer\Exception;

class AjaxModel extends Model
{
	const MESSAGE = '<p>Сообщение с сайта от %s (%s).</p><br />%s';

	private $upload;
	private $mailer;
	private $action;
	private $header;
	private $mailto;
	private $result;
	private $errors;
	private $request;
	private $charset;

	public function __construct()
	{
		parent::__construct();

		$this->action  = $_POST['action'] ?? null;
		$this->header  = $_SERVER['HTTP_X_REQUESTED_WITH'];
		$this->mailto  = Config::get('admin_mail');
		$this->charset = Config::get('charset');
		
		if ( !isset($this->action) ) //   $this->isAjax() 'not xmlhttprequest'
		{
			$this->_response_code( 500, 0 );
		}
	}

	public function contact() 
	{
		if ($this->action !== 'contact')
		{
			$this->_response_code( 500, 0 );
		}

		foreach ($_POST as $k => $v)
		{
			$$k = trim(htmlspecialchars($v));
		}

		if ( !isset($name, $mail, $sessid, $message) )
		{
			$this->_response_code( 500, 0 );
		}

		if (empty($name))
		{
			$this->errors[] = 'Введите ваше Имя!';
		}

		if ( empty($mail) or !filter_var($mail, FILTER_VALIDATE_EMAIL) )
		{
			$this->errors[] = 'Введите вашу почту корректно!';
		}

		if ( !empty($phone) and !preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/', $phone) )
		{
			$this->errors[] = 'Укажите корректный телефон.';
		}

		if ( empty($message) )
		{
			$this->errors[] = 'Вы не написали сообщение';
		}

		if ( reset ($this->errors) )
		{
			$this->result = join ( '<br/>', array_values($this->errors) );
			$this->_response_code( 500, $this->result);
		}

		$this->mailer = new PHPMailer();

		try {
			$this->mailer->SetFrom ($mail, $name);
			$this->mailer->CharSet  = $this->charset;
			$this->mailer->AddAddress($this->mailto, $subject);
			$this->mailer->AddReplyTo($mail, $name);
			$this->mailer->msgHTML('
				<h1>'.$subject. '</h1>
				<p>' .$name. '</p>
				<p>' .$phone. '</p>
				<p>' .$message. '</p>
			');

			$this->result = $this->mailer->Send()? 
				'Ваше сообщение успешно отправленно!': 
				$this->$mailer->ErrorInfo;

			$this->mailer->ClearAddresses(); 
			$this->mailer->ClearAttachments();
			$this->_response_code( 200, $this->result );
			 
		} catch ( Exception $e ) {
			parent::logWrite('Ошибка: ' .$e, true);
		}

		$this->_response_code( 200, 0 );
	}
	
	public function setPhone($id = 0, array $json = [], string $result = '', $jsonUnicode = JSON_UNESCAPED_UNICODE) : string
	{
		if ( $this->action != 'addbook' )
		{
			$this->_response_code( 500, 0 );
		}

		$this->sessid() or $this->_response_code( 500, 0 );

		foreach ($_POST as $k => $v)
		{
			$$k = trim(htmlspecialchars($v));
		}

		if (!isset($name, $family, $mail, $phone))
		{
			$this->_response_code( 500, 0 );
		}

		if ( !filter_var($mail, FILTER_VALIDATE_EMAIL) )
		{ 
			$this->errors[] = 'Введите вашу почту корректно!';
		}

		if ( !preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/', $phone) )
        {
            $this->errors[] = 'Укажите корректный телефон.';
		}
		
		if ( reset($this->errors) )
		{
			$this->result = join ( "\n", array_values($this->errors) );
			$this->_response_code( 
				500, $this->result
			);
		}

		if ( $_FILES['icon']['name'] || !$_FILES['icon']['error'] )
		{
			$this->upload = new Upload ($_FILES['icon']);

			if ($this->upload->uploaded)
			{
				$this->upload->file_new_name_body = uniqid('photo_');
				$this->upload->file_max_size = 6291456; // 6 x 1024 x 1024
				$this->upload->image_ratio_crop = true;
				$this->upload->forbidden = ['application/*'];
				$this->upload->allowed   = ['image/jpeg', 'image/jpg', 'image/png']; 
				$this->upload->process(root.'/img');
		
				if ($this->upload->processed)
				{ 				
					$icon = $this->upload->file_dst_name;		
				} 
			}

			$this->upload->Clean();
		}

		$result = ORM::forTable('books')->create();
		$result->name = printf('%s %s', $name, $family);
		$result->mail = $mail;
		$result->icon = $icon ? $icon : 'default.png';
		$result->save();

		$query = ORM::forTable('books')->orderByDesc('id')->findArray();

		//$id = $result->id();
		//$query = "SELECT * FROM `users` WHERE `id` =:id";
		//$query = ORM::forTable('users')
		//	->rawQuery($query, ['id' => $result->id()])
		//	->findArray();

		foreach ($query as $row)
		{
			$json [] = $row;
		}

		echo json_encode($json, $jsonUnicode);
		exit;
	}

	public function setRegistration()
	{
		foreach ($_POST as $k => $v) {
			$$k = trim(htmlspecialchars($v));
		}

		if ( !isset($username, $password, $mail) or $this->action != 'registration' )
		{
			$this->_response_code( 500, 0 );
		}

		$this->sessid() or $this->_response_code( 500, 0 );

		if( !preg_match('/^[A-Za-z0-9_\-]{3,16}$/i', $username) )
		{
			$this->errors[] = 'Введите ваш логин корректно!';
		}

		if (empty($password) or $password !== $password2)
		{
			$this->errors[] = 'Веденные ваши пароли не совпaдают!';
		}

		if (!preg_match("/([a-z]+)/", $password) or !preg_match("/([A-Z]+)/", $password) or !preg_match("/([0-9]+)/", $password)) 
		{ 
			$this->errors[] = 'Пароль должен содержать от 6 до 12 символов, быть в разных регистрах!';
		} 

		if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
		{ 
			$this->errors[] = 'Введите вашу почту корректно.';
		}

		if (ORM::forTable('users')->select('mail')->where(['mail' => $mail])->findOne())
		{
			$this->errors[] = 'Ваш email уже кто-то использует!';
		}

		if (ORM::forTable('users')->select('username')->where(['username' => $username])->findOne())
		{
			$this->errors[] = 'Ваш логин уже кто-то использует!';
		}

		if ( reset($this->errors) )
		{
			$this->result = join ("\n", array_values($this->errors));
			$this->_response_code(500, $this->result);
		}

		$user = ORM::forTable('users')->create();
		$user->username = $username;
		$user->password = password_hash($password, PASSWORD_DEFAULT);
		$user->date = time();
		$user->name = $name;
		$user->mail = $mail;
		$user->save();

		printf ('<p>%s, Вы зарегистрированны в системе.</p>', $username);
		exit;
	}
	  
	public function delbook()
	{
		if( !$this->isAuthorize or $this->action !== 'delete' )
		{
			$this->_response_code( 500, 0 );
		}

		if( empty($_POST['item']) )
		{
			$this->_response_code( 500, 'Вы никого не выбрали.' );
		}

		foreach ($_POST['item'] as $k => $v)
		{
			$query = ORM::forTable('users')->findOne($v);

			if ( $query->avatar and file_exists(root.'/img/'.$query->avatar) )
			{
				unlink(root.'/img/'.$query->avatar);
			}

			$query->delete();
		}
		exit;
	}

	public function profile( array $values = [] )
	{
		if ( !$this->model->isAuth() or $this->action !== 'profile' )
		{
			$this->_response_code( 500, 0 );
		}

		foreach ($_POST as $k => $v) {
			$$k = trim(htmlspecialchars($v));
		}

		if ( empty($userid) ) {
			$this->_response_code( 500, 0 );
		}

		if ( !filter_var($mail, FILTER_VALIDATE_EMAIL) )
		{ 
			$this->errors[] = 'Введите вашу почту корректно!';
		}

		if (reset($this->errors))
		{
			$this->result = join ("\n", array_values($this->errors));
			$this->_response_code(500, $this->result);
		}

		$values = [
			'name' => $name,
			'mail' => $mail
		];

		if ( !empty($password) and $password === $password2 )
		{
			$values['password'] = password_hash( $password, PASSWORD_DEFAULT );
		}

		try {
			$query = ORM::forTable('users')->findOne($userid);
			$query->set($values);
			$query->save();

			header('Location: /profile');
			exit;

		} catch(\Exception $e) {
			$this->model->logWrite ($e->getMessage());
		}
	}

	private function _response_code( int $code, $exit = NULL )
	{
		http_response_code($code) ;
		! isset($exit)
			or exit ($exit);
	}

	private function sessid( string $key = 'sessid') : bool
	{
		return ( isset($_POST[$key]) or $_POST[$key] === session_id() ) ? true : false;
	}

	private function isAjax() : bool
	{
		return ( isset($this->header) or strtolower($this->header) == 'xmlhttprequest') ? true : false;
	}
}
