<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <meta name="Author" content="SeekEver">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
  <script src="<?php echo Yii::app()->baseUrl?>/skin/js/cut/jquery.min.js" type="text/javascript"></script>
  
  <script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/skin/js/cut/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl?>/skin/css/cut/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href=" http://hs.cnfol.com/ua/css/cloud/UpAvatar.css" />
<script type="text/javascript">

    jQuery(function($){

      // Create variables (in this scope) to hold the API and image size
      var jcrop_api, boundx, boundy;
        	 
      $('#target').Jcrop({
      	allowSelect: true,
    allowMove: true,
    allowResize: true,

    trackDocument: true,
		minSize: [100,100],
		setSelect: [0,0,190,190],
       onChange: updatePreview,
		onSelect: updateCoords,
        aspectRatio: 1
      },
	function(){
        // Use the API to get the real image size
        var bounds = this.getBounds();
        boundx = bounds[0];
        boundy = bounds[1];
        // Store the API in the jcrop_api variable
        jcrop_api = this;
    });
	function updateCoords(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};
	function checkCoords()
	{
		if (parseInt($('#w').val())) return true;
		alert('Please select a crop region then press submit.');
		return false;
	};
  function updateDefault(){


	  }
	
      function updatePreview(c){
    	  updateCoords(c);
        if (parseInt(c.w) > 0)
        {
          var rx = 120 / c.w;		//小头像预览Div的大小
          var ry = 120 / c.h;

          $('#preview').css({
            width: Math.round(rx * boundx) + 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
        }
	    {
          var rx = 199 / c.w;		//大头像预览Div的大小
          var ry = 199 / c.h;
          $('#preview2').css({
            width: Math.round(rx * boundx) + 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
        }
      };

       
	  
    });

  </script>
 </head>
 
 <body>
 <script charset="utf-8" type="text/javascript">
document.domain="cnfol.com";
</script>
	<form name="ImgForm" method="post" action="<?php echo yii::app()->createUrl('User/UploadImg&act=upload');?>" enctype="multipart/form-data">
		<label id="upfile" for="file"><b>+</b> 上传图像 <input type="file" onclick="setTimeout(function(){$('#file').blur();},500)" id="file" name="file" />
</label>
		<!--<input type="submit" value="上传"> -->
	</form>
	<?php if(!empty($path)){  ?>
	<div id="abc" style="overflow: hidden;" >
		<div class="bigImg">
			<img id="target" src="" />
			<script type="text/javascript">
			var T = document.getElementById("target");
				T.src = "<?php echo $path; ?>";
			</script>
		</div>
		<div class="smallImg" style="width:120px;height:120px;">
			<img id="preview" src="" />
			<script type="text/javascript">
			var S = document.getElementById("preview");
				S.src = "<?php echo $path; ?>";
			</script>
		</div>
		
		<form action="<?php echo yii::app()->createUrl('User/UploadImg&act=cut');?>" method="post" onsubmit="return checkCoords();">
			<input type="hidden" name="path" value="<?php echo $path; ?>" />
			<input type="hidden" id="x" name="x"  />
			<input type="hidden" id="y" name="y"  />
			<input type="hidden" id="w" name="w" value="120px" />
			<input type="hidden" id="h" name="h"  value="120px"/>
			<input type="submit" id="sub" style="display: none;" value="裁剪" />
		</form>
	</div>
	<script type="text/javascript">
	
	
	$(document).ready(function() {
		try{
			parent.frames.upHead.smallImg = $("#smallImg").attr("src");
		 }catch(e){}
		
		var timer = setInterval(function () {
			if($(".jcrop-holder").height()){
				if (parent.frames.upHead.imgFlag) parent.frames.upHead.auClient();
				setTimeout(function() {
					parent.frames.upHead.imgFlag = false;
					clearInterval(timer);
				},300);
			}
			parent.frames.upHead.ch = $(".jcrop-holder").height() ? $(".jcrop-holder").height() + 50 : 100;
			parent.frames.upHead.parH();
			
		},50);		
		parent.upHead.cut();
		
	});
		function abc(){
			$("form:last").submit();
		}
		function empty() {
			$("#abc").empty();
		}
</script>
	<?php } ?>
<script type="text/javascript">
$(document).ready(function () {  
	$("#file").bind("change",function () {	
		parent.frames.upHead.imgFlag = true;				
		$("form:first").submit();			
	});
});
</script>	
 </body>
</html>