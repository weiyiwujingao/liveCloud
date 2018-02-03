<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路演中心-审核管理-发布管理</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=ub/Css/Modules/Basis.css,ui/Css/CloudCom/CloudCom.css,Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css,ue/Css/Clouds/NewStyle.css,ue/Css/Clouds/CldRoad.css" />
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body>
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">

<i class="osHg tAlignL Mt10"><?=$type_name?>路演（<?=$params['username']?> <?=$params['sid']?>）</i>
<dl id="C1a" class="NTabs PstR">
    <dt class="mpLab">
         <a href="/?g=aW5mby9JbmZvY2xhc3M%3D&sid=<?php echo $sid;?>&style=1" <?php if( $params['style']==1 ) echo 'class="CM"'; ?>>问题审核</a>
        <a href="/?g=aW5mby9JbmZvY2xhc3M%3D&sid=<?php echo $sid;?>&style=2" <?php if( $params['style']==2 ) echo 'class="CM"'; ?>>发布管理</a>
		<a href="/?g=aW5mby9JbmZvY2xhc3M%3D&sid=<?php echo $sid;?>&style=3" <?php if( $params['style']==3) echo 'class="CM"'; ?>>垃圾箱</a>
    </dt>
   <dd class="hAuto" style="display:block;">
        <form class="FmSrch ComWrp" id="Search" name="Search">
            <label>发表人：<input type="text" value="<?php echo (isset($_GET['asker'])&& $_GET['asker'])?$_GET['asker']:''?>" name="asker" id ="asker" /></label>
            <label>对象：<input type="text" value="<?php echo (isset($_GET['replyer'])&& $_GET['replyer'])?$_GET['replyer']:''?>" name="replyer" id='replyer' /></label>
            <label for=" ">提问时间：<input type="text" class="InpDate W100" onClick="showCalendar(this)" value="<?php echo (isset($_GET['begintime'])&& $_GET['begintime'])?$_GET['begintime']:''?>" id="begintime" name="begintime"/> - <input type="text" class="InpDate W100" onClick="showCalendar(this)" value="<?php echo (isset($_GET['endtime'])&& $_GET['endtime'])?$_GET['endtime']:''?>" id="endtime" name="endtime"/></label><br>
            <label style="vertical-align:middle">状态：
                <select id="audit" name='audit'>
                    <option value ='-4'>全部</option>
                    <option <?php if(isset($_GET['audit'])&& $_GET['audit']==1){echo 'selected="selected"';} ?> value ='1'>未发布</option>
					<option <?php if(isset($_GET['audit'])&& $_GET['audit']==2){echo 'selected="selected"';} ?> value ='2'>已发布</option>
                </select>
            </label>
            <a href="javascript:Search()" id="searchUrl"  class="BtnSrch">搜索</a>
        </form>
    </dd>
</dl>
    <a href="javascript:void(0);" class="addBtn" onClick="Add(1,0);">发言</a>
    <p class="SRTitle">
	<?php 
		if($mod)
		{
	?>
	<a href="javascript:void(0);" class="BtnSrch TitBtn1 R" onClick="DelRecord(0,1);">批量发布</a>
	<?php 
		}
		if($del)
		{
	?>
	<a href="javascript:void(0);" class="BtnSrch TitBtn1 R" onClick="DelRecord(0,2);">删除</a>
	<?php 
		}
	?>
	查询结果：</p>
     <table  cellspacing="0" cellpadding="0" border="0" width="100%" class="serchResult MyMsgTab" id="Fa1">      
       <thead>
        <tr>
          <th width="4%"><label class="Ca" for="Ca"><input type="checkbox" id="Ca" /></label></th>
          <th width="8%">ID</th>
          <th width="16%">主题</th>
          <th width="10%">发表人</th>
          <th width="10%">对象</th>
          <th width="20%">内容</th>
          <th width="12%">更新时间</th>
          <th width="8%">状态</th>
          <th width="12%">操作</th>
        </tr>
       </thead>
       <tbody id="TabM">
    	  <?php 
			if(!empty($infoList))
			{
				foreach($infoList as $key =>$val)
				{
					$askarr = explode('-',$val['asker']);
					$ask='';
					if(count($askarr)>2)
					{
						for($i=0;$i<count($askarr)-1;$i++)
						{
							$ask.=$askarr[$i].'-';
						}
						$ask=rtrim($ask,'-');
					}else
					{
						$ask=$askarr[0];
					}

					echo '<tr class="" id="'.$val['id'].'">';
					echo '<td><input type="checkbox" name="box_id" value="'.$val['id'].'"/></td>';
					echo '<td><a style="color:#276FA3;" target="blank" href="http://roadshow.cnfol.com/show/'.$val['id'].'">'.$val['id'].'&nbsp;</a></td>';
					echo '<td class="Nrp" title="'.$params['topic'].'">'.$params['topic'].'</td>';
					echo '<td class="Nrp" id="asker'.$val['id'].'" >'.$ask.'</td>';
					echo '<td class="Nrp" id="replyer'.$val['id'].'">'.$val['replyer'].'</td>';
					echo '<td class="Nrp" style="text-align:left;"  title="'.str_replace('"', "'", $val['question']).'回复：'.str_replace('"', "'", $val['answer']).'">提问：'.$val['question'].'<br>回复：'.$val['answer'].'</td>';
					echo '<input type="hidden" id="question'.$val['id'].'" value="'.str_replace('"', "'",$val['question']).'">';
					echo '<td class="Nrp">'.date('Y-m-d H:i:s',$val['rtime']).'</td>';
					echo '  <td class="Nrp">'.$status[$val['audit']].'</td>';
					echo '  <td class="spTd">';
					echo '<p style="display: none;" id="answer'.$val['id'].'">'.$val['answer'].'</p>';
					echo '<p style="display: none;" id="picurl'.$val['id'].'">'.$val['picurl'].'</p>';
					if($speak)
					{
						if($val['replyer'])
						{
							echo '<a onClick="Add(2,'.$val['id'].');" class="btnStyleA L" href="javascript:void(0);">回复</a>';
						}else
						{
							echo '<a onClick="Add(3,'.$val['id'].');" class="btnStyleA L" href="javascript:void(0);">修改</a>';
						}
					
					}
					if($mod&&$val['audit']==1)
					{
						echo '<a onClick="DelRecord('.$val['id'].',1);" class="btnStyleA L" href="javascript:void(0);">发布</a>';
					}
					
					if($del)
					{
						echo '<a onClick="DelRecord('.$val['id'].',2);" class="btnStyleA L" href="javascript:void(0);">删除</a>';
					}
					echo '</td></tr>';
				}
			}
		?>
	   </tbody>
    </table>
	 <div class="page">
	<i class="pageL L">共有 <a href="####" id="totalP"><?php echo $count; ?></a> 条数据 <?php $this->widget('Pagination', array('pages' => $pages,'pagesize'=>$pagesize,'url'=>$url)); ?>
	</i></div>
</section>
<!--弹出窗-->
<div id="TMconfirmTmk" class="MsContent"></div>
<!--发言，修改，回复-->
<div id="TMtMsgTmk" class="MsContent">
	<div class="mgTpMain w450 L">
    	<div class="mgTpTitle">发言</div> 
        <form id="TMsg" class="mgTpCont" method="post"  enctype="multipart/form-data">
			<input type="hidden" id="SET_VALUE" name="SET_VALUE" value="2"/>
        	<table width="400" border="0" cellpadding="0" cellspacing="0" class="">
            	<tr>
                	<td width="20%" id="SName">发言人：</td>
                	<td width="80%">
                    	<select id="askers" name="askers">
								<?php if($admin){?>
								<option value="<?php echo $adminname;?>"><?php echo $adminname;?></option>
								<?php }?>
								
                        </select>
                    	<p id="SSltName">ccc</p>
                    </td>
                </tr>
            	<tr>
                	<td valign="top" id="question">发言内容：</td>
                	<td style="padding:10px 0;">
                    	<textarea id="content" name="content" style="width:320px;height:200px;display:block;float:left;visibility:hidden;"></textarea>
                    </td>
                </tr>
            	<tr>
                	<td valign="top">缩略图：</td>
                	<td>
                    	<div class="PicLst" id="PicLst">
                            <div class="Pmb" id="Pmb_0"><img id="ImgPr_0" width="70" height="60" /><input type="file" id="up_0" name="up_0" class="PicFile" /></div>
                        </div>
                        <span class="PlstAlt">*最多只能上传3张图片</span>
                    </td>
                </tr>
            	<tr id="isEdit" style="display:none;">
                	<td>是否发布：</td>
                	<td>
                    	<input checked="checked" type="radio" name="Sends" value="1">是 
                    	<input type="radio" name="Sends" value="0">否
                    </td>
                </tr>
            	<tr>
                	<td colspan="2">
                    	<span><a href="javascript:setform(2);" class="sumitBtn" id="SureAdd1">发布</a>
						<a href="javascript:setform(1);" class="sumitBtn" id="SureAdd2">提交</a>
                        <a href="javascript:void(0);"  class="cancelBtn" onClick="Reset('TMsg','ke-edit-iframe','PicLst');">重置</a></span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>



<!--发布-->
<div id="TMsendMsTipTmk" class="MsContent">
	<div class="mgTpMain w250 L">
    	<div class="mgTpTitle">信息提示</div>
        <div class="mgTpCont">
        	<p>你确定要发布吗？</p>
        	<span><a href="javascript:void(0);" class="sumitBtn" id="SureSend">确定</a><a href="javascript:void(0);"  class="cancelBtn" onClick="Dialog.Close();">取消</a></span>	
        </div>
    </div>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>
<!--删除-->
<div id="TMdelMsTipTmk" class="MsContent">
	<div class="mgTpMain w250 L">
    	<div class="mgTpTitle">信息提示</div>
        <div class="mgTpCont">
        	<p id="msg_dialog">你确定要删除吗？</p>
        	<span><a href="javascript:void(0);" class="sumitBtn" id="SureDel">确定</a><a href="javascript:void(0);"  class="cancelBtn" onClick="Dialog.Close();">取消</a></span>	
        </div>
    </div>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>
<!--end window-->
<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,Cm/Js/Jquery16.js,Cm/Js/Checkbox.js,ua/js/Clouds/Tables.js,ua/js/Clouds/Calendar.js,Cm/Js/Forms.js,ue/Js/Cloud/DiaFix.js" type="text/javascript"></script>
<script type="text/javascript" src="http://roadshow.cloud.cnfol.com/js/selectCheck.js"></script>
<script type="text/javascript" src="http://hs.cnfol.com/ue/Js/Editor/kindeditor-min3.js"></script>
<script type="text/javascript" src="http://hs.cnfol.com/ue/Js/Editor/zh_CN.js"></script>
<script charset="utf-8" type="text/javascript">
Checkbox("Fa1");
Tables("TabM","Ccl","Ocl");
function checkNum( val,obj ){
	if(val!=''){
		if( val.match(/^[0-9]*$/)){
			C.G(obj).className ="Ok";
			C.G(obj).innerHTML = '';
			_r2= true;
		}else{
			C.G(obj).className ="No";
			C.G(obj).innerHTML = "请输入合法的数字";
		}
	}else{
		C.G(obj).className ="No";
		C.G(obj).innerHTML = "该项不能为空！";
	}
}
//编辑器
var editor,editor2,editor3;
KindEditor.ready(function(K){
	editor = K.create('#content',{
		width : '320px',
		height : '200px',
		resizeType : 0,
		uploadJson : '',
		emoticonsPath: 'http://img.cnfol.com/newblog/emoticons/',
		//items: ['source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist', '|', 'emoticons', 'image', 'link','anchor','|','about'],
		items: ['forecolor','emoticons'],
		allowFlashUpload: false,
		allowMediaUpload: false
	});
});
//图片预览
jQuery.fn.extend({
    uploadPreview: function (opts) {
        var _self = this, _this = $(this);
        opts = jQuery.extend({
            Img: "ImgPr",
            Width: 85,
            Height: 85,
            ImgType: ["gif", "jpeg", "jpg", "png"],
            Callback: function () {}
        }, opts || {});
        _self.getObjectURL = function (file) {
            var url = null;
            if (window.createObjectURL != undefined) {
                url = window.createObjectURL(file);
            } else if (window.URL != undefined) {
                url = window.URL.createObjectURL(file);
            } else if (window.webkitURL != undefined) {
                url = window.webkitURL.createObjectURL(file);
            }
            return url;
        }
        _this.change(function () {
            if (this.value) {
                if (!RegExp("\.(" + opts.ImgType.join("|") + ")$", "i").test(this.value.toLowerCase())) {
                    alert("选择文件错误,图片类型必须是" + opts.ImgType.join("，") + "中的一种");
                    this.value = "";
                    return false;
                }
                if (navigator.userAgent.indexOf("MSIE") > -1) {
                    try {
                        $("#" + opts.Img).attr('src', _self.getObjectURL(this.files[0]));
                    } catch (e) {
                        var src = "";
                        var obj = $("#" + opts.Img);
                        var div = obj.parent("div")[0];
                        _self.select();
                        if (top != self) {
                            window.parent.document.body.focus();
                        } else {
                            _self.blur();
                        }
                        src = document.selection.createRange().text;
                        document.selection.empty();
                        obj.hide();
                        obj.parent("div").css({
                            'filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)',
                            'width': opts.Width + 'px',
                            'height': opts.Height + 'px'
                        });
                        div.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = src;
                    }
                } else {
					//预览图片
                    $("#" + opts.Img).attr('src', _self.getObjectURL(this.files[0]));
                }
                opts.Callback();
            }
			//成功后继续添加
			var Pl = $('#PicLst').find('.Pmb').length;//已有图片数
			_this.parent().after('<div class="Pmb" id="Pmb_'+Pl+'"><img id="ImgPr_'+Pl+'"  name="ImgPr_'+Pl+'" width="70" height="60" /><input type="file" name="up_'+Pl+'" id="up_'+Pl+'" class="PicFile" /></div>');
			$("#up_"+Pl).uploadPreview({Img:"ImgPr_"+Pl,Width:70,Height:60});
			$("#up_"+parseInt(Pl-1)).hide();//隐藏已预览的file
        });
    }
});

$("#up_0").uploadPreview({Img:"ImgPr_0",Width:70,Height:60});
//复选
function getCheckboxIds(checkbox_name){
	var vInput=$('input=[name=box_id]');
	var ids=new Array();
	for(var i=0;i<vInput.length;i++){ 
		var obj=vInput.eq(i); 
		if(vInput.eq(i).attr('checked')){   
			ids.push(vInput.eq(i).val());
		}
	}
	return ids;
}
//发言
function Add(type,id){
	
	$('#TMsg').attr("action","<?php echo yii::app()->createUrl('info/addquestion').'&sid='.$params['sid']; ?>"+"&type="+type+"&id="+id);
	
	/*发言人显示出来*/
	if(type==1)
	{
		$('#SName').html('发言：');
		$('#askers').show();
		$('#SSltName').hide();
		$('#SureAdd1').show();
		$('#SureAdd2').show();
		$('#content').html();
		editor.html();
	}
	/*发言人显示出来*/

	/*修改显示出来*/
	if(type==2)
	{
		$('#SName').html('问题：');
		$('#askers').hide();
		$('#SSltName').show();
		$('#SureAdd1').hide();
		$('#SureAdd2').show();
		$('#SSltName').html($('#question'+id).val());
		$('#content').html($('#answer'+id).html());
		editor.html($('#answer'+id).html());
	}
	/*修改显示出来*/

	/*回复显示出来*/
	if(type==3)
	{
		$('#SName').html('发言人：');
		$('#askers').hide();
		$('#SSltName').show();
		$('#SureAdd1').hide();
		$('#SureAdd2').show();
		$('#SSltName').html($('#asker'+id).html());
		$('#content').html($('#question'+id).val());
		editor.html($('#question'+id).val());
	}
	/*回复显示出来*/

	Dialog('TMtMsgTmk');
	setTimeout(function(){
		Dialog.Close();
		Dialog('TMtMsgTmk');
		C.G('TMsg').reset();
	},1000);
}
function setform(type)
{
	$('#content').val(editor.html());
	if($('#content').val()=='')
	{
		alert('内容不能为空！');
		return ;
	}
	$('#SET_VALUE').val(type);

	Dialog.Close();
	$('#TMsg').submit();
}
//修改
function Edt(id){
	$.ajax({
		url: ""+id,
		type: "post",
		dataType: "json",
		success: function(data){
			Dialog('TMtMsgTmk');
			$('#SName').html('发言人');
			$('#SSlt').hide();
			$('#SSltName').show();
			$('#SSltName').html(data.Name);//发言人
			$('#SInfo').html('发言内容');
			$('.ke-edit-iframe')[0].contentWindow.document.body.innerHTML=data.Info;//发言内容
			$('#PicLst').html(data.Imgs);//缩略图
			$('#isEdit').hide();//隐藏是否发布
			setTimeout(function(){
				Dialog.Close();
				Dialog('TMtMsgTmk');
			},1000);
		}
	});
}
//回复
function Record(id){
	$.ajax({
		url: ""+id,
		type: "post",
		dataType: "json",
		success: function(data){
			Dialog('TMtMsgTmk');
			$('#SName').html('问题');
			$('#SSlt').hide();
			$('#SSltName').show();
			$('#SSltName').html(data.Question);//问题
			$('#SInfo').html('回复内容');
			$('.ke-edit-iframe')[0].contentWindow.document.body.innerHTML=data.Info;//回复内容
			$('#PicLst').html(data.Imgs);//缩略图
			$('#isEdit').hide();//隐藏是否发布
			setTimeout(function(){
				Dialog.Close();
				Dialog('TMtMsgTmk');
			},1000);
		}
	});
}
//重置表单
function Reset(Fm,edtFrm,Pic){
	C.G(Fm).reset();
	$('.ke-edit-iframe')[0].contentWindow.document.body.innerHTML='';
	var Pcl=$('#'+Pic).children().length;
	for(var i=1;i<=Pcl;i++){//除第一个以外的全部清除
		$('.Pmb').eq(1).remove();//每次删除后0的下一个都是1，所以不能用i，只能用1
	}
	$('#ImgPr_0').remove();//第一张图清除
	$('#Pmb_0').append('<img id="ImgPr_0" width="70" height="60" />');//新建第一张图
	$("#up_0").show();//显示第一个file
}

//发布
function MakeSureSend(id){
	Dialog.Close();
	var Url="";
	var Data="&id="+id;
	C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  
	function goBackVal(Bj){ 
		if(Bj.errorno=='000'){
			if(id.length>1){
				var aTr = C.Gs('TabM', 'input', true); 
				for (var i = 0, l = aTr.length; i < l; i++) {
					if (aTr[i].checked) {
						aTr[i].parentNode.parentNode.parentNode.removeChild(aTr[i].parentNode.parentNode);
					}
				}
			}else{
				var oId = id + '';//隐式转换参数类型
				var tr = C.G(oId);
				tr.parentNode.removeChild(tr);
				}
			C.G("totalP").innerHTML = parseInt(C.G("totalP").innerHTML)-1;
		}else{
			alert(Bj.msg);
		}
	}
}
function SendRecord(rid){
	if(rid == 0){
		var ids = getCheckboxIds('box_id');
		if(ids.length==0){
			MsgAlter('TMconfirmTmk',"请选中要发布的记录");
		}else{
			Dialog('TMsendMsTipTmk');
			C.G('SureSend').onclick = function () {
				MakeSureSend(ids);
			};
		}
	}else if(rid != 0){
		Dialog('TMsendMsTipTmk');
		C.G('SureSend').onclick = function () {
			MakeSureSend(rid);
		};
	}
}
//还原
function MakeSureDel(id,type){
	Dialog.Close();
	var Data="&id="+id+"&type="+type+"&sid="+"<?php echo $params['sid'];?>";
	/*添加审核是否通过*/
	if(type==1)
	{	
		Data+="&pasrdo=2";
	}
	var Url="<?php echo yii::app()->createUrl('info/examineordel');?>";

	C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  
	function goBackVal(Bj){ 
		if(Bj.errorno=='000')
		{
			alert(Bj.msg);
			location.reload();
		}else
		{
			alert(Bj.msg);
		}
	}
}
function DelRecord(rid,type){
	if(rid == 0){
		var ids = getCheckboxIds('box_id');
		if(ids.length==0){
			MsgAlter('TMconfirmTmk',"请选中要的记录");
		}else{
			if(type==1)
			{
				$('#msg_dialog').html('你确定要发布吗？');
			}else
			{
				$('#msg_dialog').html('你确定要删除吗？');
				
			}
			Dialog('TMdelMsTipTmk');
			C.G('SureDel').onclick = function () {
				MakeSureDel(ids,type);
			};
		}
	}else if(rid != 0){
		if(type==1)
		{
			$('#msg_dialog').html('你确定要发布吗？');
		}else
		{
			$('#msg_dialog').html('你确定要删除吗？');
			
		}
		Dialog('TMdelMsTipTmk');
		
		C.G('SureDel').onclick = function () {
			MakeSureDel(rid,type);
		};
		
		
	}
}


function Search(){
	var url = "&style=<?php echo $params['style'];?>&sid=<?php echo  $_GET['sid'];?>";
	if(C.G('asker').value){
		 url+="&asker="+C.G('asker').value;
	}
	if(C.G('endtime').value){
		 url+="&endtime="+C.G('endtime').value;
	}
	if(C.G('begintime').value)
	{
		 url+="&begintime="+C.G('begintime').value;
	}
	if(C.G('replyer').value)
	{
		 url+="&replyer="+C.G('replyer').value;
	}
	if(C.G('audit').value)
	{
		 url+="&audit="+C.G('audit').value;
	}
	if(url){
		location.href="<?php echo yii::app()->createUrl('info/Infoclass');?>"+encodeURI(url);
	}
}


</script>
</body>
</html>
