<form>
	<br><br>
	<span class="btn green"><a href="<?= base_url() ?>excel/import">Import to DB</a></span>
	<br><br>
  <table class="view" cellpadding="8" border="1">
		<!-- Header -->
    <?php foreach ($fields as $field) : ?>
    <th><?= strtoupper($field) ?></th>
    <?php endforeach; ?>

    <!-- Data -->
    <?php $i=0; foreach ($sheet as $row) : ?>
    <tr class="clickable">

    	<?php 
    	// skip the first row(header row)
    	if($i==0) { $i++; } else {
	      foreach ($letters as $col) {
	      	// if any col are empty, give a style color
	      	$null_col = ( !empty($row[$col]))? "" : " style='background: #fdd835;'";
	      	echo '<td class="view"'.$null_col.'>'.$row[$col].'</td>';

	      }
	    } 
	    ?>

    </tr>
    <?php endforeach; ?>
  </table>
</form>