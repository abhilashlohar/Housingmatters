<?php
if($edit == 0) { 
foreach($cursor1 as $collection)
{
$trms_arr = $collection['society']['terms_conditions'];	
}
$hh = (int)$t_id-1;
$terms_name = $trms_arr[$hh];
?>


<div class="modal-body">
	<div class="control-group">
	  <label class="control-label">Terms and Condition</label>
	  <div class="controls">
		<textarea class="m-wrap span12" id="description"><?php echo $terms_name; ?></textarea>
	  </div>
   </div>
   
  				   
					   
</div>
<div class="modal-footer">
	<button class="btn" id="close_edit">Close</button>
	<button class="btn red save_edited_terms" tems_id="<?php echo $t_id; ?>">Save</button>
</div>

<?php  } ?>


<?php if($edit == 1) { ?>
<div class="modal-body">
<h4><b>Thank You!</b></h4>
Terms and Condition Updated Successfully
</div>
<div class="modal-footer"><button class="btn red" id="close_edit">Ok</button></div>
<?php } ?>













