<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路演中心-公司管理-公司列表</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css" />
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body class="Mh">
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">
	<i class="osHg tAlignL">公司列表</i>
	<?php date_default_timezone_set('Asia/Chongqing');?>
    <p class="SearBar">
            <span><i>公司名称：</i><input type="text" value="<?php echo (isset($_GET['corpname'])&& $_GET['corpname'])?$_GET['corpname']:''?>" id="corpname"/></span>
			<a href="javascript:Search();" class="searBtnBig" id="searchBtn">搜索</a>
    </p>
	 <?php if($add){?><a href="javascript:void(0);" class="addBtn" onClick="Dialog('TMaddCorpTmk');">添加</a><?php }?>
	 <p class="SRTitle"><?php if($del){?><a href="javascript:void(0);" class="delBtn R" onClick="DelRecord(0);">删除</a><?php }?>查询结果：</p>
      <table  cellspacing="0" cellpadding="0" border="0" width="100%" class="serchResult MyMsgTab" id="Fa1">      
      <thead>
      <tr>
      	<th width="3%"><label class="Ca" for="Ca"><input type="checkbox" id="Ca" /></label></th>
        <th  width="12%">公司名称</th>
        <th  width="57%">公司简介</th>
        <th  width="14%">更新日期</th>
        <th  width="14%">操作</th>
      </tr>
     </thead>
    <tbody id="TabM">
    <?php 
       $i=0;
      	if($corpList){
      		foreach($corpList as $item){
      ?>
      <tr class="<?php echo $i%2==0?'':'evenTr'?>" id="<?php echo $item->id ;?>">
      	<td><input type="checkbox" name="box_id" value="<?php echo $item->id;?>"/></td>
        <td class="Nrp" title="<?php echo $item->corpname ;?>"><?php echo $item->corpname ;?>&nbsp;</td>
        <td class="Nrp" title="<?php echo $item->corpdesc ;?>"><?php echo $item->corpdesc ;?>&nbsp;</td>
        <td class="Nrp" title="<?php echo date('Y-m-d H:i'," $item->addtime;")?>"><?php echo date('Y-m-d H:i'," $item->addtime;")?>&nbsp;</td>
        <td class="spTd"><?php if($edit){?><a href="javascript:void(0);" class="btnStyleA L" onClick="EditCorpMsg('<?php echo $item->id;?>');">修改</a><?php }?><?php if($del){?><a onClick="DelRecord(<?php echo $item->id?>);" class="btnStyleA L" href="javascript:void(0);">删除</a><?php }?></td>
      </tr>
     <?php $i++;} } ?> 
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
        	<span><a href="javascript:void(0);" class="sumitBtn" id="SureDel" >确定</a><a href="javascript:void(0);"  class="cancelBtn" onClick="Dialog.Close();">取消</a></span>	
        </div>
    </div>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>
<!--添加公司-->
<div id="TMaddCorpTmk" class="MsContent">
    <dl class="mgTpMain w530 L">
    	<dt class="mgTpTitle">添加公司</dt>
        <dd class="mgTpCont" style="display:block;">
		  <form id="Sm1" class="vFmV">
            <label class="labelTd03 La" for="Nm"><i>公司名称：</i><input type="text" value="" class="W320" id="Corp_name"/><var id="AddCompRt"></var></label>
            <label class="labelTd03" for="Jj"><i>公司简介：</i><textarea name=""  rows="8" class="W320 Res" id="Corp_desc"/></textarea></label>
            <span class="pm10 Pst"><a href="javascript:void(0);"  id="Subtn" onclick="Fmadd('Sm1');" class="sumitBtn">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();location.reload();">取消</a><i id="addRST"></i></span>	
          </form>
	    </dd>
    </dl>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();location.reload();"></a>
</div>
<!--修改公司-->
<div id="TMmodifyCorpTmk" class="MsContent">
   <dl class="mgTpMain w530 L">
    	<dt class="mgTpTitle">修改公司</dt>
        <dd class="mgTpCont" style="display:block;">
        <input type="hidden" class="norTxtBox" id="aid"/>
        <input type="hidden" id="hidValue"/>
		  <form id="Sm2" class="vFmV">
            <label class="labelTd03 La"><i>公司名称：</i><input type="text" value="" class="W320" id="acorpname"/><var id="EdtCompRt"></var></label>
            <label class="labelTd03"><i>公司简介：</i><textarea name=""  rows="8" class="W320 Res" id="acorpdesc" /></textarea></label>
            <span class="pm10 Pst"><a href="javascript:void(0);" onclick="Fmedit('Sm2');" class="sumitBtn">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();location.reload();">取消</a><i id="editRST"></i></span>	
          </form>
		</dd>
    </dl>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();location.reload();"></a>
</div>
<!--end window-->
<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,Cm/Js/Dialog.js,Cm/Js/Tabs.js,Cm/Js/Checkbox.js,ua/js/Clouds/Tables.js,ua/js/Clouds/Calendar.js,Cm/Js/Menus.js,Cm/Js/Forms.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/selectCheck.js"></script>
<script charset="utf-8" type="text/javascript">
Checkbox("Fa1");
Menus("Cs1");
Tables("TabM","Ccl","Ocl");
Forms("Sm2");
</script>
<script charset="utf-8" type="text/javascript">
var BE = false;
function Fmadd(Id) { 
	
	Fmadd.prototype = {
            Gi: function () {
		        var Str="";
		        var Flag = C.G('AddCompRt').className;
				Str+="&Corp_name="+C.G('Corp_name').value;
				Str+="&Corp_desc="+C.G('Corp_desc').value;		
//				/*前端验证   下拉选择框*/
				 var Data = "&Name="+C.G('Corp_name').value;
				 var str = "AddCompRt|Corp_name";
			 	 CheckIsExist('',str);
				setTimeout(function(){
					
					if(BE == true){
						var Url="<?php echo yii::app()->createUrl('Corp/Addcorp');?>";
						var Data=Str;
						if (C.G("Subtn").className.indexOf('disabled') == -1) { 
						    C.EXHR(function(Bj){Fmadd.prototype.Cb(Bj);},"POST", Url,Data);
						    C.AddClass(C.G("Subtn"),"disabled");
						}
					} 
				}, 400);
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
						Dialog.Close('TMaddCorpTmk');
						location.reload();
						clearForm( Id );//清空表单内容
					break;
				} 
				Rt.innerHTML=Rst;
			}
    }
    
	Fmadd.prototype.Gi(Id);
}


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
//	//console.debug(ids);
	return ids;
	 
} 

function MakeSureDel(id){
	Dialog.Close();
	var Url="<?php echo yii::app()->createUrl('Corp/Delcorp');?>";
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
//			C.AddEvent(C.G('SureDel'),"click",MakeSureDel,ids);
			}
		}else if(rid != 0){
			Dialog('TMdelMsTipTmk');		
			C.G('SureDel').onclick = function () {
				MakeSureDel(rid);
			};
//			C.AddEvent(C.G('SureDel'),"click",MakeSureDel,rid);
		}
		
}


function Search(){
	var url = "";
	if(C.G('corpname')){
		var url="&corpname="+C.G('corpname').value;
	}
	if(url){
		location.href="<?php echo yii::app()->createUrl('Corp/Corplist');?>"+encodeURI(url);
	}
}


function EditCorpMsg(Id){
	var Url="<?php echo yii::app()->createUrl('Corp/Getcorpmsg');?>";
	var Data="&Id="+Id;
	C.EXHR(function(Bj){ myValue(Bj);},"POST", Url, Data);
	function myValue(Bj)
	{
		if(Bj.errorno=='000'){
			var arrs = Bj.content.split("|");	
			C.G("aid").value= arrs[0];
			C.G("acorpname").value= arrs[1];
			C.G("hidValue").value= arrs[1];
			C.G("acorpdesc").value= arrs[2];
		Dialog('TMmodifyCorpTmk');
	}else{
		alert(Bj.content);
	}
  }
	Dialog('TMmodifyCorpTmk');
}

function Fmedit(Id){
	var Fm=C.G(Id);
	Fmedit.prototype = {
			Dt:function()
			{
				var Str="";
				Str+="&aid="+C.G('aid').value;
				Str+="&acorpname="+C.G('acorpname').value;//公司名字
				Str+="&acorpdesc="+C.G('acorpdesc').value;//公司描述
				return Str;
			},
            Gi:function()
            {
				if(C.G("hidValue").value == C.G("acorpname").value){//如果两值相等即没有修改
					BE = true;
					C.G("EdtCompRt").className = 'Ok';
					C.G("EdtCompRt").innerHTML = "";
				}
				if( BE == false){//再次验证
					var str = "EdtCompRt|acorpname";
				 	CheckIsExist('',str);
				}
				setTimeout(function () {
					if(BE == true){				
						var Url="<?php echo yii::app()->createUrl('Corp/SaveCorp');?>";
						var Data=Fmedit.prototype.Dt();
						C.EXHR(function(Bj){Fmedit.prototype.Cb(Bj);},"POST", Url,Data);
					}
				}, 400);
            },
            Cb:function(Bj)
			{ 
            	try{
            		Rt = C.G('editRST');
				}catch(e){}
            	if(Bj.errorno=="1000"){
            		C.AddClass(Rt,"Tjok");
    				Rst=Bj.error;
    				Dialog.Close('TMmodifyCorpTmk');
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
/**
* @description:判断所填公司是否已经存在;
* @author by yuexl
* @date:2012.07.12
**/
function CheckIsExist (e, rtID) {
	var val = rtID.split("|");//拆分字符串
	var Rt = C.G(val[0]);

	if (C.G(val[1]).value == '') { //内容为空
		C.AddClass(Rt,"No");	
		Rt.innerHTML = "该项不能为空";
		BE = false;
	} else {
		var Url="<?php echo yii::app()->createUrl('corp/checkisexist');?>";
		var Data = "&Name=" + C.G(val[1]).value;

		C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  

		function goBackVal(Bj) { 
			if (Bj.errorno == '000') {
				BE = true;
				C.DelClass(Rt,"No");
				C.AddClass(Rt,"Ok");
				Rt.innerHTML = '';
			} else {
				BE = false;
				C.DelClass(Rt,"Ok");
				C.AddClass(Rt,"No");
				Rt.innerHTML = Bj.msg;
			}
		}
	}
}
C.AddEvent(C.G('Corp_name'),"blur",CheckIsExist,'AddCompRt|Corp_name');//给添加公司名称文本框添加onblur事件;
C.AddEvent(C.G('acorpname'),"change",CheckIsExist,'EdtCompRt|acorpname');//给添加公司名称文本框添加onblur事件;
</script>
<script charset="utf-8" type="text/javascript">
if(top.C.G("CM1")){
   setTimeout(function(){top.C.G("CM1").style.height="600px";top.C.Ehs("CM1","Ifr")},500);
}
</script>
</body>
</html>
