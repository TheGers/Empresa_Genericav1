<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="Assets/css/EstiloF.css">
	<link rel="stylesheet" href="Assets/css/all.css">
  <link rel="shortcut icon" href="<?= media();?>/images/icono.ico">
  <title><?= $data['page_tag']; ?></title>
	<title>Inicio</title>
</head>


<body>
	<!--MENU-->
	<nav id="menu">
		<a href="#hero">Inicio</a>
		<a href="#1">Acerca de</a>
		<a href="#2">servicios</a>
		<a href="#3">Contactos</a>
		<a href="https://empresagenerica.com/login">Ingresar</a>
		<span class="indicador" id="indicador"></span>
	</nav>


	<!--CONTENIDO-->
	<div class="secciones">

		<div class="seccion" id="hero">
			<!--INICIO-->
			<div class="wrap">
				<div class="wrap-texto">
					<h1>¡Bienvenido!</h1>
					<h1 class="etih">Al sistema de Inventarios y facturación</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="seccion" id="1">
		<div class="card">
			<h1>Acerca de</h1>
			<img class="EDIIMA" src="Assets/images/1.jpg" alt="">
			<p class="EDIP"> La Empresa de Estructuras Metálicas inicia operaciones
				para ser una fuente de ingreso por medio de una inversión
				de dinero. Se inicia con el fin de dar un servicio a la
				población de calidad, su llegada al mercado fue unos de los
				inicios de la comunidad ya que para ese entonces hace más de
				15 años no había una competencia laboral fuerte, con el inicio
				se demostró que era una empresa diferente a las pocas que había
				en su momento caracterizándose con su calidad de trabajo como en
				lo material como en su servicio. </p>
		</div>
	</div>

	<div class="seccion" id="2">
		<div class="card">
			<h1>Servicios</h1>
			<div class="slide">
				<div class="slide-inner">
					<input class="slide-open" type="radio" id="slide-1" name="slide" aria-hidden="true" hidden=""
						checked="checked">
					<div class="slide-item">
						<img class="im"
							src="https://meetbcn.com/wp-content/uploads/2022/01/scott-graham-5fNmWej4tAA-unsplash-scaled-e1641985133891.jpg">
					</div>
					<input class="slide-open" type="radio" id="slide-2" name="slide" aria-hidden="true" hidden="">
					<div class="slide-item">
						<img
							src="https://meetbcn.com/wp-content/uploads/2022/01/scott-graham-5fNmWej4tAA-unsplash-scaled-e1641985133891.jpg">
					</div>
					<input class="slide-open" type="radio" id="slide-3" name="slide" aria-hidden="true" hidden="">
					<div class="slide-item">
						<img
							src="https://www.linkgerencial.com/site/wp-content/uploads/2018/03/competencias-empresariales-mini.jpg">
					</div>
					<label for="slide-3" class="slide-control prev control-1">‹</label>
					<label for="slide-2" class="slide-control next control-1">›</label>
					<label for="slide-1" class="slide-control prev control-2">‹</label>
					<label for="slide-3" class="slide-control next control-2">›</label>
					<label for="slide-2" class="slide-control prev control-3">‹</label>
					<label for="slide-1" class="slide-control next control-3">›</label>
					<ol class="slide-indicador">
						<li>
							<label for="slide-1" class="slide-circulo">•</label>
						</li>
						<li>
							<label for="slide-2" class="slide-circulo">•</label>
						</li>
						<li>
							<label for="slide-3" class="slide-circulo">•</label>
						</li>
					</ol>
				</div>
			</div>
			<p class="EDIPs">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sit amet ante mattis,
				lacinia arcu nec, consequat massa. Aliquam faucibus quam eget justo posuere vehicula. Donec ac fermentum
				dolor, rhoncus congue sapien. Maecenas lacinia tellus nec turpis tempor pellentesque. Praesent in erat a
				nisl viverra dapibus. Pellentesque feugiat dolor quis sapien rutrum, sed placerat est volutpat.
				Curabitur sed convallis lacus, vel molestie ante. </p>
		</div>
	</div>
	</div>


	<div class="seccion" id="3">
		<div class="card">
			<h1>Contactos</h1>
			<img class="EDIIMA" src="Assets/images/1.jpg" alt="">
			<p class="EDIPC">
			</p>
			<div class="DaCot">
				<p><i class="fa-solid fas fa-location-dot fa-2xl"></i>
				<div class="EDID">198 West 21th Street, Suite 721 New York NY 10016</div>
				</p>

				<p><i class="fa-solid fa fa-phone fa-2xl"></i> <a class="tcs" href="tel://1234567920">+ 1235 2355 98</a>
				</p>

				<p><i class="fa-solid fa fa-envelope fa-2xl"></i><a class="tcs"
						href="mailto:info@yoursite.com">info@yoursite.com</a></p>

				<p><i class="fa-solid fa fa-globe fa-2xl "></i> <a class="tcs" href="#">yoursite.com</a></p>
			</div>



		</div>
	</div>

	<script src="app.js"></script>


</body>

</html>