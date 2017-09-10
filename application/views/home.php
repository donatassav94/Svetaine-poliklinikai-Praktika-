<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  <body>
      <!--Pagrindinis puslapis-->
      <section id="main-content">
          <section class="wrapper">            
              <!--Title ir zingsniu linkai-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Bendrų naujienų srautas </h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?= base_url('home')?>">Pradinis</a></li>				  	
					</ol>
				</div>
			</div>
			 <!--Title ir zingsniu linkai pabaiga-->
		<!-- Timeline(Naujienų srautas)pradžia -->
        <div class="featurette" id="about">
            <div class="container">
<!--Naujienos-->
		<div class="qa-message-list" id="wallmessages">
			<?php foreach (array_reverse($naujiena) as $arr): ?>	
			
                <div class="qa-message-list" id="wallmessages">
                    <div class="message-item" id="m9">
                        <div class="message-inner">
                            <div class="message-head clearfix">
                                <div class="avatar pull-left">
                                    <img src="img/defaultprofile.png">
                                </div>
                                <div class="user-detail">
                                    <h5 class="handle"><?php echo $arr['Pavadinimas']; ?></h5>
                                    <div class="post-meta">
                                        <div class="asker-meta">
                                            <span class="qa-message-what"></span>
                                            <span class="qa-message-when">
												<span class="qa-message-when-data"><?php echo $arr['Sukurimo_data']; ?></span>
                                            </span>
                                            <span class="qa-message-who">
												<span class="qa-message-who-pad">-</span>
                                            <span class="qa-message-who-data"><a href="./index.php?qa=user&qa_1=amiya">Adminas</a></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="qa-message-content">
                            	<?php echo $arr['Tekstas'];?> <!-- Naujienos tekstas -->
                            	<br>
                           		<?php foreach ($failai as $file):?><!-- Isgaunami naujienai priklausantys failai(lyginami id)-->
                           		<?php if($arr['id']==$file['idNaujienos']):?>
                           		<?php $nuoroda=$file['Pavadinimas']; echo anchor('user/download/'.$nuoroda,$file['Pavadinimas']); ?>
                           		<?php endif; ?>
                           		<?php endforeach ?>
                            </div>
                        </div>
                     </div>
                 </div>
               
           <?php endforeach ?>
        </div>
<!--Naujienos pabaiga-->
            <!-- Timeline(Naujienų srautas)pabaiga -->
      </section>
  	</section>
  <!--Pagrindinis puslapis pabaiga-->
  </body>
</html>