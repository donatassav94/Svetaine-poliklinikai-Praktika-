<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	</main><!-- #site-content -->

	<footer id="site-footer" role="contentinfo">
	</footer><!-- #site-footer -->

	<script>
//alert('aa');
$(".tipas").change(function() {
  if (this.value == "1") {
        $('#paleisti').addClass('slepti');
  }if (this.value == "0") {
        $('#paleisti').removeClass('slepti');
    }
});
//alert('bb');
</script>
    <!-- javascripts -->
    
    <!-- bootstrap -->
    <script src="<?= base_url('') ?>js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="<?= base_url('') ?>js/jquery.scrollTo.min.js"></script>
    <script src="<?= base_url('') ?>js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="<?= base_url('') ?>assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="<?= base_url('') ?>js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?= base_url('') ?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?= base_url('') ?>js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <<script src="<?= base_url('') ?>js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="<?= base_url('') ?>assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="<?= base_url('') ?>js/calendar-custom.js"></script>
	<script src="<?= base_url('') ?>js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="<?= base_url('') ?>js/jquery.customSelect.min.js" ></script>
	<script src="<?= base_url('') ?>assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="<?= base_url('') ?>js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="<?= base_url('') ?>js/sparkline-chart.js"></script>
    <script src="<?= base_url('') ?>js/easy-pie-chart.js"></script>
	<script src="<?= base_url('') ?>js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?= base_url('') ?>js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?= base_url('') ?>js/xcharts.min.js"></script>
	<script src="<?= base_url('') ?>js/jquery.autosize.min.js"></script>
	<script src="<?= base_url('') ?>js/jquery.placeholder.min.js"></script>
	<script src="<?= base_url('') ?>js/gdp-data.js"></script>	
	<script src="<?= base_url('') ?>js/morris.min.js"></script>
	<script src="<?= base_url('') ?>js/sparklines.js"></script>	
	<script src="<?= base_url('') ?>js/charts.js"></script>
	<script src="<?= base_url('') ?>js/jquery.slimscroll.min.js"></script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });
	  //profile knob
      		$(".knob").knob();
      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});



  </script>