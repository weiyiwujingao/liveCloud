<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路演中心-嘉宾管理-嘉宾列表</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css" />
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
<script type="text/javascript" src="http://hs.cnfol.com/ue/Js/Cloud/WdatePicker.js"></script>
</head>
<body class="Mh1" style="min-height:1500px">
<!--<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>-->
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">
	<i class="osHg tAlignL">路演列表</i>
	<input type="hidden" id="hidCid" value="<?php echo $_GET['cid'];?>"/>
	<?php 
//	date_default_timezone_set('Asia/Chongqing');
	?>
    <p class="SearBar">
            <span><i>主题：</i><input type="text" value="<?php echo (isset($_GET['keyword'])&& $_GET['keyword'])?$_GET['keyword']:''?>" id="keyword"/></span>
			<span><i>嘉宾：</i><input type="text" value="<?php echo (isset($_GET['UserName'])&& $_GET['UserName'])?$_GET['UserName']:''?>" id="UserName"/></span>
			<a href="javascript:Search();" class="searBtnBig" id="searchBtn">搜索</a>
    </p>
	 <?php if($add){?><a href="javascript:void(0);" class="addBtn" onClick="Dialog('TMaddPowerTmk');">添加</a><?php }?>
	 <p class="SRTitle"><?php if($del){?><a href="javascript:void(0);" class="delBtn R" onClick="DelRecord(0);">删除</a><?php }?>查询结果：</p>
      <table  cellspacing="0" cellpadding="0" border="0" width="100%" class="serchResult MyMsgTab" id="Fa1">      
      <thead>
      <tr>
      	<th width="4%"><label class="Ca" for="Ca"><input type="checkbox" id="Ca" /></label></th>
        <th width="6%">路演ID</th>
        <th width="13%">主题</th>
		<th width="13%">嘉宾</th>
        <th width="12%">开始时间</th>
        <th width="12%">结束时间</th>
		<th width="10%">浏览量</th>
		<th width="10%">创建人</th>
        <th width="10%">创建时间</th>
        <th width="10%">操作</th>
      </tr>	  
	 </thead>
    <tbody id="TabM">
    <?php if($sign ==1){?>
   	 <?php 
	       $i=0;
	      	if($showList){
	      		foreach($showList as $item){
	      ?>
	      <tr class="<?php echo $i%2==0?'':'evenTr'?>" id="<?php echo $item->sid ;?>">
	      	<td><input type="checkbox" name="box_id" value="<?php echo $item->sid;?>"/></td>
	        <td><a target="blank" style="color:#276FA3;" href="http://roadshow.cnfol.com/show/<?php echo $item->sid;?>"><?php echo $item->sid;?>&nbsp;</a></td>
	        <td class="Nrp" title="<?php echo $item->Showmsg['topic'];?>"><?php echo $item->Showmsg['topic'];?>&nbsp;</td>
			<td class="Nrp" title="<?php echo $item->username->username;?>"><?php echo $item->username->username;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo @date('Y-m-d H:i',$item->Showmsg['starttime']) ;?>"><?php echo @date('Y-m-d H:i',$item->Showmsg['starttime']) ;?>&nbsp;</td>
			<td class="Nrp" title="<?php echo @date('Y-m-d H:i',$item->Showmsg['endtime']) ;?>"><?php echo @date('Y-m-d H:i',$item->Showmsg['endtime']) ;?>&nbsp;</td>
			<td class="Nrp" title="<?php echo $item->ip_num.'/'.$item->hits;?>"><?php echo $item->ip_num.'/'.$item->hits;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo $item->cloud_user;?>"><?php echo $item->cloud_user;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo @date('Y-m-d H:i',$item->Showmsg['addtime']) ;?>"><?php echo @date('Y-m-d H:i',$item->Showmsg['addtime']) ;?>&nbsp;</td>
	        <td class="spTd"><a href="<?php echo yii::app()->createUrl('Show/lookinfo&id='.$item->sid.'&cid='.$cid);?>" class="btnStyleA L">查看</a><?php if($edit){?><a href="javascript:void(0);" class="btnStyleA L" onClick="EditShowMsg('<?php echo $item->sid ;?>');">修改</a><?php }?><?php if($del){?><a onClick="DelRecord(<?php echo $item->sid?>);" class="btnStyleA L" href="javascript:void(0);">删除</a><?php }?></td>
	      </tr>
	       <?php $i++;}}?>
    <?php }else{?>
	    <?php 
	       $i=0;
	      	if($showList){
	      		foreach($showList as $item){
	      ?>
	      <tr class="<?php echo $i%2==0?'':'evenTr'?>" id="<?php echo $item->id ;?>">
	      	<td><input type="checkbox" name="box_id" value="<?php echo $item->id;?>"/></td>
	        <td><a style="color:#276FA3;" target="blank" href='http://roadshow.cnfol.com/show/<?php echo $item->id;?>'><?php echo $item->id;?>&nbsp;</a></td>
	        <td class="Nrp" title="<?php echo $item->topic;?>"><?php echo $item->topic;?>&nbsp;</td>
			<td class="Nrp" title="<?php echo $item->username->username;?>"><?php echo $item->username->username;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo @date('Y-m-d H:i',"$item->starttime") ;?>"><?php echo @date('Y-m-d H:i',"$item->starttime") ;?>&nbsp;</td>
			<td class="Nrp" title="<?php echo @date('Y-m-d H:i',"$item->endtime") ;?>"><?php echo @date('Y-m-d H:i',"$item->endtime") ;?>&nbsp;</td>
			<td class="Nrp" title="<?php echo $item->ip_num.'/'.$item->hits;?>"><?php echo $item->ip_num.'/'.$item->hits;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo $item->cloud_user;?>"><?php echo $item->cloud_user;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo @date('Y-m-d H:i',"$item->addtime") ;?>"><?php echo @date('Y-m-d H:i',"$item->addtime") ;?>&nbsp;</td>
	        <td class="spTd"><a href="<?php echo yii::app()->createUrl('Show/lookinfo&id='.$item->id.'&cid='.$cid);?>" class="btnStyleA L">查看</a><?php if($edit){?><a href="javascript:void(0);" class="btnStyleA L" onClick="EditShowMsg('<?php echo $item->id ;?>');">修改</a><?php }?><?php if($del){?><a onClick="DelRecord(<?php echo $item->id?>);" class="btnStyleA L" href="javascript:void(0);">删除</a><?php }?></td>
	      </tr>
	       <?php $i++;}}?>
       <?php }?>
     </tbody>
    </table>
    <div class="page">
<i class="pageL L">共有 <a href="####" id="totalP"><?php echo $count; ?></a> 条数据 <?php $this->widget('Pagination', array('pages' => $pages,'pagesize'=>$pagesize,'url'=>$url)); ?>
</i></div>
</section>
<!--弹出窗-->
<div id="TMconfirmTmk" class="MsContent"></div>
<!--delete-->
<div id="TMdelMsTipTmk" class="MsContent">
	<div class="mgTpMain w250 L">
    	<div class="mgTpTitle">信息提示</div>
        <div class="mgTpCont">
        	<p>你确定要删除吗？</p>
        	<span><a href="javascript:void(0);" class="sumitBtn" id="SureDel">确定</a><a href="javascript:void(0);"  class="cancelBtn" onClick="Dialog.Close();">取消</a></span>	
        </div>
    </div>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>
<!--添加路演-->
<div id="TMaddPowerTmk" class="MsContent">
<!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
    <dl class="mgTpMain W698 L Psr">
    	<dt class="mgTpTitle">添加路演</dt>
        <dd class="mgTpCont" style="display:block;">
		  <form id="Sm1" class="vFmV">
            <label class="labelTd03 La" for="Nm"><i class="W130">主题：</i><input type="text" id="Addtopic" class="W350" /><var id="AddCompRt"></var></label>
            <label class="hAuto labelTd03 Pst"><i class="W130">上传图片：</i><!-- <input type="text" class="W190" id="AddNm4" /> -->
			<img src="" class="rePic" style="float:left;" id="AddhdImg" /><a href="javascript:Dialog.Mask(C.G('TMImgsUploadTmk'));" class="sentPicBtn" onClick="Dialog('TMImgsUploadTmk');" >上传图片</a>
			</label>
            
			<label class="labelTd03 La" for="Astarttime"><i class="W130">开始时间：</i><input type="text" value=""  preset="Rqd"  id="Astarttime" class="W350 Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /><var></var></label>
			<label class="labelTd03 La" for="Aendtime"><i  class="W130">结束时间：</i><input type="text" value=""  preset="Rqd"  id="Aendtime" class="W350 Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /><var></var></label>

    		<label class="labelTd03 La" for="Ti"><i  class="W130">IP：</i><input type="checkbox" value="" name="" id="Ashowip"/></label>

            <div class="labelTd03" for="Nc3"><i class="W130">相关视频：</i><input type="text" value="" id="Aplayer_num" class="W350" /><input  name="" type="checkbox" value="" class="Vm Ml5" id="Ashowplayer" />是否显示</div>

			<div class="labelTd03" for="Nc4"><i class="W130">产品信息：</i><input type="text" value="" id="Aprocdesc" class="W350" /><input  name="" type="checkbox" value="" class="Vm Ml5" id="Ashowproc" />是否显示</div>
       	    <div class="labelTd03"><i class="W130">当前在线人数：</i><input type="text" value=""  class="W30 L" id="Aonlinenum1"/><em class="L">至</em><input type="text" class="W30 L" id="Aonlinenum2" onblur="checkNum(this.value,'addPh')"/><var id="addPh"></var></div>
			
			<div class="labelTd03"><i class="W130">所有嘉宾：</i>
			<select id="Auserid">
			<option href="#" value="0">请选择嘉宾</option>
     	 	<?php foreach($userlist as $key=>$item):?>
			<?php if($item['isadmin']==0){?>
        	<option href="#" value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
			<?php }?>
            <?php endforeach;?>			
			</select>
			</div>

			<div class="labelTd03"><i class="W130">所有主持人：</i>
			<select id="Aadmin">	
			<option href="#" value="0">请选择主持人</option>
     	 	<?php foreach($userlist as $key=>$item):?>
			<?php if($item['isadmin']==1){?>
        	<option href="#" value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
			<?php }?>
            <?php endforeach;?>			
			</select>
			</div>

            <label class="labelTd03 Mt12" for="Nc8"><i class="W130">备注：</i><textarea type="text" value="" id="Amemo" class="W450" rows="5"> </textarea><var></var></label>
            <span class="pm10 Pst"><a href="javascript:void(0);"  onClick="Fmadd('Sm1');checkNum(C.G('Aonlinenum1').value,'addPh');checkNum(C.G('Aonlinenum2').value,'addPh');" class="sumitBtn" id="Subtn">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();location.reload();">取消</a><i id="addRST"></i></span>	
          </form>
	    </dd>
    </dl>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();location.reload();"></a>
</div>
<!--修改路演-->
<div id="TMmodifyPowerTmk" class="MsContent">
<!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
  <dl class="mgTpMain W698 L">
    	<dt class="mgTpTitle">修改路演</dt>
        <dd class="mgTpCont" style="display:block;">
          <input type="hidden" class="norTxtBox" id="aid"/>
		   <input type="hidden" id="hidValue"/>
		  <form id="Sm2" class="vFmV">
            <label class="labelTd03 La" for="Nm"><i class="W130">主题：</i><input type="text" class="W350" id="edittopic"/><var id="EdtCompRt"></var></label>
            <label class="hAuto labelTd03 Pst"><i class="W130">主题图片：</i><!-- <input type="text" class="W190" id="AddNm4" /> -->
			<img src="" class="rePic" style="float:left;" id="EdithdImg" /><a href="javascript:Dialog.Mask(C.G('TMImgsUploadTmk'));" class="sentPicBtn" onClick="Dialog('TMImgsUploadTmk');" >上传图片</a>
			</label>
			<label class="labelTd03 La" for="Zjid"><i class="W130">开始时间：</i><input type="text" value=""  preset="Rqd"  id="estarttime" class="W350 Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /><var></var></label>
			<label class="labelTd03 La" for="Ti"><i  class="W130">结束时间：</i><input type="text" value=""  preset="Rqd"  id="eendtime" class="W350 Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /><var></var></label>
    		<label class="labelTd03 La" for="Ti"><i  class="W130">IP：</i><input type="checkbox" value="" name="" id="eshowip"/></label>
			
			 <div class="labelTd03" for="Nc3"><i class="W130">相关视频：</i><input type="text" value="" id="eplayer_num" class="W350" /><input  name="" type="checkbox" value="" class="Vm Ml5" id="eshowplayer" />是否显示</div>
			<div class="labelTd03" for="Nc4"><i class="W130">产品信息：</i><input type="text" value="" id="eprocdesc" class="W350" /><input  id="eshowproc" name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>
       	    <div class="labelTd03"><i class="W130">当前在线人数：</i><input type="text" class="W30 L" id="eonlinenum1"/><em class="L">至</em><input type="text" class="W30 L" id="eonlinenum2"/><var id="edtPh"></var></div>
           
			<div class="labelTd03"><i class="W130">所有嘉宾：</i>
			<select id="euserid">
			<option href="#" value="0">请选择嘉宾</option>
     	 	<?php foreach($userlist as $key=>$item):?>
			<?php if($item['isadmin']==0){?>
        	<option href="#" value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
			<?php }?>
            <?php endforeach;?>			
			</select>
			</div>

			<div class="labelTd03"><i class="W130">所有主持人：</i>
			<select id="eadmin">	
			<option href="#" value="0">请选择主持人</option>
     	 	<?php foreach($userlist as $key=>$item):?>
			<?php if($item['isadmin']==1){?>
        	<option href="#" value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
			<?php }?>
            <?php endforeach;?>			
			</select>
			</div>


            <label class="labelTd03 Mt12" for="Nc8"><i class="W130">备注：</i><textarea type="text" value="" id="ememo" class="W450" rows="5" > </textarea><var></var></label>
            <span class="pm10 Pst"><a href="javascript:void(0);"  onClick="Fmedit('Sm2');checkNum(C.G('eonlinenum1').value,'edtPh');checkNum(C.G('eonlinenum2').value,'edtPh');" class="sumitBtn">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();location.reload();">取消</a><i id="editRST"></i></span>	
          </form>
	    </dd>
    </dl>
    <a href="####" class="closeBtn L" onClick="Dialog.Close();location.reload();"></a>
</div>

<div id="TMImgsUploadTmk" class="MsContent"><!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
	<?php $this->widget('application.widget.Upload_User');?>
</div>
<!--end window-->
<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,Cm/Js/Dialog.js,Cm/Js/Jquery16.js,Cm/Js/Tabs.js,Cm/Js/Checkbox.js,ua/js/Clouds/Tables.js,ua/js/Clouds/Calendar.js,Cm/Js/Menus.js,Cm/Js/Forms.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/selectCheck.js"></script>
<script charset="utf-8" type="text/javascript">
Checkbox("Fa1");
Menus("Cs1");
Tables("TabM","Ccl","Ocl");
Forms("Sm1","Sm2");
if(top.C.G("CM1")){
	setTimeout(function(){top.C.G("CM1").style.height="600px";top.C.Ehs("CM1","Ifr")},500);
}

function Compare(str) {
    var obj = C.G(str),
        ifr = top.C.G('Ifr'),
        objh = obj.offsetTop + obj.offsetHeight;

//    alert(obj.offsetTop + " : " +  obj.offsetHeight + " : " + ifr.offsetHeight);
        
    if(ifr.offsetHeight < objh){
        setTimeout(function(){
            ifr.style.height = objh + "px";
            Dialog.Mask && Dialog.Mask(str);
        },50);
    }
}

var BE = false;
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
</script>
<script charset="utf-8" type="text/javascript">
function Search(){
	 var url='';
	if(C.G('UserName').value){
		 url+="&UserName="+C.G('UserName').value;
	}
	if(C.G('keyword').value){
		alert(C.G('keyword').value);
		 url+="&keyword="+C.G('keyword').value;
	}
	if(C.G('hidCid').value)
	{
		url+="&cid="+C.G('hidCid').value;
	}
	
	if(url){
		location.href="<?php echo yii::app()->createUrl('Show/Showlist');?>"+encodeURI(url);
	}
}
//C.AddEvent(C.G('searchBtn'),"click",Search);

function getCheckboxIds(checkbox_name) 
{ 
	
	var vInput=document.getElementsByTagName("INPUT");
	var ids=new Array();
	for(var i=0;i<vInput.length;i++){ 
		var obj=vInput[i]; 
		if(vInput[i].checked==true) 
		{   
			ids.push(vInput[i].value);
		  
		} 
	}
	return ids;
	 
} 

function MakeSureDel(id){
	Dialog.Close();
	var Url="<?php echo yii::app()->createUrl('Show/Delshow');?>";
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
function DelRecord(rid){
	if(rid == 0){
		var ids = getCheckboxIds('box_id');
		if(ids.length==0){
			MsgAlter('TMconfirmTmk',"请选中要删除的记录");
		}else{
			Dialog('TMdelMsTipTmk');
			C.G('SureDel').onclick = function () {
				MakeSureDel(ids);
			};
			}
		}else if(rid != 0){
			Dialog('TMdelMsTipTmk');
			C.G('SureDel').onclick = function () {
				MakeSureDel(rid);
			};
		}
		
}

function Fmadd(Id)
{  
	var Fm=C.G(Id);
	Forms(Id);
//	Forms.Vf(Fm);/*前端表单验证*/
	Fmadd.prototype = {
            Gi:function()
            {
				var Str="";
				Str+="&Addtopic="+C.G('Addtopic').value;
//				Str+="&Atopicpic="+C.G('Atopicpic').value;

				var hdImg = C.G('AddhdImg').src;
				var arrs = hdImg.split("?");
					if( arrs[0] && arrs[1] ){/*判断是否上传图片，如果未上传。。*/
						Str+="&Atopicpic="+'';
					}else{
						Str+="&Atopicpic="+C.G('AddhdImg').src;/*上传则传入数据*/
					}
					
				Str+="&Astarttime="+C.G('Astarttime').value;
				Str+="&Aendtime="+C.G('Aendtime').value;


				var VST = C.G('Astarttime').value;
				var VET = C.G('Aendtime').value;
				var As = false;				
				var STime = new Date(Date.parse(VST.replace(/-/g, "/"))),
					ETime = new Date(Date.parse(VET.replace(/-/g, "/")));
				var StrST = VST.slice(0, 10);
				    StrET = VET.slice(0, 10);
				    if(VST && VET){
				    	if (StrST == StrET && STime.getTime() >= ETime.getTime()) {
				    		As = false;
							alert('结束时间必须晚于开始时间！');
						} else if(StrST > StrET){
							As = false;
							alert('结束时间必须晚于开始时间！');
							}else{
								As = true;
								}
				    }
				    
				if(C.G('Ashowip').checked == true){
				     Str+="&Ashowip=1";
				}else{
					Str+="&Ashowip=0";
					}

				/*视频id*/
				Str+="&Aplayer_num="+C.G('Aplayer_num').value;
				if(C.G('Ashowplayer').checked == true){
				     Str+="&Ashowplayer=1";
				}else{
					Str+="&Ashowplayer=0";
				}
							
				Str+="&Aprocdesc="+C.G('Aprocdesc').value;
				if(C.G('Ashowproc').checked == true){
				     Str+="&Ashowproc=1";
				}else{
					Str+="&Ashowproc=0";
				}	
				
				Str+="&Aonlinenum1="+C.G('Aonlinenum1').value;
				Str+="&Aonlinenum2="+C.G('Aonlinenum2').value;
				Str+="&Amemo="+C.G('Amemo').value;
				//添加分类名称，邀请的嘉宾
				if(C.G('Auserid').value==0)
				{
					alert('请选择嘉宾！');
				}
				if(C.G('Aadmin').value==0)
				{
					alert('请选择主持人！');
				}
				Str+="&Auserids="+C.G('Auserid').value;
				Str+="&Aadmin="+C.G('Aadmin').value;

				/*前端验证   下拉选择框*/
				var _var = true;		
				 var str = "AddCompRt|Addtopic";
			 	 CheckIsExist('',str);
				if(Fm.V==true  && As == true  && BE == true ){
				
					var Url="<?php echo yii::app()->createUrl('Show/Addshow');?>";
					var Data=Str;
					if (C.G("Subtn").className.indexOf('disabled') == -1) { 
					    C.EXHR(function(Bj){Fmadd.prototype.Cb(Bj);},"POST", Url,Data);
					C.AddClass(C.G("Subtn"),"disabled");
					}
				}
            },
            Cb:function(Bj)
			{ 
            	C.DelClass(C.G("Subtn"),"disabled");
				Rt = C.G('addRST');
				switch (Bj.errorno)
				{
					case "1000":
						C.AddClass(Rt,"Tjok");
						Rst=Bj.error;
						Dialog.Close('TMaddPowerTmk');
						location.reload();
	//					location.replace('<?php echo yii::app()->createUrl('Show/Showlist');?>');
					break;
					default:
						C.AddClass(Rt,"Tjno");
						Rst=Bj.error;
					break;
				} 
				Rt.innerHTML=Rst;
			}
    }
Fmadd.prototype.Gi(Id);
	}

function addOne(obj,myobj){
	var classid = C.G(obj).value;
	if(classid){
	    var classname = C.G(obj).options[C.G(obj).selectedIndex].innerHTML;	
	    var option=C.G(myobj);
		var opt = C.G(myobj).options;
		var sign = true;
		for(var i=0;i<opt.length;i++){
	      	if(opt[i].value == classid){
				sign = false;
	        }
		}
		if(sign == true){
			option.options.add(new Option(classname,classid));	
		}
	}else{
         alert('请选择要移动的');
		}
		
}
	function removeOne(id){
        var obj=document.getElementById(id);
       // index,要删除选项的序号，这里取当前选中选项的序号
        var index=obj.selectedIndex;
        obj.options.remove(index);
  }

	  function getclassid(id){
		  var ids=new Array();
		  var aOps = C.G(id).options;
		  var l= aOps.length;
		  for (var i = 0;i < l; i++){
			  ids.push(aOps[i].value);
		  }
		  return ids;
		  }


	  function EditShowMsg(Id){
			var Url="<?php echo yii::app()->createUrl('Show/Getshowmsg');?>";
			var Data="&Id="+Id;
			C.EXHR(function(Bj){ myValue(Bj);},"POST", Url, Data);
			function myValue(Bj)
			{
				if(Bj.errorno=='000'){
					var arrs = Bj.content.split("|");	
					C.G("aid").value= arrs[0];
					C.G("edittopic").value= arrs[1];
					C.G("hidValue").value= arrs[1];
					C.G("EdithdImg").src= arrs[2];
					C.G("estarttime").value= changeTimeFormat(parseInt(arrs[3])*1000);
					C.G("eendtime").value= changeTimeFormat(parseInt(arrs[4])*1000);
					if(arrs[5] == 1){
		            	C.G('eshowip').checked = true;
		                }

					C.G("eprocdesc").value= arrs[12];
					if(arrs[13] == 1)
					{
		            	C.G('eshowproc').checked = true;
		            }
				

	                if(arrs[19] == 1){
						//C.G('Ehits').checked = true;
	                }
					C.G("eonlinenum1").value= arrs[16];
					C.G("eonlinenum2").value= arrs[17];
					C.G("ememo").value= arrs[18];

					

					C.G("eplayer_num").value= arrs[20];
					C.G("euserid").value= arrs[21];
					if(arrs[22] == 1)
					{
						C.G('eshowplayer').checked = true;
	                }
					//C.G("eshowplayer").value= arrs[22];
					C.G("eadmin").value= arrs[23];

				Dialog('TMmodifyPowerTmk');
				
				Compare("TMmodifyPowerTmk");
			}else{
				alert(Bj.content);
			}
		  }
			Dialog('TMmodifyPowerTmk');
		}

	  function Fmedit(Id){
			var Fm=C.G(Id);
			Forms(Id);
//			Forms.Vf(Fm);/*前端表单验证*/
			Fmedit.prototype = {
					Dt:function()
					{
						var Str="";
						Str+="&aid="+C.G('aid').value;
						Str+="&edittopic="+C.G('edittopic').value;

						var hdImg = C.G('EdithdImg').src;
						var arrs = hdImg.split("?");
							if( arrs[0] && arrs[1] ){/*判断是否上传图片，如果未上传。。*/
								Str+="&etopicpic="+'';
							}else{
								Str+="&etopicpic="+C.G('EdithdImg').src;/*上传则传入数据*/
							}
						Str+="&estarttime="+C.G('estarttime').value;
						Str+="&eendtime="+C.G('eendtime').value;
						
						if(C.G('eshowip').checked == true){
						     Str+="&eshowip=1";
						}else{
							Str+="&eshowip=0";
							}
						
												
									
						Str+="&eprocdesc="+C.G('eprocdesc').value;
						if(C.G('eshowproc').checked == true)
						{
						     Str+="&eshowproc=1";
						}else
						{
							Str+="&eshowproc=0";
						}

							
						Str+="&eplayer_num="+C.G('eplayer_num').value;
						if(C.G('eshowplayer').checked == true)
						{
						     Str+="&eshowplayer=1";
						}else
						{
							Str+="&eshowplayer=0";
						}
						
						Str+="&eonlinenum1="+C.G('eonlinenum1').value;
						Str+="&eonlinenum2="+C.G('eonlinenum2').value;
						Str+="&ememo="+C.G('ememo').value;

						//添加分类名称，邀请的嘉宾
						if(C.G('euserid').value==0)
						{
							alert('请选择嘉宾！');
							exit;
						}
						if(C.G('eadmin').value==0)
						{
							alert('请选择主持人！');
							exit;
						}
						Str+="&euserids="+C.G('euserid').value;
						Str+="&eadmin="+C.G('eadmin').value;

						/*前端验证   下拉选择框*/
						
						return Str;
					},
		            Gi:function()
		            {
						var _var = true;
						

						var VST = C.G('estarttime').value;
						var VET = C.G('eendtime').value;
						var Es = false;				
						var STime = new Date(Date.parse(VST.replace(/-/g, "/"))),
							ETime = new Date(Date.parse(VET.replace(/-/g, "/")));
						var StrST = VST.slice(0, 10);
						    StrET = VET.slice(0, 10);
						    if(VST && VET){
						    	if (StrST == StrET && STime.getTime() >= ETime.getTime()) {
						    		Es = false;
									alert('结束时间必须晚于开始时间！');
								} else if(StrST > StrET){
									Es = false;
									alert('结束时间必须晚于开始时间！');
									}else{
										Es = true;
										}
						    }
						if(C.G("hidValue").value == C.G("edittopic").value){//如果两值相等即没有修改
							BE = true;
							C.G("EdtCompRt").className = 'Ok';
							C.G("EdtCompRt").innerHTML = "";
						}
						if( BE == false){//再次验证
							var str = "EdtCompRt|edittopic";
						 	CheckIsExist('',str);
						}
						if(Fm.V==true && Es == true  && BE == true){
							var Url="<?php echo yii::app()->createUrl('Show/Saveshow');?>";
							var Data=Fmedit.prototype.Dt();
							C.EXHR(function(Bj){Fmedit.prototype.Cb(Bj);},"POST", Url,Data);
							}
	
		            },
		            Cb:function(Bj)
					{ 
		            	try{
		            		Rt = C.G('editRST');
						}catch(e){}
		            	if(Bj.errorno=="1000"){
		            		C.AddClass(Rt,"Tjok");
		    				Rst=Bj.error;
		    				Dialog.Close('TMmodifyPowerTmk');
							location.reload();
		        			}else{
		        				C.AddClass(Rt,"Tjno");
		        				Rst=Bj.error;
		            			}
						   Rt.innerHTML=Rst;
					}
		    }
		Fmedit.prototype.Gi(Id);
		}
	  
	  function changeTimeFormat(time) {
		    var date = new Date(time);
		    var month = date.getMonth() + 1 < 10 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1;
		    var currentDate = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
		    var hh = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
		    var mm = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
		    return date.getFullYear() + "-" + month + "-" + currentDate+" "+hh + ":" + mm;
		    //返回格式：yyyy-MM-dd hh:mm
		}

	  /*author by yuexl
	   * date:2012.07.12;
	   * description:判断所填路演是否已经存在;
	   */
	   function CheckIsExist(e,rtID){
			 var val = rtID.split("|");//拆分字符串
			  var Rt = C.G(val[0]);
			  if(C.G(val[1]).value==''){//内容为空
				  C.AddClass(Rt,"No");	
				  Rt.innerHTML = "该项不能为空";
				   BE = false;
			  }else{
			 	 var Url="<?php echo yii::app()->createUrl('show/checkisexist');?>";
			 	 var Data = "&Name="+C.G(val[1]).value;
			 		 C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  
			 			function goBackVal(Bj){
			 				if(Bj.errorno=='000'){
				 				 BE = true;
				 				C.DelClass(Rt,"No");
			 					C.AddClass(Rt,"Ok");
			 					Rt.innerHTML = '';			 					
			 				}else{
			 					 BE = false;
			 					C.DelClass(Rt,"Ok");
			 					C.AddClass(Rt,"No");
			 					Rt.innerHTML = Bj.msg;
			 				}
			 			}
			 	}
		}
	   C.AddEvent(C.G('Addtopic'),"blur",CheckIsExist,'AddCompRt|Addtopic');//给添加公司名称文本框添加onblur事件;
	   C.AddEvent(C.G('edittopic'),"change",CheckIsExist,'EdtCompRt|edittopic');//给添加公司名称文本框添加onchange事件;
</script>
</body>
</html>
