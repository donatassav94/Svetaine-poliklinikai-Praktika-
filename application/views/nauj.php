<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
	<body>
<section id="main-content">
          <section class="wrapper"> 
<?php foreach ($vienanaujiena as $value): ?>
		<!-- Page Content -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-8 col-sm-4">
					<div class="page-header">
						<h1><?php echo $value['Pavadinimas']; ?></h1>
						<p>Paskelbta <span class="glyphicon glyphicon-user"></span> <a href="#">Administratoriaus</a>  <span class="glyphicon glyphicon-time"></span> <?php echo $value['Sukurimo_data']; ?></p>
					</div>
				</div>
			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-sm-8 col-sm-4">
					<?php echo $value['Tekstas']; ?>
					<br>
					<?php foreach ($failai as $file):?><!-- Isgaunami naujienai priklausantys failai(lyginami id)-->
                    <?php if($value['id']==$file['idNaujienos']):?>
                    <?php $nuoroda=$file['Pavadinimas']; echo anchor('user/download/'.$nuoroda,$file['Pavadinimas']); ?>
                    <?php endif; ?>
                    <?php endforeach ?>
				</div>
			</div>
			
				<?php endforeach; ?>
		     </section>
  	</section>
		<!-- /.container-fluid -->
  </body>}

