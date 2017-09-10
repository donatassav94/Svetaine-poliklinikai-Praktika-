<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
	<section id="main-content">
          <section class="wrapper"> 
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Asmeninės naujienos </h3>
				</div>
			</div>
			<!-- inbox notificatoin start-->
                 
			<?php foreach (array_reverse($asmnewvisos) as $arr): ?>
				<form class="form-group" action="<?= base_url('User/naujienav') ?>">
                <div class="qa-message-list" id="wallmessages">
                
                    <div class="message-item" id="m9">
                        <div class="message-inner">
                            <div class="message-head clearfix">
                                
                                <div class="user-detail">
                                    <h5 class="handle"><?php echo $arr['Pavadinimas']; ?></h5>
                                    <div class="post-meta">
                                        <div class="asker-meta">
                                            <span class="qa-message-what"></span>
                                            <span class="qa-message-when">
												<span class="qa-message-when-data"><?php echo $arr['Sukurimo_data']; ?></span>
                                            </span>
                                         
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="qa-message-content">
                            	<input type="hidden" name="naujid" id="naujid" value="<?php echo $arr['id']; ?>">
								<input type="submit" class="btn btn-success" value="Žiūrėti žinutę...">
                           		<br>
                           		
                            </div>
                        </div>
                     </div>
       		 </div>
       		</form>
        <?php endforeach ;?>
        <!-- inbox notificatoin end -->
        
                        </section>
  	</section> 
  	</body>
  	</html>                 