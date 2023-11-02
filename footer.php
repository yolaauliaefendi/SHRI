		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
	<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="assets/js/theme/default.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/js/demo/table-manage-default.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<!--     <script src="assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script> -->
    <script src="assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
<!--     <script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
    <script src="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
    <script src="assets/plugins/clipboard/clipboard.min.js"></script> -->
	<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script> -->
  <script src="assets/js/chart/exporting.js"></script>
  <script src="assets/js/chart/export-data.js"></script>
	<script src="//code.highcharts.com/themes/dark-unica.js"></script>
	<script src="assets/js/demo/form-plugins.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageDefault.init();
			FormPlugins.init();
		});
	</script>
	<script>
        $(document).ready(function(){
            function fix_height(){
                var h = $("#tray").height();    
                $("#preview").attr("height", (($(window).height()) - h) + "px");
            }
            $(window).resize(function(){ fix_height(); }).resize();
            //$("#preview").contentWindow.focus();
        });
    </script>

<script type="text/javascript">
  $('#status_keluar').change(function() { 
    var statuskeluar = $(this).val(); 
    $.ajax({
      type: 'POST', 
      url: 'ajax_jurusan.php', 
      data: 'statuskeluar=' + statuskeluar, 
      success: function(response) { 
        $('#cara_keluar').html(response); 
      }
    });
  });
 
</script>

    <script type="text/javascript">
    Highcharts.chart('container', {
    chart: {
      type: 'areaspline'
    },
    title: {
      text: 'Grafik laporan rawat inap'
    },
    subtitle: {
        text: 'RSIA MUTIARA BUNDA PADANG'
      },
    legend: {
      layout: 'vertical',
      align: 'left',
      verticalAlign: 'top',
      x: 150,
      y: 100,
      floating: true,
      borderWidth: 1,
      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
      categories: [<?php
        foreach ($arrResultBangsal as $val) {
  echo "'".$val."', ";
} ?>
      ],
      plotBands: [{ // visualize the weekend
        from: 4.5,
        to: 6.5,
        color: 'rgba(68, 170, 213, .2)'
      }]
    },
    yAxis: {
      title: {
        text: 'Nilai'
      }
    },
    tooltip: {
      shared: true,
      valueSuffix: ''
    },
    credits: {
      enabled: false
    },
    plotOptions: {
      areaspline: {
        fillOpacity: 0.5
      }
    },

    series: [{
      name: 'BOR (%)',
      data: [<?php
        foreach ($arrResultBor as $val1) {
  echo $val1.", ";
} ?>]
    }, {
      name: 'ALOS (HR)',
      data: [<?php
        foreach ($arrResultAvlos as $val2) {
  echo $val2.", ";
} ?>]
    }, {
      name: 'BTO',
      data: [<?php
        foreach ($arrResultBto as $val3) {
  echo $val3.", ";
} ?>]
    }, {
      name: 'TOI',
      data: [<?php
        foreach ($arrResultToii as $val4) {
  echo $val4.", ";
} ?>]
    }, {
      name: 'NDR',
      data: [<?php
        foreach ($arrResultNdr as $val5) {
  echo $val5.", ";
} ?>]
    }, {
      name: 'GDR',
      data: [<?php
        foreach ($arrResultGdr as $val6) {
  echo $val6.", ";
} ?>]
    }]
  });
	Highcharts.setOptions({
  colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return {
      radialGradient: {
        cx: 0.2,
        cy: 0.3,
        r: 0.7
      },
      stops: [
        [0, color],
        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
      ]
    };
  })
});

	</script>

    <script type="text/javascript">

    		$(document).on('click', '.pilihPenyakit', function (e) {
                document.getElementById("idpenyakit").value = $(this).attr('data-idpenyakit');
                document.getElementById("nmpenyakit").value = $(this).attr('data-nmpenyakit');
                $('#modal-dialog1').modal('hide');
            });

            $(document).on('click', '.pilihPsn', function (e) {
                document.getElementById("idpasien").value = $(this).attr('data-idPasien');
                document.getElementById("namapasien").value = $(this).attr('data-nmPasien');
                document.getElementById("jeniskelamin").value = $(this).attr('data-nmJk');
                $('#modal-dialog').modal('hide');
            });

            $(document).on('click', '.pilihKK', function (e) {
                document.getElementById("idruangkelas").value = $(this).attr('data-idruangkelas');
                document.getElementById("kamar").value = $(this).attr('data-kamar');
                document.getElementById("kelas").value = $(this).attr('data-kelas');
                $('#modal-dialog1').modal('hide');
            });


            $(document).on('click', '.pilihPasien', function (e) {
                document.getElementById("idpasien").value = $(this).attr('data-idPasien');
                document.getElementById("namapasien").value = $(this).attr('data-nmPasien');
                document.getElementById("bangsalawal").value = $(this).attr('data-bangsalAwal');
                $('#modal-dialog').modal('hide');
            });

            $(document).on('click', '.pilihKeluar', function (e) {
                document.getElementById("idpasien").value = $(this).attr('data-idPasien');
                document.getElementById("idrmpasien").value = $(this).attr('data-idrmPasien');
                document.getElementById("namapasien").value = $(this).attr('data-nmPasien');
                document.getElementById("bangsal").value = $(this).attr('data-bangsal');
                document.getElementById("idbangsal").value = $(this).attr('data-idbangsal');
                document.getElementById("tglmasuk").value = $(this).attr('data-tglmasuk');
                $('#modal-dialog').modal('hide');
            });

            $(function () {
                $("#lookup").dataTable();
                $("#lookup1").dataTable();
            });
        </script>


<script type="text/javascript">
$(document).ready(function() {
   // var jhe=31;
   // var jtt=407;
   // var jpk=2182;
   // var jhp=9842;
   // var jld=9568;

   var jhe=<?php echo $jhee ?>;
   // var jtt=<?php //echo $jtt ?>;
   // var jpk=<?php //echo $jpk ?>;
   // var jhp=<?php //echo $jhp ?>;
   // var jld=<?php //echo $jld ?>;

   var bor=<?php echo $bor ?>;
   var los=<?php echo $los ?>;
   var toi=<?php echo $toi ?>;
   var bto=<?php echo $bto ?>;

   bor=bor.toFixed(2);
   los=los.toFixed(2);
   toi=toi.toFixed(2);
   bto=bto.toFixed(2);
   bor_i = Math.abs(bor);
   los_i = Math.abs(los);
   toi_i = Math.abs(toi);
   bto_i = Math.abs(bto);
   //garis bantu
   var bory = bor_i/10;
   var borx = 10 - bory;
   var btoxy  = jhe/bto;

   bory=bory.toFixed(2);
   borx=borx.toFixed(2);
   btoxy=btoxy.toFixed(2);

   bory  = Math.abs(bory);
   borx  = Math.abs(borx);
   btoxy = Math.abs(btoxy);

   // parsefloat(bor);
   // parsefloat(los);
   // parsefloat(toi);
   // parsefloat(bto);
   // parsefloat(bory);
   // parsefloat(borx);
   // parsefloat(btoxy);

   console.log(jhe);
   // console.log(jtt);
   // console.log(jpk);
   // console.log(jhp);
   // console.log(jld);
   console.log(bor);
   console.log(los);
   console.log(toi);
   console.log(bto);
   console.log(bory);
   console.log(borx);
   console.log(btoxy);

   $('#bor').val(bor); 
   $('#los').val(los); 
   $('#toi').val(toi); 
   $('#bto').val(bto); 
   
Highcharts.chart('gbj', {
title  : { text    : 'Grafik Barber-Jonhshon'     },
    subtitle: {
        text: 'RSIA MUTIARA BUNDA PADANG'
      },
tooltip: {
    formatter: function() {
        return 'Nilai X = <b>' + this.x + '</b> Nilai Y = <b>' + this.y + '</b>, Pada  '+ this.series.name;
    }
},
    xAxis: {
        // minPadding: 0.05,
        // maxPadding: 0.05,
        max: parseFloat(btoxy)+1,
        tickInterval:1,
        title: {
               text: 'TOI'
            }
    },
    yAxis: {
         max: 15,
         tickInterval:1,
            title: {
               text: 'ALOS'
            }
         },

    series: [
             { allowPointSelect: true, color: 'black', name: 'Posisi',  data: [ [parseFloat(toi_i), parseFloat(los_i)],[parseFloat(toi_i), parseFloat(los_i)]]},
             { color: 'green', name: 'BOR '+bor+'%', data: [ [0, 0], [parseFloat(borx), parseFloat(bory)], [parseFloat(borx)*5, parseFloat(bory)*5] ]},
             { color: 'blue', name: 'ALOS '+los, data: [ [0, parseFloat(los_i)], [parseFloat(toi_i)*5, parseFloat(los_i)] ]},/*color: 'blue', name: 'ALOS '+los, data: [ [0, parseFloat(los_i)], [parseFloat(toi_i), parseFloat(los_i)] ]},*/
             { color: 'orange', name: 'TOI '+toi, data: [ [parseFloat(toi_i), 0], [parseFloat(toi_i), parseFloat(los_i)*5] ]},
             { color: 'purple', name: 'BTO '+bto, data: [ [0, parseFloat(btoxy)], [parseFloat(btoxy), 0] ]},
             { dashStyle:'shortDash', name: 'Daerah Efisiensi', color: 'red', data: [ [1,12],[1,3],[3,9], [3, 12],[1,12] ] }
             ],
    exporting: {
        filename: 'Grafik Barber-Jonhshon'
    }
});

});
</script>
</body>
</html>