<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
	.checkbox-window { border:2px solid #ccc; width:300px; height: 100px; overflow-y: scroll; }
	.slepti{ display:none !important;}
</style>
  <body>
  	<!--Pagrindinis puslapis-->
      <section id="main-content">
          <section class="wrapper">            
              <!--Pradzia-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Naujiena</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?= base_url('home')?>">Pradinis</a></li>
						<li><i class="fa fa-laptop"></i>Naujiena</li>						  	
					</ol>
				</div>
			</div>
			
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
			<?= form_open_multipart('naujiena'); ?>
		<!--pranesimas-->
		<div class="row">
			<div class="col-md-9 portlets">
            <div class="panel panel-default">
				<div class="panel-heading">
                  <h2><strong>Pranešimas</strong></h2> 
                </div><br><br><br>
                <div class="panel-body">
                  <!-- Widget content -->
                  
                                      <!-- Edit profile form (not working)-->
                                      <form class="form-horizontal">
                                          <!-- Antraštė -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="antraste">Antraštė</label>
                                            <div class="col-lg-12"> 
                                              <input type="text" class="form-control" align="left" id="antraste" name="antraste">
                                            </div>
                                          </div> 
                                            
                                          <!-- Tekstas -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tekstas">Tekstas</label>
                                            <div class="col-lg-12">
                                              <textarea class="form-control" id="tekstas" name="tekstas"></textarea>
                                            </div>
                                          </div>  
                                                        
                                          <!-- Tipas  -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2">Žinutės tipas</label>
                                            <div class="col-lg-12">                               
													<input type="radio" id="tip" name="tip" class="tipas" value="1"/>Bendra
												 	<input type="radio" id="tip" name="tip" class="tipas" value="0"/>Skirta kažkam
                                            </div>
                                          </div> 
                                                                                
                                          <!-- Jei skirta kazkam tai atsiranda sita forma--> 
                                            <div id="paleisti" class="slepti">
                                            	<div id="pasirinkimas" class="form-group"  >
                                            		<label class="control-label col-lg-2">Pasirinkimas</label>
                                            		<div class="col-lg-12">   
                                            			<div  class="checkbox-window"> 
			                                            	<?php foreach ($sarasas as $object): ?>                           
																<input type="checkbox" name="pasirinkimas[]" class="pasirinkimas" value="<?php echo $object->id?>"><?php echo $object->Vardas; ?> <?php echo $object->Pavardė; ?>
																<br />
															<?php endforeach ?>
														</div>
                                            		</div>
                                          		</div>   
                                          	</div> 
                                          <!-- Failo kelimas-->   
											<div class="form-group">
                                            <label class="control-label col-lg-2">Failo kelimas</label>
                                            <div class="col-lg-6">                               
													<input type="hidden" name="MAX_FILE_SIZE" value="10485760"> <!--iki 10mb(10*1024*1024)-->
													<input type="file" multiple="" name="failas[]"> 
											</div>
                                          </div> 
                                              <!-- fgfgfggfgfg  
                                          <div class="form-group">
                                            <label class="control-label col-lg-2">Žinutės tipas</label>
                                            <div class="col-lg-12">                               
													<input type="checkbox" name="cekis[]" class="tipas" value="1"/>1
												 	<input type="checkbox" name="cekis[]" class="tipas" value="2"/>2 
												 	<input type="checkbox" name="cekis[]" class="tipas" value="3"/>3
												 	<input type="checkbox" name="cekis[]" class="tipas" value="4"/>4                                         </div>
                                          </div> -->
                                          
                                          <!-- Mygtukai -->
                                          <div class="form-group">
											 <div class="col-lg-offset-2 col-lg-9">
												<button type="submit" class="btn btn-primary">Skelbti</button>
												<button type="reset" class="btn btn-default">Naujas pranešimas</button>
											 </div>
                                          </div>
                                      </form>
                                    </div>
    
                  </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>
                            
            </div>
                        
          </div> 
              <!-- project team & activity end -->

          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->
  </body>
