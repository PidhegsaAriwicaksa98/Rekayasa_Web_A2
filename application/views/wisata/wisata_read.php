<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Wisata Read</h2>
        <table class="table">
	    <tr><td>Kota</td><td><?php echo $kota; ?></td></tr>
	    <tr><td>Landmark</td><td><?php echo $landmark; ?></td></tr>
	    <tr><td>Tarif</td><td><?php echo $tarif; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('wisata') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>