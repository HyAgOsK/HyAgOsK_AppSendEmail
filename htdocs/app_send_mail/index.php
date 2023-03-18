<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	</head>

	<body style="background-color: rgba(0, 255, 255, 0.3);">

		<div class="container">  

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead" style="color: rgba(0, 180, 200, 1.0); font-size: x-large;"><b>Seu aplicativo de envio de emails especiais através do <span style="color: #000; font-size: xx-large;">G-mail</span></b></p>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="width: 100px; height: 100px;"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
					<path d="M96 0C78.3 0 64 14.3 64 32V224h96V192c0-35.3 28.7-64 64-64H448V32c0-17.7-14.3-32-32-32H96zM224 160c-17.7 0-32 14.3-32 32v32h96c35.3 0 64 28.7 64 64V416H544c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32H224zm240 64h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H464c-8.8 0-16-7.2-16-16V240c0-8.8 7.2-16 16-16zM32 256c-17.7 0-32 14.3-32 32v13L155.1 415.9c1.4 1 3.1 1.6 4.9 1.6s3.5-.6 4.9-1.6L320 301V288c0-17.7-14.3-32-32-32H32zm288 84.8L184 441.6c-6.9 5.1-15.3 7.9-24 7.9s-17-2.8-24-7.9L0 340.8V480c0 17.7 14.3 32 32 32H288c17.7 0 32-14.3 32-32V340.8z"/></svg>
			</div>

      		<div class="row">
      			<div class="col-md-12">
  				
					<div class="card-body font-weight-bold">
						<form action="processa_envio.php" method="post">
							<div class="form-group">
								<!--Lembrar de colcoar sempre name para cada input ou qualquer dado que é usado para enviar os dados para backend-->
								<label for="para" style="font-size: x-large;">Para &nbsp; <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 30px; height: 30px;"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg></label>
								<input name="para" type="text" class="form-control" id="para" placeholder="example@gmail.com.br">
							</div>

							<div class="form-group">
								<label for="assunto"  style="font-size: x-large;">Assunto &nbsp; <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 30px; height: 30px;"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M360.2 83.8c-24.4-24.4-64-24.4-88.4 0l-184 184c-42.1 42.1-42.1 110.3 0 152.4s110.3 42.1 152.4 0l152-152c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-152 152c-64 64-167.6 64-231.6 0s-64-167.6 0-231.6l184-184c46.3-46.3 121.3-46.3 167.6 0s46.3 121.3 0 167.6l-176 176c-28.6 28.6-75 28.6-103.6 0s-28.6-75 0-103.6l144-144c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-144 144c-6.7 6.7-6.7 17.7 0 24.4s17.7 6.7 24.4 0l176-176c24.4-24.4 24.4-64 0-88.4z"/></svg></label>
								<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Subjected e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem"  style="font-size: x-large;">Mensagem &nbsp; <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 30px; height: 30px;"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M366.4 18.3L310.7 74.1 435.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L445.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM286 94.6l-9.2 2.8L132.7 140.6c-19.9 6-35.7 21.2-42.3 41L1.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L162.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L31.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.8-9.2L286 94.6z"/></svg></label>
								<textarea name="mensagem" class="form-control" id="mensagem" placeholder="Write your menssage in this area"></textarea>
							</div>

							<button  style="font-size: x-large;" name='butao' type="submit" class="btn btn-primary btn-lg">Enviar mensagem</button>
						</form>
					</div>
				</div>
      		</div>
      	</div>

	</body>
	<footer style="text-align: center; color: rgba(0, 180, 200, 1.0);  font-size: x-large;"> <b>&copy; <u>App Send Mail. por Hyago Vieira</u><br>Agradeço pela preferência</b> </footer>
</html>