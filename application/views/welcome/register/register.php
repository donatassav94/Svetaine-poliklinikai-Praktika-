<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body class="login-img3-body">
<div class="container">
	<div class="row">
		<?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="col-md-12">
			<div class="page-header">
				<h1>Registracija</h1>
			</div>
			<?= form_open() ?>
			<!-- Prisijungimo vardas -->
				<div class="form-group">
					<label for="Prisijung_vardas">Prisijungimo vardas</label>
					<input type="text" class="form-control" id="Prisijung_vardas" name="Prisijung_vardas" placeholder="Įveskite prisijungimo vardą">
					<p class="help-block">Mažiausiai 4 simbolių</p>
				</div>
				<!-- Vardas -->
				<div class="form-group">
					<label for="Vardas">Vardas</label>
					<input type="text" class="form-control" id="Vardas" name="Vardas" placeholder="Įveskite vardą">
				</div>
				<!-- Pavardė -->
				<div class="form-group">
					<label for="Pavarde">Pavardė</label>
					<input type="text" class="form-control" id="Pavarde" name="Pavarde" placeholder="Įveskite pavardę">
				</div>
				<!-- Spaudo nr. -->
				<div class="form-group">
					<label for="Spaudas">Spaudo nr.</label>
					<input type="text" class="form-control" id="Spaudas" name="Spaudas" placeholder="Įveskite spaudo nr.">
					<p class="help-block">Spaudo numerį gali sudaryti tik skaičiai.</p>
				</div>
				<!-- Telefonas -->
				<div class="form-group">
					<label for="Telefonas">Telefono nr.</label>
					<input type="text" class="form-control" id="Telefonas" name="Telefonas" placeholder="Įveskite telefono numerį">
					<p class="help-block">Turi prasidėti 86....</p>
				</div>
				<!-- Rolė -->
				<div class="form-group">
					<label for="Role">Rolė</label>
					<input type="text" class="form-control" id="Role" name="Role" placeholder="Įveskite rolę">
				</div>
				<!-- Paštas -->
				<div class="form-group">
					<label for="email">Paštas</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Įveskite pašto adresą">
				</div>
				<!-- Slaptažodis -->
				<div class="form-group">
					<label for="password">Slaptažodis</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Įveskite slaptažodį">
					<p class="help-block">Mažiausiai 6 simboliai</p>
				</div>
				<!-- Slaptažodžio patvirtinimas -->
				<div class="form-group">
					<label for="password_confirm">Patvirtinkite slaptažodį</label>
					<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Įveskite slaptažodį dar kartą">
					<p class="help-block">Slaptažodžiai turi sutapti</p>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Baigti registraciją" id="submit">
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->