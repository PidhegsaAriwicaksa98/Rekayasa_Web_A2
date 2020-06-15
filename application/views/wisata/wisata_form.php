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
        <h2 style="margin-top:0px">Wisata <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Kota <?php echo form_error('kota') ?></label>
            <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="<?php echo $kota; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Landmark <?php echo form_error('landmark') ?></label>
            <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Landmark" value="<?php echo $landmark; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tarif <?php echo form_error('tarif') ?></label>
            <input type="text" class="form-control" name="tarif" id="tarif" placeholder="Tarif" value="<?php echo $tarif; ?>" />
        </div>
	    <input type="hidden" name="id_wisata" value="<?php echo $id_wisata; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('wisata') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>