<!doctype html>
<html lang="en">
  <head>

	  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23bb6ee7%22></rect><path d=%22M65.17 79.32L65.17 82.72L34.83 82.72L34.83 79.32Q37.72 79.24 39.46 78.77Q41.20 78.30 42.14 77.03Q43.07 75.75 43.41 73.42Q43.75 71.08 43.75 67.08L43.75 67.08L43.75 32.91Q43.75 29.34 43.45 27.01Q43.16 24.67 42.31 23.31Q41.46 21.95 39.89 21.40Q38.31 20.84 35.68 20.67L35.68 20.67L35.68 17.27L64.32 17.27L64.32 20.67Q61.69 20.84 60.12 21.40Q58.54 21.95 57.69 23.31Q56.84 24.67 56.55 27.01Q56.25 29.34 56.25 32.91L56.25 32.91L56.25 67.08Q56.25 71.08 56.55 73.42Q56.84 75.75 57.82 77.03Q58.80 78.30 60.54 78.77Q62.28 79.24 65.17 79.32L65.17 79.32Z%22 fill=%22%23fff%22></path></svg>" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INTERVAL QTL portal</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src='https://cdn.plot.ly/plotly-2.9.0.min.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.11.4/features/scrollResize/dataTables.scrollResize.min.js"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locuszoom@0.13.4/dist/locuszoom.css" type="text/css" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/d3@^5.16.0" type="application/javascript"></script>
    <script src="/locuszoom.app.min.js" type="application/javascript"></script>


    <!-- Custom styles for this template -->
    <link href="/css/sticky-footer-navbar.css" rel="stylesheet">

    <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
  </style>

  </head>

  <body>

<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
<a class="navbar-brand" href="#">QTL-Portal</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="/">Home</a></li>
<?php
        $servername = "mysql-server";
        $username = "root";
        $password = "test";
        $dbname = "interval";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = 'SELECT * FROM projects';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
			if ($row['code_name']==$_GET["id"]) {
				echo '<li class="active"><a href="/browse/?id='.$row['code_name'].'">'.$row['nice_name'].'</a></li>';
			} else {
				echo '<li><a href="/browse/?id='.$row['code_name'].'">'.$row['nice_name'].'</a></li>';
			}
                }
        }
?>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">    
  <div class="row content">
	<br>
    <div class="col-sm-5 text-left"> 
	<h4>Phenotype summary</h4>
	<br>
      <table id="phen_table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Gene ID</th>
                <th>Gene</th>
                <th>gene_chr</th>
                <th>gene_start</th>
                <th>Lead RsID</th>
                <th>qVal</th>
                <th>Z-score</th>
                <th>gene_end</th>
            </tr>
        </thead>
      </table>
    </div>
    <div class="col-sm-7 text-left"> 
	    <div class="col-sm-12 text-left"> 
		<br>
	      <div id="lz-plot"></div>
	    </div>
	    <div class="col-sm-12 text-left">
		<h4>Summary statistics</h4>
		<br>
	      <table id="sum_table" class="display" style="width:100%">
		<thead>
		    <tr>
			<th>Variant PosID</th>
			<th>TSS Distance</th>
			<th>AF</th>
			<th>Beta</th>
			<th>P-val</th>
			<th>Z-score</th>
		    </tr>
		</thead>
	      </table>
	    </div>
    </div>
  </div>
</div>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">Developed by <a href="https://alextokolyi.com/" target="_blank">Alex Tokolyi</a> as part of the INTERVAL consortium, 2021.</span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
	window.plot_type = "box";
	window.sendBox = [ "ENSG00000013573", "DDX11", "rs10771800" ];

	$.fn.dataTable.render.lowp = function () {
                return function ( data, type, row ) {
                        return type === 'display' && data==0 ?
                            "<1e-310" :
                            data;
                        }
        };	

	$(document).ready(function() {
    		var table = $('#phen_table').DataTable( {
			"scrollResize": true,
			"scrollCollapse": true,
			"processing": true,
			"pageLength": 15,
			"initComplete": function(settings, json) {
				$( $('#phen_table').DataTable().row(0).nodes() ).addClass('selected');
				var sendLZ = [table.row(0).data()[0],table.row(0).data()[2],table.row(0).data()[3],table.row(0).data()[7]]
				console.log(sendLZ);
				// First lets just make the table move/refresh
				window.sendBox = [table.row(0).data()[0],table.row(0).data()[1],table.row(0).data()[4]]
				jumpTo(sendLZ);
				make_table(window.sendBox[0]);
			},
			"serverSide": true,
			"ajax": "fetch.php?id=" + window.location.href.split("=").slice(-1),
			"order": [[ 6, "desc" ]],
			"columnDefs": [ { "targets": [ 0,2,3,7 ], "visible": false, "searchable": true },
						{"targets": [ 5 ], 'render': $.fn.dataTable.render.lowp() }]
    		} );
		$('#phen_table tbody').on('click', 'tr', function() {
			if ($(this).hasClass('selected')) {
			    $(this).removeClass('selected');
			} else {
			    console.log($(this));
			    table.$('tr.selected').removeClass('selected');
			    $(this).addClass('selected');
				var sendLZ = [table.row(this).data()[0],table.row(this).data()[2],table.row(this).data()[3],table.row(this).data()[7]]
				console.log(sendLZ);
				// First lets just make the table move/refresh
				window.sendBox = [table.row(this).data()[0],table.row(this).data()[1],table.row(this).data()[4]]
				jumpTo(sendLZ);
				make_table(window.sendBox[0]);
			}
    		});
	} );
	</script>

	<script type="text/javascript">

	function make_table(phen) {
		$('#sum_table').DataTable().destroy();
    		var table2 = $('#sum_table').DataTable( {
			"processing": true,
			"pageLength": 5,
			"serverSide": true,
			"ajax": "fetch_sum.php?phenotype_id="+phen+"&id="+window.location.href.split("=").slice(-1),
			"order": [[ 5, "desc" ]],
			"columnDefs": [ { "targets": [5], 'render': $.fn.dataTable.render.lowp() } ]
    		} );
		
	}
	

	function jumpTo(send) {
		var geneid = send[0];
		var chr = send[1];
		var start = +send[2]-100000;
		var end  = +send[3]+100000;
		//if (region.slice(-1)=="+") {
		//		region = region.slice(0,-1) + "%2b";
		//}
		const AssociationLZ = LocusZoom.Adapters.get('AssociationLZ');
		const apiBase = 'https://portaldev.sph.umich.edu/api/v1/';
		var base = ""
		const data_sources = new LocusZoom.DataSources()
		    //.add('assoc', ['AssociationLZ', {url: apiBase + 'statistic/single/', params: { source: 45, id_field: 'variant' }}])
		    //.add("assoc", ["BaseApiAdapter", {url: "qtls.json", params: { source: 1, id_field: "variant" }}])
		    .add('assoc', ['AssociationLZ', {url: base + '/browse/', params: { source: geneid, id_field: 'variant'}}])

		    .add('ld', ['LDServer', { url: 'https://portaldev.sph.umich.edu/ld/', source: '1000G', population: 'ALL', build: 'GRCh38' }])

		    .add('recomb', ['RecombLZ', { url: apiBase + 'annotation/recomb/results/', build: 'GRCh38' }])

		    .add('gene', ['GeneLZ', { url: apiBase + 'annotation/genes/', build: 'GRCh38' }])
		    //.add("gene", ["GeneLZ", { url: "annots.json" }])

		    .add('constraint', ['GeneConstraintLZ', { url: 'https://gnomad.broadinstitute.org/api/', build: 'GRCh38' }]);
		const layout = LocusZoom.Layouts.get(
		    'plot',
		    'standard_association',
		    { state: { genome_build: 'GRCh38', chr: chr, start: start, end: end},
			panels: [
						                                LocusZoom.Layouts.get('panel', 'association', { height: 350 }),
						                                LocusZoom.Layouts.get('panel', 'genes', { height: 100 })
						                        ]
				    }
		);
		// 100955426
		// start: 88982282, end: 89024281
		// Add start and ends of splice

		// Auto  set LD ref to lead SNP?
		LocusZoom.Layouts.mutate_attrs(layout, '$..data_layers[?(@.tag === "association")].fields', (fields) => fields.concat(["assoc:variant_id","assoc:position","assoc:alt_allele","assoc:beta","assoc:log_pvalue_real"]));
		LocusZoom.Layouts.mutate_attrs(layout, '$..data_layers[?(@.tag === "association")].tooltip.html', [
			"<strong>{{assoc:variant_id|htmlescape}}</strong><br>",
			"P Value: <strong>{{assoc:log_pvalue_real|logtoscinotation|htmlescape}}</strong><br>",
			"Position: <strong>{{assoc:position|htmlescape}}</strong><br>",
			"Beta: <strong>{{assoc:beta|htmlescape}}</strong><br>",
			"Effect allele: <strong>{{assoc:ref_allele|htmlescape}}</strong><br>",
			"Other allele: <strong>{{assoc:alt_allele|htmlescape}}</strong><br>",
			"{{#if ld:isrefvar}}<strong>LD Reference Variant</strong>{{#else}}",
			"<a href=\"javascript:void(0);\"onclick=\"var data = this.parentNode.__data__;data.getDataLayer().makeLDReference(data);\">Make LD Reference</a>{{/if}}<br>"
		].join(""));
		LocusZoom.Layouts.mutate_attrs(layout, '$.panels[?(@.tag === "genes")].data_layers', (old_layers) => old_layers.concat([{
			  id: "sStart_line",
			  type: "orthogonal_line",
			  orientation: "vertical",
			  offset: +send[2],
			  style: {
			    "stroke": "#FF3333",
			    "stroke-width": "2px",
			    "stroke-dasharray": "4px 4px"
			  }
			}]));
			LocusZoom.Layouts.mutate_attrs(layout, '$.panels[?(@.tag === "genes")].data_layers', (old_layers) => old_layers.concat([{
			  id: "sEnd_line",
			  type: "orthogonal_line",
			  orientation: "vertical",
			  offset: +send[3],
			  style: {
			    "stroke": "#FF3333",
			    "stroke-width": "2px",
			    "stroke-dasharray": "4px 4px"
			  }
			}]));
		// Use the layout to render the plot (with data sources defined from the previous guide)
		plot = LocusZoom.populate('#lz-plot', data_sources, layout);
		return false;
	}
	$(document).ready(function() {
	    //jumpTo("ENSG00000013573|12:31073860:31104799");
	    //make_table(window.sendBox[0]);
	} );

      </script>

  </body>
</html>

