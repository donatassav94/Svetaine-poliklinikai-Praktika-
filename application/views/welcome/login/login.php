<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body class="login-img3-body">
<div class="container">
		<?php if (validation_errors()) : ?>			
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>			
		<?php endif; ?>
		<?php if (isset($error)) : ?>			
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
		<?php endif; ?>
			<?= form_open() ?>
				<form class="login-form" action="home.php">        
        			<div class="login-wrap">
            		 <p class="login-img"><i class="icon_lock_alt"></i></p>
            	<!-- Username laukelis --> 
           		<div class="input-group">
             		 <span class="input-group-addon"><i class="icon_profile"></i></span>
             		 <input type="text" class="form-control" id="Prisijung_vardas" name="Prisijung_vardas" placeholder="Prisijungimo vardas" autofocus>
           		</div>
           		<!-- Password laukelis -->
				<div class="input-group">
                	<span class="input-group-addon"><i class="icon_key_alt"></i></span>
                	<input type="password" class="form-control" id="password" name="password" placeholder="Slaptažodis">
            	</div>
            	<!-- Checkbox -->
            	<label class="checkbox">
                	<input type="checkbox" value="remember-me"> Atsiminti
                	<span class="pull-right"> <a href="#"> Užmiršote slaptažodį?</a></span>
            	</label>
          		<!-- Login ir Signup mygtukai -->
          		<button class="btn btn-warning btn-lg btn-block"> <a href="<?= base_url('register')?>">Registruotis</a></button>
				<button class="btn btn-primary btn-lg btn-block" type="submit">Prisijungti</button>
				 
			</form>
		
</div><!-- .container -->
</body>