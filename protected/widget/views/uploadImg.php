	<div class="mgTpMain L w600">
    	<div class="mgTpTitle">上传图像</div>
        <div class="mgTpCont">
        	<div>
				 <iframe id="upIfr" style="width:570px;" name="upIfr"  src="<?php echo yii::app()->createUrl('Show/UploadImg');?>" frameborder="no" scrolling="no" ></iframe>
			</div>
        	<span><a href="javascript:void(0);" id="upCut" class="sumitBtn">确定</a><a href="javascript:Dms();"  class="cancelBtn" onClick="Dialog.Close();">取消</a></span>	
        </div>
    </div>
    <a href="javascript:Dms();" class="closeBtn L" onClick="Dialog.Close();"></a>
<script src=" http://hs.cnfol.com/Cm/Js/Jquery16.js" type="text/javascript"></script>
<script charset="utf-8" type="text/javascript">
var upHead = {
		cut: function () {
			$("#upCut").bind("click",function () {					
				upIfr.abc();
				upHead.addHead();
			});
		},		
		ch: "100",
		smallImg: "",		
		parH: function () {
			$("#upIfr").height(upHead.ch);	
		},
		auClient: function() {			
			try{
				Dialog("TMImgsUploadTmk");
				Dialog.Mask(C.G("TMImgsUploadTmk"));
		    }catch(e){}
		},		
		addHead: function () {
			var timer = setInterval(function () {
				if(upHead.smallImg){
					$(".hAuto img").attr("src",upHead.smallImg);
					Dialog.Close && Dialog.Close();
					Dms && Dms();
					clearInterval(timer);
				}
			},50);	
		}
	};
function Dms() {
    var Msc = C.Cls("MsContent","div"),
        c = 0,
        reg = new RegExp(/(^| )MsContent( |$)/),
        mid = "";

    for(;c < Msc.length; c++) {
        if(reg.test(Msc[c].className) && Msc[c].id != "TMImgsUploadTmk" && Msc[c].style.display == "block") {
            mid = Msc[c].id;
        }
    }
    if(mid){
        Dialog.Mask && Dialog.Mask(mid);
    }
}	
</script>