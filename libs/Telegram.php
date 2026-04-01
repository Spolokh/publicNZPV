<?php

/**
 * Eine Klasse für Telegram Bot schnittstellen.
 *
 * Verfügbare Funktionen: <br>
 * sendMessage		- Nachrichten verschicken <br>
 * sendPhoto		- Bilder verschicken <br>
 * sendDocument 	- Dateien verschicken <br>
 * sendAudio		- Audios verschicken <br>
 * sendVideo		- Videos verschicken <br>
 * sendChatAction	- Den Bot beispielsweise "tippt..." sagen lass (siehe Methoden beschreibung) <br>
 * kickChatMember	- Benutzer aus eine Gruppe kicken <br>
 * unbanChatMember	- Benutzer entsperren <br>
 * sendKeyboard		- Auswahlfelder einblenden <br>
 * hideKeyboard		- Auswahlfelder ausblenden <br>
 * setWebhook		- Webhook für den Bot setzen <br>
 * delWebhook		- Webhook löschen
 *
 * Beispiele:
 * <code>
 * <?php
 * require_once('class.moonliightz.telegram.php');
 *
 * $bot = new Telegram(BOT KEY);
 *
 * $bot->sendMessage(CHAT_ID, "Text");
 * $bot->sendPhoto(CHAT_ID, "storageplan.png", "Bildunterschrift");
 * $bot->sendDocument(CHAT_ID, "storageplan.png");
 * $bot->sendAudio(CHAT_ID, "BVB.mp3", "Interpret", "Titel");
 * $bot->sendVideo(CHAT_ID, "video.mp4", "Beschreibung");
 *
 * $bot->sendChatAction(CHAT_ID, 1);
 *
 * $bot->kickChatMember(CHAT_ID, USER_ID);
 * $bot->unbanChatMember(CHAT_ID, USER_ID);
 *
 * $bot->sendKeyboard(CHAT_ID, "Text", array( array( "Zeile1 Test1", "Zeile1 Test2" ), array( "Zeile2 Test3", "Zeile2 Test4" ) ));
 * $bot->hideKeyboard(CHAT_ID, "Text");
 *
 *
 * $bot->setWebhook(URL);
 * $bot->delWebhook();
 * ?>
 * </code>
 *
 * @author      MoonLiightz <info@moonliightz.de>
 * @category	Telegram Bot
 * @link		https://github.com/MoonLiightz/PHP-Telegram-Class
 * @version		1.3.1
 * @since		21.10.2015
 */

namespace Telegram;

class Telegram
{
	/**
	* Telegram chat Id
	*
	* @var    string
	* @access private
	*/
	private $chatId;
	
	/**
	* Telegram Bot Token
	*
	* @var    string
	* @access private
	*/
	private $apiKey;
	
	/**
	* Telegram Bot URL
	*
	* @var    string
	* @access private
	*/
	private $url = 'https://api.telegram.org/bot';

	/**
	* Telegram Bot config
	*
	* @var    array
	* @access private
	*/
	private $config  = [];

	private $timeout = 6000;

	/**
	*
	* @param  string 
	* @access public
	*/
	public function __construct($config = [], $chatid = NULL, $apikey = NULL)
	{
		$this->config = $config;
		$this->apiKey = $config['apiKey'] ?? $apikey;
		$this->chatId = $config['chatId'] ?? $chatid;
	}
	
	/**
	* Anfrage an Telegram senden
	*
	* @param	string	$action
	* @param	array	$data
	* @return	array
	* @access	private
	*/
	private function send($action, $data = []) 
	{
		$action = ucfirst($action);
		$ch = curl_init($this->url . $this->apiKey . DIRECTORY_SEPARATOR . $action);
		curl_setopt_array($ch, [
			CURLOPT_POST    => true,
			CURLOPT_HEADER  => false,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_HTTPHEADER => [
				'Host: api.telegram.org',
				'Content-Type: multipart/form-data'
			],
			CURLOPT_POSTFIELDS 	   => $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CONNECTTIMEOUT => $this->timeout,
			CURLOPT_SSL_VERIFYPEER => false
		]);

		$result = curl_exec($ch);
		curl_close($ch);
		return !empty($result) ? json_decode($result, true) : false;
	}
	
	/**
	* Nachricht senden
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$chat_id					required	ID des Telegram Chats
	* @param	string	$text						required	Text der gesendet werden soll
	* @param	string	$parse_mode					optinal		Markdown oder HTML für z.B. fettgedruckte Texte
	* @param	boolean	$disable_web_page_preview	optinal		Legt fest ob Webpreview deaktivert werden soll
	* @param	boolean	$disable_notification		optinal		Benachrichtigung deaktivieren
	* @param	integer	$reply_to_message_id		optinal		Nachrichten ID für den "Antworten" Modus (reply)
	* @return	array
	* @access public
	*/
	public function sendMessage(
		$text, 
		$parse_mode = NULL,  
		$disable_web_page_preview = false, 
		$disable_notification = false, 
		$reply_to_message_id = NULL
	)
	{
		$action = 'sendMessage';
		$params = [
			'chat_id'			=> $this->chatId,
			'text'				=> $text,
			'parse_mode'		=> $parse_mode,
			'disable_web_page_preview' => $disable_web_page_preview,
			'disable_notification' => $disable_notification,
			'reply_to_message_id'  => $reply_to_message_id
		];
		
		$result = $this->send($action, $params);
		return (!$result['ok'])
			? ["success" => null, "info" => "Error: " . $result['description']]
			: ["success" => true, "info" => "Message send"];
	}
	
	/**
	* Bild senden
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$chat_id	required	ID des Telegram Chats
	* @param	string	$photo		required	Bild das gesendet werden soll
	* @param	string	$caption	optional	Bildbeschreibung
	* @return	array
	* @access	public
	*/
	public function sendPhoto($photo, $caption = NULL, $parse_mode = NULL)
	{
		$action = 'sendPhoto';
		$params = [
			'chat_id' => $this->chatId,
			'photo'	  => $this->curlFile($photo),
			'caption' => $caption,
			'parse_mode' => $parse_mode
		];

		$result = $this->send($action, $params);
		return (!$result['ok'])
			? ['success' => 0, 'info' => 'Error: ' . $result['description']]
			: ['success' => 1, 'info' => 'Photo send'];
	}
	
	/**
	* Dateien senden
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$chat_id	required	ID des Telegram Chats
	* @param	string	$document	required	Datei die gesendet werden soll
	* @return	array
	* @access	public
	*/
	public function sendDocument($document)
	{	
		$action = 'sendDocument';
		$params = [
			'chat_id'	=>	$this->chatId,
			'document'	=>	$this->curlFile($document)
		];
		
		$result = $this->send($action, $params);
		return (!$result['ok'])
			? ['success' => 0, 'info' => 'Error: ' . $result['description']]
			: ["success" => 1, "info" => 'Document send'];
	}
	
	/**
	* Audio senden
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$chat_id	required	ID des Telegram Chats
	* @param	string	$audio		required	Audio Datei die gesendet werden soll
	* @param	string	$interpret	optional	Interpret
	* @param	string	$title		optional	Titel
	* @return	array
	* @access	public
	*/
	public function sendAudio($audio, $interpret = NULL, $title = NULL)
	{	
		$action = 'sendAudio';
		$params = [
			'title'		=>	$title,
			'chat_id'	=>	$this->chatId,
			'audio'		=>	$this->curlFile($audio),
			'performer'	=>	$interpret
		];
		
		$result = $this->send($action, $params);
		return (!$result['ok'])
			? ['success' => 0, 'info' => 'Error: ' . $result['description']]
			: ['success' => 1, 'info' => 'Audio send'];
	}
	
	/**
	* Video senden
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$chat_id	required	ID des Telegram Chats
	* @param	string	$video		required	Viedeo das gesendet werden soll
	* @param	string	$caption	optional	Videobeschreibung
	* @return	array
	* @access	public
	*/
	public function sendVideo($video, $caption = NULL)
	{
		$action = 'sendVideo';
		$params = [
			'chat_id' => $this->chatId,
			'video'	  => $this->curlFile($video),
			'caption' => $caption
		];
		
		$result = $this->send($action, $params);
		return (!$result['ok'])
			? ['success' => 0, 'info' => 'Error: ' . $result['description']]
			: ["success" => 1, "info" => "Video send"];
	}
	
	/**
	* Chat Aktion senden
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$chat_id	required	ID des Telegram Chats
	* @param	integer	$type		required	1 => Nachrichten, 2 => Fotos, 3 => Viedeo aufnehmen, 4 => Viedeo senden/hochladen, 5 => Audio aufnehmen, 6 => Audio senden/hochladen, 7 => Dateien
	* @return	array
	* @access	public
	*/
	public function sendChatAction($type)
	{
		$do_action = '';
		
		switch($type) {
			case 1:
				$do_action = "typing";
				break;
			case 2:
				$do_action = "upload_photo";
				break;
			case 3:
				$do_action = "record_video";
				break;
			case 4:
				$do_action = "upload_video";
				break;
			case 5:
				$do_action = "record_audio";
				break;
			case 6:
				$do_action = "upload_audio";
				break;
			case 7:
				$do_action = "upload_document";
				break;
		}
		
		$action = 'sendChatAction';
		$params = [
			'chat_id' => $this->chatId,
			'action'  => $do_action
		];
		
		$result = $this->send($action, $params);
		return (!$result['ok'])
			? ['success' => 0, 'info' => 'Error: ' . $result['description']]
			: ["success" => 1, "info" => "Chat Action send"];
	}
	
	/**
	* User aus Gruppe kicken
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung
	*  )
	* </code>
	*
	* @param	string	$chat_id	required	ID des Telegram Chats
	* @param	integer	$userId	required	ID des Users der gekickt werden soll
	* @return	array
	* @access public
	*/
	public function kickChatMember($userId, $chatid = null)
	{
		$action = 'kickChatMember';
		$chatid = $chatid ?? $this->chatId;
		$params = [
			'chat_id' => $chatid,
			'user_id' => $userId
		];

		$result = $this->send($action, $params);
		return (!$res['ok'])
			? ["success" => 0, "info" => "Error: " . $result['description']]
			: ["success" => 1, "info" => "Member kicked"];
	}
	
	/**
	* Ban von einem User entfernen
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung
	*  )
	* </code>
	*
	* @param	string	$chatid	required	ID des Telegram Chats
	* @param	integer	$user_id	required	ID des Users der entbannt werden soll
	* @return	array
	* @access public
	*/
	public function unbanChatMember($userId, $chatid = null)
	{
		$action = 'unbanChatMember';
		$chatid = $chatid ?? $this->chatId;
		$param = [
			'chat_id' => $chatid,
			'user_id' => $userId
		];

		$result = $this->send($action, $param);
		return (!$result['ok'])
			? ["success" => 0, "info" => "Error: " . $result['description']]
			: ["success" => 1, "info" => "Member kicked"];
	}
	
	/**
	* Auswahl Keyboard zeigen
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$chat_id	required	ID des Telegram Chats
	* @param	string	$text		required	Text der gesendet werden soll
	* @param	array	$keyboard	required	Auswahlfelder z.B. array( array( "Zeile1 Test1", "Zeile1 Test2" ), array( "Zeile2 Test3", "Zeile2 Test4" ) )
	* @return	array
	* @access	public
	*/
	public function sendKeyboard($text, $keyboard = [], $chatid = null)
	{
		$action = 'sendMessage';
		$chatid = $chatid ?? $this->chatId;
		$params = [
			'chat_id'		=>	$chatid,
			'reply_markup'	=>	json_encode(['keyboard' => $keyboard]),
			'text'			=>	$text
		];

		$result = $this->send($action, $params);
		return (!$result['ok'])
			? ["success" => 0, "info" => "Error: " . $result['description']]
			: ["success" => 1, "info" => "Keyboard show"];
	}
	
	/**
	* Auswahl Keyboard ausblenden
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$chat_id	required	ID des Telegram Chats
	* @param	string	$text		required	Text der gesendet werden soll
	* @return	array
	* @access	public
	*/
	public function hideKeyboard($text, $chatid = null)
	{
		$action = 'sendMessage';
		$chatid = $chatid ?? $this->chatId;
		$params = [
			'chat_id'		=>	$chatid,
			'reply_markup'	=>	json_encode(['hide_keyboard' => true]),
			'text'			=>	$text
		];
		
		$res = $this->send($action, $params);
		return (!$res['ok'])
			? ["success" => 0, "info" => "Error: " . $res['description']]
			: ["success" => 1, "info" => "Keyboard hide"];
	}
	
	/**
	* Webhook setzen
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @param	string	$url	required	URL zu der Datei mit der der Telegram Bot verbunden werden soll
	* @return	array
	* @access	public
	*/
	public function setWebhook($url = NULL) 
	{
		$result = [];
		
		if (empty($url)) {
		  	$result = ['success' => 0, 'info' => 'Keine gültige URL angegeben'];
	   	}

		$url.= '?sender=telegram';
		$result = $this->send('setWebhook', ['url' => $url]);
		return (!$result['ok'])
			? ['success' => 0, 'info' => 'Webhook was not set! Error: ' . $result['description']]
			: ['success' => 1, 'info' => $result['description']];
	}
	
	/**
	* Webhook löschen
	*
	* <b>Output:</b><br>
	* <code>
	*  Array
	*  (
	*      [success] => 1 oder 0
	*      [info]	=> Zeigt Info oder Fehlermeldung	
	*  )
	* </code>
	*
	* @return	array
	* @access	public
	*/
	public function delWebhook() 
	{
		$result = [];
		$result = $this->send('setWebhook');
        return (!$result['ok'])
			? ['success' => 0, 'info' => 'Webhook was not delete! Error: ' . $result['description']]
			: ['success' => 0, 'info' => $result['description']];
	}
	
	/**
	* create curl file
	*
	* @param string $file
	* @return string
	*/
	private function curlFile($file)
	{
		$file = preg_match('/(www)|(http)|(https)/i', $file)
			? filter_var($file, FILTER_VALIDATE_URL)
			: realpath($file) ;

		return is_file($file) ? new CURLFile($file) : trim($file);
	}
	
	public function getUpdates($data)
	{
		$data = file_get_contents($data);
		return $data? json_decode($data): false;
	}
	
	public function getFile($data = []) 
	{
		if (!empty($data['message']['photo'])) {
			return null;
		}

		$file = array_pop($data['message']['photo']);
		$path = $this->url . $this->apiKey . DIRECTORY_SEPARATOR . __METHOD__;
		$post = [
			'file_id' => $file['file_id']
		];

		$ch = curl_init($path);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$result = json_decode($result);

		if (!$result['ok']) {
			return null;
		}
 
		$path  = $this->url . $this->key . DIRECTORY_SEPARATOR . $result['result']['file_path'];
		$dest = __DIR__ . DIRECTORY_SEPARATOR . time() . '-' . basename($src);
		copy($path, $dest);	
	}
}

?>
