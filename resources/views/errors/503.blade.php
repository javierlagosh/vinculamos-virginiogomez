<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sitio web en construcción</title>
	<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.coverPage {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
			background-image: url(../img/background.jpg);
			background-repeat: no-repeat;
			background-size: cover;
			position: relative;
		}

		.coverPage:before {
			content: '';
			display: block;
			position: absolute;
			background: rgba(0, 0, 0, 0.904);
			opacity: .8;
			width: 100vw;
			height: 100vh;
			top: 0;
		}

		.__coverPage-content {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			color: white;
			height: 50%;
			width: 75%;
			z-index: 1000;
			text-align: center;
			opacity: .9;
			padding: 1em;
		}

		.__coverPage-content h1 {
			font-size: 2em;
			color: #F9A825;
			opacity: .9;
		}

		.__coverPage-content h2 {
			font-size: 1.8em;
			margin-bottom: 1em;
		}

		.__coverPage-content h3 {
			font-size: 1.5em;
			margin-bottom: 0.5em;
			text-transform: uppercase;
			opacity: .8;
		}

		.__coverPage-content p {
			font-size: 1.1em;
			margin-bottom: 1.5em;
			line-height: 1.6;
			opacity: .8;
		}

		.socialIcon {
			margin-right: 10px;
			opacity: .7;
		}

		.socialIcon i {
			display: inline-flex;
			justify-content: center;
			align-items: center;
			font-size: 20px;
			border: 2px solid white;
			border-radius: 50%;
			padding: 15px;
			height: 25px;
			width: 25px;
			transition: all .3s;
		}

		.socialIcon i:hover {
			color: #F9A825;
			border-color: #F9A825;
		}

		@media screen and (max-width: 991px) {
			.__coverPage-content {
				width: 100%;
			}
		}
	</style>
</head>
<body>
	<div class="coverPage">
		<div class="__coverPage-content">
			<h1>
				<img src="/img/template.png" style="max-width: 75%;" alt="Logo de VINCULAMOS">
			</h1>
            <h3 style="font-size: 1.5em; margin-bottom: 0.5em; text-transform: uppercase; opacity: 0.8;">
                <i class="fas fa-wrench" style="color: #F9A825;"></i> Esta página está en mantenimiento <i class="fas fa-wrench" style="color: #F9A825;"></i>
            </h3>
            <p style="font-size: 1.1em; margin-bottom: 1.5em; line-height: 1.6; opacity: 0.8;">
                Estamos trabajando arduamente <i class="fas fa-hammer" style="color: #F9A825;"></i> para mejorar tu experiencia en línea y potenciar el futuro de tu empresa.
                Nuestro equipo en VINCULAMOS está preparando novedades emocionantes y cambios significativos <i class="fas fa-cogs" style="color: #F9A825;"></i> para brindarte un sitio web renovado y lleno de innovación.
                Mientras tanto, si tienes alguna consulta <i class="fas fa-question-circle" style="color: #F9A825;"></i> o necesitas asistencia, no dudes en contactarnos a través de nuestro correo electrónico o redes sociales.
            </p>
            
			<div class="socialMedia">
				<a class="socialIcon" href="https://www.linkedin.com/in/vinculamos-cl-9aa16b189/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
