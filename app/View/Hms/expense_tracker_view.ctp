<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<center>
<div class="hide_at_print">
<h3><b>Expense Tracker View</b></h3>
</center>
</div>
<?php ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
 
 <br>
<div class="hide_at_print">
 <center>
<a href="expense_tracker_add" class="btn blue">Add</a>
<!-- <a href="expense_tracker_edit" class="btn blue">Edit</a> -->
<a href="expense_tracker_view" class="btn red">View</a>
<a href="expense_tracker_pie_chart" class="btn blue">Pie Chart</a>
</center>	
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<?php
$c_date = date('d-m-Y');
$b_date = date('1-m-Y');
?>



  <center>
            <div class="hide_at_print">
            <form method="post" id="contact-form">
            <br>
            <table>
            <tbody><tr>
           
            <td><input type="text" id="date1" class="date-picker m-wrap medium" data-date-format="dd-mm-yyyy" name="from" placeholder="From" style="background-color:white !important;" value="<?php echo $b_date; ?>"></td>
           
            <td><input type="text" id="date2" class="date-picker m-wrap medium" data-date-format="dd-mm-yyyy" name="to" placeholder="To" style="background-color:white !important;" value="<?php echo $c_date; ?>"></td>
            <td valign="top"><button type="button" name="sub" class="btn yellow" id="go">Go</button></td>
            </tr>
            </tbody></table>
            </br>
            </form>
            </div>
</center>





<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
<center>
<div id="result" style="width:96%;">
</div>
</center>  
					
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>					
					
					

<script>
$(document).ready(function() {
	$("#go").live('click',function(){
		var date1=document.getElementById('date1').value;
		var date2=document.getElementById('date2').value;
		
		if((date1=='')) { alert('Please Input Date-from'); }
		if((date2=='')) { alert('Please Input Date-to'); }
		else
		{
		$("#result").html('<div align="center" style="padding:10px;"><img src="as/loding.gif" />Loading....</div>').load("expense_tracker_ajax_view2?date1=" +date1+ "&date2=" +date2+ "");
		}
		
	});
	
});
</script>						
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					