<style>
.topic:hover{
/*background-color:#8CC1FD !important; color:#FFF !important;*/
border-color:#169ef4 !important;

}
.blue{
background-color:#169ef4 !important;
color:#FFF !important;	
}
.animated {
	-webkit-transition: height 0.2s;
	-moz-transition: height 0.2s;
	transition: height 0.2s;
}


.showme{
display:none;
}
.showhim:hover .showme{
display:block;
}
.ok_t{
background-color:#fafafa !important;
}
</style>  

<div style="border-bottom:solid 1px #ccc; overflow:auto; background-color: rgba(250, 250, 250, 0.59);" class="hide_at_print">
<div class="pull-left"><h4 style="color:#269abc;">&nbsp;<i class="icon-comments"></i> <b>Discussion Forum</b></h4></div>

<div class="pull-right" style="padding-top:2px;">

<a href="<?php echo $webroot_path;?>Discussions/index/<?php echo $id; ?>/0" role='button' rel="tab" class="btn" style=" background-color: #398439;color:#fff;" ><i class="icon-cloud"></i> All Topics</a>
<a href="<?php echo $webroot_path;?>Discussions/index/<?php echo $id; ?>/1" role='button' rel="tab" class="btn" style=" background-color: #d58512; color:#fff;"><i class="icon-heart"></i> My Topics</a>
<a href="<?php echo $webroot_path;?>Discussions/new_topic" role='button' rel="tab" class="btn" style="background-color: #357ebd; color:#fff;"><i class=" icon-plus-sign"></i> Start Topic</a>
<input type="text" class="m-wrap" id="search_topic_box" placeholder="Search Topic" onkeyup="search_topic()" style="background-color: #FFF !important;height: 22px;">
<a href="<?php echo $webroot_path;?>Discussions/index/<?php echo $id; ?>/2" role='button' rel="tab" class="btn black"><i class="icon-trash"></i> Archives</a>
</div>

</div>

<table boder="1" width="100%">
<tr>
<td width="60%" valign="top">
<div id="topic_detail">
<?php
if(sizeof($result_discussion_last)>0)
{
foreach($result_discussion_last as $data2)
{
$topic=$data2["discussion_post"]["topic"];
$description=$data2["discussion_post"]["description"];
$file=$data2["discussion_post"]["file"];
$d_user_id=(int)$data2["discussion_post"]["user_id"];
$post_date=$data2["discussion_post"]["date"];
$post_time=$data2["discussion_post"]["time"];
$description=$data2["discussion_post"]["description"];
$discussion_post_id=(int)$data2["discussion_post"]["discussion_post_id"];
$visible=$data2["discussion_post"]["visible"];
$sub_visible=$data2["discussion_post"]["sub_visible"];
$delete_id=$data2["discussion_post"]["delete_id"];
}

$visible_detail='';
if($visible==1 ) 
{
	$visible_show="All Users";
	$visible_detail="All Users";
}

if($visible==4 ) 
{
	$visible_show="All Owners";
	$visible_detail="All Owners";
}

if($visible==5) 
{
	$visible_show="All Tenant";
	$visible_detail="All Tenant";
}

if($visible==2) 
{ 
$visible_show="Role wise";
	foreach ($sub_visible as $role_id) 
	{
	$role_name[]=$this->requestAction(array('controller' => 'hms', 'action' => 'fetch_rolename_via_roleid'), array('pass' => array($role_id)));
	}
	$visible_detail=implode(" , ",$role_name);
}

if($visible==3) 
{ 
$visible_show="Wing wise"; 
	foreach ($sub_visible as $wing_id) 
	{
	$wing_name[]="wing-".$this->requestAction(array('controller' => 'hms', 'action' => 'fetch_wingname_via_wingid'), array('pass' => array($wing_id)));
	}
	$visible_detail=implode(" , ",$wing_name);
}

$result_user_info=$this->requestAction(array('controller' => 'hms', 'action' => 'profile_picture'), array('pass' => array($d_user_id)));
foreach($result_user_info as $collection2)
{
$user_name=$collection2["user"]["user_name"];
$profile_pic=$collection2["user"]["profile_pic"];
$wing=$collection2["user"]["wing"];
$flat=$collection2["user"]["flat"];

}

$flat_info=$this->requestAction(array('controller' => 'hms', 'action' => 'wing_flat'), array('pass' => array($wing,$flat)));
?>
<!---------------------------------------------->
<div style="margin-left:10%; width:80%;">
<div style="background-color:#269abc; text-align:center; color:white; font-size:18px; font-weight:bold; padding:5px;"><?php echo $topic; ?></div>
<!--<div class="pull-right">
<a href="discussion_pdf?con=<?php echo $last_discussion_post_id; ?>" class="btn red mini hide_at_print ">pdf</i></a>
<a class="btn blue mini hide_at_print" onclick="window.print()">print</a>
</div>-->
<!---------------------------------------------->


<!---------------------------------------------->
<div style="margin-top:2px;" >
<table>
<tr>
<td width="15%"><img src="<?php echo $webroot_path ; ?>/profile/<?php echo $profile_pic; ?>" style="height:50px; width:50px;"/></td>
<td width="85%" valign="top" style="padding-left:5px;" >
<span style="font-size:16px;"><?php echo $user_name; ?>&nbsp;&nbsp;<?php echo $flat_info; ?></span>

<span style="font-size:16px;cursor: default;"><span class="tooltips" data-placement="bottom" data-original-title="This discussion is visible to :- <?php echo @$visible_detail; ?>"><?php //echo $visible_show; ?><i class=" icon-info-sign"></i></span></span>
<br/>
<span style="color:#ADABAB;"><?php echo $post_date; ?>&nbsp;&nbsp;<?php echo $post_time; ?></span>
</td>
</tr>
</table>
<div>
<!---------------------------------------------->


<!---------------------------------------------->
<div style="margin-top:2px;font-size:14px;color:#646464;" ><?php echo $description; ?><div>
<!---------------------------------------------->


<!---------------------------------------------->
<?php if(!empty($file)) { ?>
<div style="margin-top:2px;" >
<img src="<?php echo $webroot_path ; ?>/discussion_file/<?php echo $file; ?>" style="width:100%; height:350px;">
<div>
<?php } ?>
<!---------------------------------------------->

<!---------------------------------------------->
<div id="comments_container">
<?php 
foreach($result_comment_last as $collection2)
{
$discussion_comment_id=$collection2["discussion_comment"]["discussion_comment_id"];
$comment=$collection2["discussion_comment"]["comment"];

$comment_user_id=$collection2["discussion_comment"]["user_id"];
$date=$collection2["discussion_comment"]["date"];
$time=$collection2["discussion_comment"]["time"];
$color=$collection2["discussion_comment"]["color"];
@$offensive_user=$collection2["discussion_comment"]["offensive_user"];

$result_user_info=$this->requestAction(array('controller' => 'hms', 'action' => 'profile_picture'), array('pass' => array($comment_user_id)));
foreach($result_user_info as $collection2)
{
$user_name=$collection2["user"]["user_name"];
$profile_pic=$collection2["user"]["profile_pic"];
$wing=$collection2["user"]["wing"];
$flat=$collection2["user"]["flat"];

}

$flat_info=$this->requestAction(array('controller' => 'hms', 'action' => 'wing_flat'), array('pass' => array($wing,$flat)));
?>
<div
<?php if(@in_array($s_user_id,@$offensive_user))
{ ?> style="background-color: #FFE0DF;border-top: solid 2px #f1f3fa; " 
<?php } else { ?>  style="background-color: #fafafa;border-top: solid 2px #f1f3fa;" 
<?php } ?> id="comm<?php echo $discussion_comment_id; ?>" class="showhim"><table width="100%">
<tr>
<td width="15%" valign="top" style="padding:10px;"><img src="<?php echo $webroot_path ; ?>/profile/<?php echo $profile_pic; ?>" style="height:50px; width:50px;"/></td>
<td width="85%" valign="top" style="padding-left:5px;">


<!---   Delete and offensive  code  -------->
<?php if(!@in_array($s_user_id,$offensive_user))
{ ?>
<div class="btn-group  " style="float:right;">

				
				<a  class="badge ok_t  dropdown-toggle" data-toggle="dropdown" ><i class="icon-angle-down" style='font-size: 16px;
  color: rgb(175, 173, 173);'></i></a>
				<ul class="dropdown-menu">
<?php if($s_user_id==$comment_user_id) { ?>	<li><a href="#" role='button' onclick="delete_comment(<?php echo $discussion_comment_id; ?>)">
<i class="icon-trash"></i> Delete</a></li>
<?php } ?>
<?php if($s_user_id !=$comment_user_id) { ?>	<li><a href="#"    role='button' onclick="offensive_delete(<?php echo $discussion_comment_id; ?>,<?php echo $s_user_id; ?>)"><i class="icon-ban-circle"> </i> offensive</a></li> <?php } ?>
				</ul>
</div>
<?php } ?>
<!------------------------------------------------------->

<!--<a href="#" role='button' class="btn mini red pull-right showme" onclick="delete_comment(<?php echo $discussion_comment_id; ?>)"><i class="icon-trash"></i> </a>-->


<span style="font-size:14px;color:<?php echo $color; ?>"><?php echo $user_name; ?>&nbsp;&nbsp;<?php echo $flat_info; ?></span>
<span style="color:#ADABAB;font-size:12px;" class="pull-right"><?php echo $date; ?>&nbsp;&nbsp;<?php echo $time; ?> &nbsp; </span><br/>
<span style="color:#000;font-size:14px;"><?php echo $comment; ?></span>
</td>
</tr>
</table>
</div>
<?php } ?>
</div>
<!---------------------------------------------->


<!---------------------------------------------->
<?php 

if($delete_id!=1)
{ ?>
<div class="chat-form hide_at_print" style="margin-left: 5px;width: 94%;">
	<textarea class="span12 m-wrap animated"  type="text" id="posttext" placeholder="Type a message here..." style="background-color:#FFF !important; resize:none;" ></textarea>
	<div align="right">
	<div class="pull-left" id="save_comment"></div>
	<button type="button" id="post_comment" style="margin-top:-10px;" onclick="comment(<?php echo $discussion_post_id; ?>)" class="btn blue icn-only tooltips" data-placement="bottom" data-original-title="Tab + Enter for post comment">POST</button>
	</div>
</div>
<!---------------------------------------------->
<?php } } else { ?><h4>There are no any topics strated.</h4><?php } ?>
</div>
</td>
<td width="40%" valign="top" class="hide_at_print"> 
<div  class="scroller"  data-height="700px" id="topics_list">
<?php if($list==0) { $label="All Topics"; } ?>
<?php if($list==1) { $label="My Topics"; } ?>
<?php if($list==2) { $label="Archived Topics"; } ?>
<div align="center" style="font-size:16px; padding:2px;"><?php echo $label; ?></div>
<?php
if(sizeof($result_discussion)==0) { echo '<div align="center"><h5>No Record Found.</h5></div>'; }
foreach($result_discussion as $collection)
{
 $discussion_post_id=(int)$collection["discussion_post"]["discussion_post_id"];
$discussion_post_id=$this->requestAction(array('controller' => 'hms', 'action' => 'encode'), array('pass' => array($discussion_post_id,'housingmatters')));
$topic=$collection["discussion_post"]["topic"];
$d_user_id=(int)$collection["discussion_post"]["user_id"];
$date=$collection["discussion_post"]["date"];
$time=$collection["discussion_post"]["time"];
  $n_comments=$this->requestAction(array('controller' => 'hms', 'action' => 'count_comment_of_topic'), array('pass' => array($discussion_post_id)));

?>
<?php if($list==0) { ?>
<a href="<?php echo $webroot_path;?>Discussions/index/<?php echo $discussion_post_id; ?>/0" role='button' rel="tab" style="text-decoration:none;">
<div style="padding:2px;">
<div  style="background-color:#F4F8FF; cursor:pointer; color:#06F; padding:5px; border:solid 2px #D9E8FF;" class="topic sel" id="" >
<div align="center" style="font-size:18px;" ><?php echo $topic; ?></div>
<div align="center" ><span>(<?php echo $n_comments; ?> Comments )</span>&nbsp;&nbsp;<?php echo $date; ?>&nbsp;&nbsp; <?php echo $time; ?></div>
</div>
</div>
</a>
<?php } ?>

<?php if($list==1) { ?>
<a  class="btn mini red pull-right" role='button' onclick="delete_topic('<?php echo $discussion_post_id; ?>')">Close Topic </a>
<a href="<?php echo $webroot_path;?>Discussions/index/<?php echo $discussion_post_id; ?>/1" role='button' rel="tab" style="text-decoration:none;">
<div style="padding:2px;">
<div  style="background-color:#F4F8FF; cursor:pointer; color:#06F; padding:5px; border:solid 2px #D9E8FF;" class="topic sel" id="" >

<div align="center" style="font-size:18px;" ><?php echo $topic; ?></div>
<div align="center" ><span>(<?php echo $n_comments; ?> Comments )</span>&nbsp;&nbsp;<?php echo $date; ?>&nbsp;&nbsp; <?php echo $time; ?></div>
</div>
</div>
</a>
<?php } ?>

<?php if($list==2) { ?>
<a href="#" class="btn mini red pull-right" role='button' onclick="delete_topic_archive('<?php echo $discussion_post_id; ?>')"> <i class='icon-remove'></i> </a>
<a href="<?php echo $webroot_path;?>Discussions/index/<?php echo $discussion_post_id; ?>/2" role='button' rel="tab" style="text-decoration:none;">
<div style="padding:2px;">
<div  style="background-color:#F4F8FF; cursor:pointer; color:#06F; padding:5px; border:solid 2px #D9E8FF;" class="topic sel" id="" >
<div align="center" style="font-size:18px;" ><?php echo $topic; ?></div>
<div align="center" ><span>(<?php echo $n_comments; ?> Comments )</span>&nbsp;&nbsp;<?php echo $date; ?>&nbsp;&nbsp; <?php echo $time; ?></div>

</div>
</div>
</a>
<?php } ?>

<?php } ?>
</div>
</div>
</td>
</tr>
</table>




<div id="delete_topic_result"></div>
 <script>


$.validator.addMethod('requirecheck1', function (value, element) {
	 return $('.requirecheck1:checked').size() > 0;
}, 'Please check at least one role.');

$.validator.addMethod('requirecheck2', function (value, element) {
	 return $('.requirecheck2:checked').size() > 0;
}, 'Please check at least one wing.');

$.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
});

$(document).ready(function(){
			var checkboxes = $('.requirecheck1');
			var checkbox_names = $.map(checkboxes, function(e, i) {
				return $(e).attr("name")
			}).join(" ");
			
			
			var checkboxes2 = $('.requirecheck2');
			var checkbox_names2 = $.map(checkboxes2, function(e, i) {
				return $(e).attr("name")
			}).join(" ");
			
			
			
	
		$('#contact-form').validate({
		
		 errorElement: "label",
                    //place all errors in a <div id="errors"> element
                    errorPlacement: function(error, element) {
                        //error.appendTo("label#errors");
						error.appendTo('label#' + element.attr('id'));
                    }, 
	    groups: {
            asdfg: checkbox_names,
			qwerty: checkbox_names2
        },
		
		
		rules: {
	      topic: {
	       
	        required: true,
			maxlength: 100
	      },
		  
		  description: {
	        required: true,
			maxlength: 500,
			remote:"content_check_des"
	      },
		  file: {
			accept: "gif,jpg",
			filesize: 1048576
	      },
		 
	    },
		messages: {
	                topic: {
	                    maxlength: "Maximum 100 characters only."
	                },
					file: {
						accept: "File extension must be gif or jpg",
	                    filesize: "File size must be less than 1MB."
	                },
					description: {
	                    maxlength: "Max 500 characters allowed.",
						remote:"You have enter wrong word."
	                }
	            },
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
				
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
		
	  });

}); 
</script>

<script>
function my_topic(q)
{
$(document).ready(function () {	
$('#topics_list').html('<div style="border:solid 2px #F4F8FF; padding:5px;" align="center"><img src="<?php echo $webroot_path ; ?>/as/windows.gif" /></div>').load('discussion_my_topic?q=' + q);
});
}



function details_topic(t)
{
	$(document).ready(function () {
//$("#topic_detail").removeClass('animated zoomIn');
$("#topic_detail").removeClass('fadeleftsome');
$('#topic_detail').html('<div style="border:solid 2px #F4F8FF; margin-top:25px;" align="center"><img src="<?php echo $webroot_path ; ?>/as/windows.gif" /></div>').load('topic_view?t=' + t);
	});
}

function details_topic_deleted(x)
{
	$(document).ready(function () {
$("#topic_detail").removeClass('fadeleftsome');
$('#topic_detail').html('<div style="border:solid 2px #F4F8FF; margin-top:25px;" align="center"><img src="<?php echo $webroot_path ; ?>/as/windows.gif" /></div>').load('topic_view_deleted?t=' + x);
	});
}


function comment(tid)
{
$(document).ready(function () {
var old_c=$('#posttext').val()
var c=encodeURIComponent(old_c);

var u_name='<?php echo $user_name; ?>';
var flat='<?php echo $flat_info; ?>';
if(c!="")
{
$('#post_comment').hide();
	$( "#save_comment" ).load( '<?php echo $webroot_path; ?>Discussions/discussion_save_comment?tid=' + tid+'&c='+c, function() {
		$('#comments_container').load('<?php echo $webroot_path; ?>Discussions/discussion_comment_refresh?con='+tid);
		$('#posttext').val('');
		$('#post_comment').show();
	});
}
});
}
</script>



<script>
function delete_topic(dt)
{
	$(document).ready(function () {
$('#delete_topic_result').html('<div id="pp"><div class="modal-backdrop fade in"></div><div   class="modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"><div class="modal-body" style="font-size:14px;"><i class="icon-warning-sign" style="color:#d84a38;"></i> Are you sure you want to archive the topic & close it for further discussion ? </div><div class="modal-footer"><a href="<?php echo $webroot_path; ?>Discussions/delete_topic?con='+dt+'" class="btn blue" id="yes">Yes</a><a href="#"  role="button" id="can" class="btn">No</a></div></div></div>');

$("#can").live('click',function(){
   $('#pp').hide();
});
	});
}
</script>

<script>
function delete_topic_archive(dt)
{
$(document).ready(function () {
$('#delete_topic_result').html('<div id="pp"><div class="modal-backdrop fade in"></div><div   class="modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"><div class="modal-body" style="font-size:14px;"><i class="icon-warning-sign" style="color:#d84a38;"></i> Sure, you want to delete the discussion permanently ?</div><div class="modal-footer"><a href="<?php echo $webroot_path; ?>Discussions/archive?con='+dt+'" class="btn blue" id="yes">Yes</a><a href="#" role="button" id="can" class="btn">No</a></div></div></div>');

$("#can").live('click',function(){
   $('#pp').hide();
});
});
}
</script>


<script>
function delete_comment(cm_id)
{
$(document).ready(function () {
$('#delete_topic_result').html('<div id="main_div"><div class="modal-backdrop fade in"></div><div   class="modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"><div class="modal-body" style="font-size:16px;"><i class="icon-warning-sign" style="color:#d84a38;"></i> Sure, you want to delete the comment ?</div><div class="modal-footer"><a href="#" role="button" class="btn blue" id="yes" onclick="hide_comment_div('+cm_id+')">Yes</a><a href="#" role="button" id="no" class="btn">No</a></div></div></div>');

$("#no").live('click',function(){
  $('#main_div').hide();
});
});
}


function offensive_delete(co_id,co_u_id)
{
	$(document).ready(function () {
 $('#comm'+co_id).load('<?php echo $webroot_path; ?>Discussions/discussion_offensive_delete_ajax?c_id='+co_id +'&c_u_id='+co_u_id);
 $('#comm'+co_id).addClass('animated zoomOut');
setTimeout(
  function() 
  {
   
  $('#comm'+co_id).hide();
  }, 500);

	}); 
}

function hide_comment_div(ca)
{
	$(document).ready(function () {
$('#delete_topic_result').load('<?php echo $webroot_path; ?>Discussions/discussion_comment_delete_ajax?c_id='+ca);
$('#main_div').hide();
$('#comm'+ca).addClass('animated zoomOut');
setTimeout(
  function() 
  {
    $('#comm'+ca).hide();
  }, 500);
	});
}
</script>

<script>

function search_topic()
{
$(document).ready(function () {
var s=$('#search_topic_box').val();
$('#topics_list').html('<div style="border:solid 2px #F4F8FF; padding:5px;" align="center"><img src="<?php echo $webroot_path ; ?>/as/windows.gif" /></div>').load('<?php echo $webroot_path; ?>Discussions/discussion_search_topic?s='+s);
});
}
</script>
<script>
$(document).ready(function(){
<?php
$status=$this->Session->read('discussion_forum_status');
$status2=$this->Session->read('discussion_forum_status1');
if($status==1)
{

?>	
	
$.gritter.add({

			title: '<i class="icon-comments"></i> Discussions',
			text: 'Your discussion topic has been generated.',
			sticky: false,
			time: '10000',

			});
<?php
$this->requestAction(array('controller' => 'hms', 'action' => 'griter_notification'), array('pass' => array(3)));
}
if($status2==2)
{

?>

$.gritter.add({

			title: '<i class="icon-comments"></i> Discussions',
			text: 'Discussion Forum are sent for approval.',
			sticky: false,
			time: '10000',

			});

<?php
$this->requestAction(array('controller' => 'hms', 'action' => 'griter_notification'), array('pass' => array(3)));

}
?>	


$("#posttext").focus();		
});

</script>




