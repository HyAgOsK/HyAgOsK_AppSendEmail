<?php 
	
	require './PHPMailer/src/Exception.php';
	require './PHPMailer/src/OAuth.php';
	require './PHPMailer/src/PHPMailer.php';
	require './PHPMailer/src/POP3.php';
	require './PHPMailer/src/SMTP.php';
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//https://packagist.org/packages/phpmailer/phpmailer
	//composer ainda nao utilizamos, portanto iremos fazer de forma manual --> https://github.com/PHPMailer/PHPMailer
	// necessário verificar a versão, se é compatível com PHP 8 , 7. no caso https://github.com/PHPMailer/PHPMailer/tree/v6.4.1
	//usamos esta acima, que podemos verificar como funciona no próprio site do github


	class Mensagem{

		private $para = null;
		private $assunto = null;
		private $mensagem = null;
		public $status = array('codigo_status' => null, 'descricao_status' => '');

		public function __get($atributo){
			return $this->$atributo;
		}

		public function __set($atributo, $valor){
			$this->$atributo = $valor;
		}


		//validacao dos dados para seguir ou nao
		public function mensagemValida(){
			//verificando se o atributo para esta vazio, se estiver é true ... 
			if (empty($this->para) || empty($this->assunto)  || empty($this->mensagem) ) {
				//falta assim no caso preencher alguma coisa 
				return false;
			}
			return true;

		}

	}

	$mensagem = new Mensagem();
	$mensagem->__set('para',$_POST['para']);
	$mensagem->__set('assunto',$_POST['assunto']);
	$mensagem->__set('mensagem',$_POST['mensagem']);


	//print_r($mensagem);
	//retorno da funcao é true ou false assim entrando no if
	if (!$mensagem->mensagemValida()) {
		//echo '<p><h1><strong>Mensagem nao válida</strong></h1></p>';
		//die() mata o processamento caso caia aqui no mensagem nao válida
		//die();
		//tudo abaixo de die é descartado
		header('Location: index.php');
	
		//Aqui poderíamos fazer uma mensagem aparecer no browserr;
	}

	//Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    //Enable verbose debug output
	    //LOG DO SMTP DE ENVIO DE EMAILS ----> $mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->SMTPDebug = false;
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'email@example.com';                     //SMTP username
	    $mail->Password   = 'senhacriadapelogmail';                               //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('email@example.com', 'exemploconta');
	    $mail->addAddress($mensagem->__get('para'));     //Add a recipient
	  
	  	//$mail->addAddress('ellen@example.com');  Name is optional --> pode usar quantos quiser
	  	//$mail->addReplyTo('info@example.com', 'Information'); contato padrao caso o destinatário queira responder o remetente
	    //$mail->addCC('cc@example.com'); ainda nao temos destinatários em cópia assim não precisamos
	    //$mail->addBCC('bcc@example.com'); também como cópia oculta

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments adicionar anexos no email, ainda não usaremos isso
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name e nome opcional para imagem logo, etc que fica no corpo do email

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = $mensagem->__get('assunto'); // conteúdo do assunto
	    // formatação de e-mail, para clients, e tem como colocar marcação HTML, 
	    $mail->Body    = $mensagem->__get('mensagem'); // conteúdo do email, corpo do email
	    //e sem HTML
	   	$mail->AltBody = $mensagem->__get('mensagem');

	    if (!$mail->send()) {    	
		    $mensagem->status['codigo_status'] = 2;
    		$mail->Body = '<p>Desculpe, ocorreu um erro de DNS. Tente novamente mais tarde.</p>';
		    $mensagem->status['descricao_status'] = $mail->Body; 
	    }else{
	    	$mensagem->status['descricao_status'] = 'E-mail enviado para o destinatário <strong>' . $mensagem->__get('para').'</strong><br>Através do e-mail que envia os dados será possível verificar se realmente enviado este e-mail';   		
		    $mensagem->status['codigo_status'] = 1;
	    } 
	     
	} catch (Exception $e) {

	    $mensagem->status['codigo_status'] = 2;
	    //echo $emailusuario;
		//$mensagem->status['descricao_status'] =  $mail->ErrorInfo;
	    $mensagem->status['descricao_status'] = $mail->ErrorInfo;
	    //aqui podemos colocar a lógica dos erros com acesso direto ou também erros de qualquer que seja naturalidade
	    //************************************************************************************************************
	    //peguei apenas os caracteres de um e-mail inválido, ou espaço apenas, e coloquei para ler o erro 
	    //que vem por padrão como Invalid Address, assim lendo isto, e verificando no condicional abaixo, eu consigo alterar a mensagem de erro enviada ao usuário de forma que coloque algo mais interessante como o que ele colocou de dados
	   
	 	$verificacaoEmail = filter_var($mensagem->__get('para'), FILTER_VALIDATE_EMAIL);
		$verificacaoEmailUrlPath = filter_var($mensagem->__get('para'), FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
			

		// Verifica se o domínio responde à função checkdnsrr.
		$dominio=explode('@',$mensagem->__get('para'));
		$dominio = array_pop($dominio);
		$email_domainError = $mensagem->__get('para'); 
		$regex = '/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/';
		$email_error = $mensagem->__get('para'); 
		$email_error = filter_var($email_error, FILTER_SANITIZE_EMAIL);
	  $erroEmail = substr($mensagem->status['descricao_status'],0,15);

		if ((!checkdnsrr($dominio) ) || (!$verificacaoEmail ) || (!$verificacaoEmailUrlPath ) || (!preg_match($regex, $email_domainError)==0) || (!filter_var($email_error, FILTER_VALIDATE_EMAIL )) || (!strpos($mensagem->__get('para'),'@')) || ($erroEmail  == 'Invalid address')){
			$mensagem->status['descricao_status'] = '<h3>O E-mail: <strong>'. $mensagem->__get('para').'</strong> não é válido!!!</h3><br><h2 class="text-danger">Verifique novamente por gentileza:</h2><br><ul><li>Se está utilizando um nome de usuário correto</li><li>Se foi utilizado um domínio existente e correto para o e-mail que deseja enviar!</li><li>Verifique se foi colocado caracteres especiais</li><li>Veja se foi utilizado o @ para o e-mail que deseja enviar!</li></ul>';
		}

	}

	// Atualmente a opção de "apps menos seguros" não está mais autorizada pelo Google. Agora precisamos gerar uma senha exclusiva para este fim, mas não se preocupe, é só seguir as orientações deste artigo!

	//Para configurar uma senha exclusiva para o seu projeto, acesse a conta de e-mail do Gmail que será utilizada em seu projeto e siga os passos: 

	/*
	1 - Clique na opção "Gerenciar sua Conta do Google":
	2 - Clique na opção "Segurança":
	3 - Ative a opção de "Verificação em duas etapas":
	4 - Clique na opção "Senhas de app":
	5 - Clique na opção "Selecione o app e o dispositivo para o qual você quer gerar a senha de app" e escolha a opção "Outro":
	6 - Defina um nome (pode ser qualquer nome) e depois clique em "gerar"
	7 - A senha será gerada, basta copiá-la:
	8 - Na próxima aula, utilize a senha copiada no passo 7 no arquivo de configuração de envio de e-mail (processa_envio.php):

	*/
	
?>
<html>
<head>
	<meta charset="utf-8" />
    <title>App Mail Send</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <style>
      body {
        background-color: rgba(0, 255, 255, 0.3);
        overflow-x: hidden;
        /*overflow-y: hidden;*/
      }
    </style>
</head>
<body>
	<div class="container">
		<div class="py-3 text-center">
			<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
			<h2>Send Mail</h2>
			<p class="lead" style="color: rgba(0, 180, 200, 1.0);"><b>Your special app send mails</b></p>
		</div>
	</div >
	<div class="row">
		<div class="col-md-12">
			<? if ($mensagem->status['codigo_status'] == 1) {?>
				<div class="container">
					<h1 class="display-4 text-success">
						Sucesso
					</h1>
					<p style = "font-size: x-large;" class="text-success"><b><?=$mensagem->status['descricao_status']?></b></p>
					<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
				</div>
			<?}?>
			<? if ($mensagem->status['codigo_status'] == 2) {?>
				<div class="container">
					<h1 class="display-4 text-danger">
						Ops! Este e-mail não foi enviado ! Veja corretamente os dados preenchidos!
					</h1>
					
					<p style="font-size: x-large;"><?=$mensagem->status['descricao_status']?></p>
					<a href="index.php" class="btn btn-danger btn-lg mt-5 text-white">Voltar</a>
					
				</div>
			<?}?>
		</div>

	</div>
</body>
</html>