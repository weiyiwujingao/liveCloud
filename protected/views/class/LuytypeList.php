<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路演中心-分类管理-分类列表</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css" />
<style>
.mgTpCont select{height:auto !important;}
</style>
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body class="Mh" style="min-height:700px;">
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">
	<i class="osHg tAlignL">分类列表</i>
	<?php date_default_timezone_set('Asia/Chongqing');?>
    <p class="SearBar">
            <span><i>分类名称：</i><input type="text" value="<?php echo (isset($_GET['keyword'])&& $_GET['keyword'])?$_GET['keyword']:''?>" id="keyword"/></span>
			<a href="javascript:Search();" class="searBtnBig" id="searchBtn">搜索</a>
    </p>
	 <?php if($add){?><a href="javascript:void(0);" class="addBtn" onClick="Dialog('TMaddClassTmk');">添加</a><?php }?>
	 <p class="SRTitle">查询结果：<?php if($del){?><a href="javascript:void(0);" class="delBtn R" onClick="DelRecord(0);">删除</a><?php }?></p>
      <table  cellspacing="0" cellpadding="0" border="0" width="100%" class="serchResult MyMsgTab" id="Fa1">      
      <thead>
       <tr>
      	<th width="3%"><label class="Ca" for="Ca"><input type="checkbox" id="Ca" /></label></th>
        <th>分类ID</th>
        <th>分类名称</th>
        <th>分类简介</th>
        <th>广告位</th>
        <th>logo</th>
        <th>行情</th>
        <th>栏目</th>
        <th>创建时间</th>
        <th width="10%">操作</th>
      </tr>
	  
	 </thead>
    <tbody id="TabM">
    <?php 
       $i=0;
      	if($classList){
      		foreach($classList as $item){
      ?>
      <tr class="<?php echo $i%2==0?'':'evenTr'?>" id="<?php echo $item->id ;?>">
      	<td><input type="checkbox"  name="box_id" value="<?php echo $item->id;?>" /></td>
        <td><?php echo $item->id ;?>&nbsp;</td>
        <td class="Nrp" title="<?php echo $item->classname ;?>"><a style="color:#276FA3;" href="####" onclick="Searchshow('<?php echo $item->id ;?>');"><?php echo $item->classname ;?>&nbsp;</td>
        <td class="Nrp" title="<?php echo $item->memo ;?>"><?php echo $item->memo ;?>&nbsp;</td>
		<td class="Nrp">
		<?php  if(!empty($advertising[$item->advertising]))echo $advertising[$item->advertising];?>&nbsp;
		</td>
		<td class="Nrp"><img src="<?php echo $item->class_logo;?>" width="100"></td>
		<td class="Nrp">
		<?php  echo $hangqing[$item->quotation];?>&nbsp;
		</td>
		<td class="Nrp" title="">
			<?php  
				foreach($rs as $val)
				{
					if($val['id']==$item->channel_id_2||$val['id']==$item->channel_id_1||$val['id']==$item->channel_id)
					{
						echo $val['name'].',';	
					}
				}
			?>
			&nbsp;</td>
        <td class="Nrp" title="<?php echo date('Y-m-d H:i'," $item->addtime;")?>"><?php echo date('Y-m-d H:i'," $item->addtime;")?>&nbsp;</td>
        <td class="spTd"><?php if($edit){?><a href="javascript:void(0);" class="btnStyleA L" onClick="EditClassMsg('<?php echo $item->id ;?>');">修改</a><?php }?><?php if($del){?><a onClick="DelRecord(<?php echo $item->id?>);" class="btnStyleA L" href="javascript:void(0);">删除</a><?php }?></td>
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
        	<span><a href="javascript:void(0);" class="sumitBtn" id="SureDel">确定</a><a href="javascript:void(0);"  class="cancelBtn" onClick="Dialog.Close();">取消</a></span>	
        </div>
    </div>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>
<!--添加分类-->
<div id="TMaddClassTmk" class="MsContent">
<dl class="mgTpMain w530 L">
    	<dt class="mgTpTitle">添加分类</dt>
        <dd class="mgTpCont" style="display:block;">
        	<form action="####" method="post" id="Sm1" class="vFmV wIp">
            	<label class="labelTd03 La" for="Aclassname"><i class="W80">分类名称：</i><input type="text" value="" class="W320" id="Aclassname"/><var id="AddCompRt"></var></label>
         		<label class="labelTd03" for="Aclassmemo"><i class="W80">分类简介：</i><textarea name=""  rows="8" class="W320" id="Aclassmemo"></textarea></label>
            	
			
			
			  <label class="labelTd03" for="Anavigation"><i class="W80">导航：</i><textarea name=""  rows="8" class="W300 Res" id="Anavigation"/></textarea><var id=""></var></label>
            <label class="labelTd03 La" for="Aadvertising"><i class="W80">广告位：</i>
                <select name="" class="W130" id="Aadvertising">
                <option value="-1" selected="selected">请选择</option>
				<?php 
				
					if(!empty($advertising))
					{
						foreach($advertising as $key=>$val)
						{
							echo '<option value="'.$key.'">'.$val.'</option>';
						}
					}
				?>
				
                </select><var id="altAdv"></var>
            </label>
            <label class="hAuto labelTd03 Pst"><i class="W130">logo：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i><!-- <input type="text" class="W190" id="AddNm4" /> -->
			<img class="class_logo" style="float:left;width:120px;height:120px" name="" id="Aclass_logo" src=""/>
            <var id="Alogo"></var>
            <a href="javascript:Dialog.Mask(C.G('TMImgsUploadTmk'));" class="sentPicBtn" onClick="Dialog('TMImgsUploadTmk');" >上传图片</a>
			</label>
            <label class="labelTd03 La" for="Aquotation"><i class="W80">行情：</i>
                <select name="" class="W130" id="Aquotation">
                <option value="-1" selected="selected">请选择</option>
                <option value="1">黄金行情</option>
                <option value="2">期货行情</option>
                <option value="3">股票行情</option>
				<option value="4">保险行情</option>
				<option value="5">基金行情</option>
				<option value="6">外汇行情</option>
				<option value="7">证券行情</option>
				<option value="9">出国行情</option>
                <option value="10">原油行情</option>
				<option value="11">邮币卡行情</option>
				<option value="12">私募行情</option>
                </select><var id="altQuotes"></var>
            </label>
			<label class="labelTd03 La" for="Acolumn_id"><i class="W80">选择栏目：</i>
                <select name="" class="W130" id="Acolumn_id" onchange="upAchannel(this.value,'Achannel_id');">
                <option value="-1" selected="selected">请选择</option>
				<?php foreach($rs as $val)
				{
					if($val['parentid']==1)
					{
						echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
                <select name="" class="W130" id="Achannel_id">
                <option value="-1" selected="selected">请选择</option>
				<?php foreach($rs as $val)
				{
					if($val['parentid']!=1)
					{
						echo '<option class="Achannel_id" style="display:none" name="Achannel_id'.$val['parentid'].'" value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
            </label>

			<label class="labelTd03 La" for=" "><i class="W80">选择栏目：</i>
                <select name="" class="W130" id="Acolumn_id_1" onchange="upAchannel(this.value,'Achannel_id_1');">
                <option value="-1" selected="selected">请选择</option>
				<?php foreach($rs as $val)
				{
					if($val['parentid']==1)
					{
						echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
                <select name="" class="W130" id="Achannel_id_1">
                <option value="-1" selected="selected">请选择</option>
				<?php foreach($rs as $val)
				{
					if($val['parentid']!=1)
					{
						echo '<option class="Achannel_id_1" style="display:none" name="Achannel_id_1'.$val['parentid'].'" value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
            </label>

			<label class="labelTd03 La" for=" "><i class="W80">选择栏目：</i>
                <select name="" class="W130" id="Acolumn_id_2" onchange="upAchannel(this.value,'Achannel_id_2');">
                <option value="-1" selected="selected">请选择</option>
				<?php foreach($rs as $val)
				{
					if($val['parentid']==1)
					{
						echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
                <select name="" class="W130" id="Achannel_id_2">
                <option value="-1" selected="selected">请选择</option>
				<?php foreach($rs as $val)
				{
					if($val['parentid']!=1)
					{
						echo '<option class="Achannel_id_2" style="display:none" name="Achannel_id_2'.$val['parentid'].'" value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
            </label>

			<div class="labelTd03" for="Nc4"><i class="W80">&nbsp;</i><input  id="Aisshow" name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>
			
			<span class="pm10 Pst"><a href="####" class="sumitBtn" id="Subtn" onclick="Fmadd('Sm1');">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();">取消</a><i id="editRST"></i></span>	

			</form>        
        </dd>
    </dl>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>
<!--修改产品信息-->
<div id="TMmodifyClassTmk" class="MsContent">
   <dl class="mgTpMain w530 L">
    	<dt class="mgTpTitle">修改分类</dt>
        <dd class="mgTpCont" style="display:block;">
        	<input type="hidden"  id="aid"/>
        	<input type="hidden" id="hidValue"/>
        	<form action="####" method="post" id="Sm2" class="vFmV wIp">
            	<label class="labelTd03 La"><i>分类名称：</i><input type="text" value="" class="W320" id="Eclassname"/><var id="EdtCompRt"></var></label>
         		<label class="labelTd03"><i>分类简介：</i><textarea name=""  rows="8" class="W320" id="Ememo"></textarea></label>


				
			  <label class="labelTd03" for=""><i class="W80">导航：</i><textarea name=""  rows="8" class="W300 Res" id="Enavigation"/></textarea><var id=""></var></label>
            <label class="labelTd03 La"><i class="W80">广告位：</i>
                <select name="" class="W130" id="Eadvertising">
                <option value="-1" selected="selected">请选择</option>
				<?php 
					if(!empty($advertising))
					{
						foreach($advertising as $key=>$val)
						{
							echo '<option value="'.$key.'">'.$val.'</option>';
						}
					}
				?>
				
                </select><var id="altAdv"></var>
            </label>
            <label class="hAuto labelTd03 Pst"><i class="W130">logo：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i><!-- <input type="text" class="W190" id="AddNm4" /> -->
			<img class="class_logo" style="float:left;width:120px;height:120px" name="" id="Eclass_logo" src=""/>
            <var id="Alogo"></var>
            <a href="javascript:Dialog.Mask(C.G('TMImgsUploadTmk'));" class="sentPicBtn" onClick="Dialog('TMImgsUploadTmk');" >上传图片</a>
			</label>
            <label class="labelTd03 La"><i class="W80">行情：</i>
                <select name="" class="W130" id="Equotation">
                <option value="-1" selected="selected">请选择</option>
                <option value="1">黄金行情</option>
                <option value="2">期货行情</option>
                <option value="3">股票行情</option>
				<option value="4">保险行情</option>
				<option value="5">基金行情</option>
				<option value="6">外汇行情</option>
				<option value="7">证券行情</option>
				<option value="9">出国行情</option>
                <option value="10">原油行情</option>
				<option value="11">邮币卡行情</option>
				<option value="12">私募行情</option>
                </select><var id="altQuotes"></var>
            </label>
			<label class="labelTd03 La" for=" "><i class="W80">选择栏目：</i>
                <select name="" class="W130" id="Ecolumn_id"  onchange="upAchannel(this.value,'Echannel_id');">
                <option value="-1" selected="selected">请选择</option>
              	<?php foreach($rs as $val){
					if($val['parentid']==1)
					{
						echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
                <select name="" class="W130" id="Echannel_id">
                <option value="-1" selected="selected">请选择</option>
                <?php foreach($rs as $val){
					if($val['parentid']!=1)
					{
						echo '<option class="Echannel_id" style="display:none" name="Echannel_id'.$val['parentid'].'" value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
            </label>

			<label class="labelTd03 La" for=" "><i class="W80">选择栏目：</i>
                <select name="" class="W130" id="Ecolumn_id_1"  onchange="upAchannel(this.value,'Echannel_id_1');">
                <option value="-1" selected="selected">请选择</option>
              	<?php foreach($rs as $val){
					if($val['parentid']==1)
					{
						echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
                <select name="" class="W130" id="Echannel_id_1">
                <option value="-1" selected="selected">请选择</option>
                <?php foreach($rs as $val){
					if($val['parentid']!=1)
					{
						echo '<option class="Echannel_id_1" style="display:none" name="Echannel_id_1'.$val['parentid'].'" value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
            </label>

			
			<label class="labelTd03 La" for=" "><i class="W80">选择栏目：</i>
                <select name="" class="W130" id="Ecolumn_id_2"  onchange="upAchannel(this.value,'Echannel_id_2');">
                <option value="-1" selected="selected">请选择</option>
              	<?php foreach($rs as $val){
					if($val['parentid']==1)
					{
						echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
                <select name="" class="W130" id="Echannel_id_2">
                <option value="-1" selected="selected">请选择</option>
                <?php foreach($rs as $val){
					if($val['parentid']!=1)
					{
						echo '<option class="Echannel_id_2" style="display:none" name="Echannel_id_2'.$val['parentid'].'" value="'.$val['id'].'">'.$val['name'].'</option>';
					}
				}?>
                </select>
            </label>

			<div class="labelTd03" for="Nc4"><i class="W80">&nbsp;</i><input  id="Eisshow" name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>

			<span class="pm10 Pst"><a href="####" class="sumitBtn" id="Subtn2" onclick="Fmedit('Sm2');">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();">取消</a><i id="editRST"></i></span>	

			</form>        
        </dd>
    </dl>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>
<!--end window-->
<div id="TMImgsUploadTmk" class="MsContent"><!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
		<?php $this->widget('application.widget.Upload_User');?>
</div>
<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,ue/Js/Cloud/Dialog5.js,Cm/Js/Tabs.js,Cm/Js/Checkbox.js,ua/js/Clouds/Tables.js,ua/js/Clouds/Calendar.js,Cm/Js/Menus.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/selectCheck.js"></script>
<script charset="utf-8" type="text/javascript">
Checkbox("Fa1");
Menus("Cs1");
Tables("TabM","Ccl","Ocl");
</script>
<script charset="utf-8" type="text/javascript">
var BE = false;
if(top.C.G("CM1")){
	setTimeout(function(){top.C.G("CM1").style.height="600px";top.C.Ehs("CM1","Ifr")},500);
}
</script>
<script charset="utf-8" type="text/javascript">
function Searchshow(id){
	var url = "";
	if(id){
		var url="&cid="+id;
	}
	if(url){
		location.href="<?php echo yii::app()->createUrl('Show/Showclasslist')?>"+encodeURI(url);
	}
}

/*获取频道子列表*/
function upAchannel(pa,ch){
	var Html=[],
		Val=[],
		All='';
	$("#"+ch+"_01").remove();//删除上一次生成的select
	All+='<select id="'+ch+'_01"><option value="-1">请选择</option>';//开始保存新的select
	$("option[name='"+ch+pa+"']").each(function(index, element){
        Val.push($(this).val());
        Html.push($(this).html());
		All+='<option value="'+$(this).val()+'">'+$(this).html()+'</option>';
    });
	All+='</select>';
	//$('#'+ch).val('-1');
	$('#'+ch).hide();//隐藏总select
	$('#'+ch).after(All);//重新生成select
}
/*function upAchannel(pa,ch)
{
	$('.'+ch).hide();
	$(ch+pa).show();
	$("option[name='"+ch+pa+"']").show();
	$('#'+ch).val('-1');
}*/


function Fmadd(Id)
{  
	//var BE=true;
	var Fm=C.G(Id);
	//console.log(C.G(Id));

//	Forms(Id);
//	Forms.Vf(Fm);/*前端表单验证*/
	
	Fmadd.prototype = {
			Dt:function()
			{
				var Str="";
				Str+="&classname="+C.G('Aclassname').value;
				Str+="&classmemo="+C.G('Aclassmemo').value;
				Str+="&navigation="+C.G('Anavigation').value;
				Str+="&advertising="+C.G('Aadvertising').value;
				Str+="&class_logo="+C.G('Aclass_logo').src;
				Str+="&quotation="+C.G('Aquotation').value;
				Str+="&column_id="+C.G('Acolumn_id').value;
				if(C.G('Achannel_id_01'))
				{
					Str+="&channel_id="+C.G('Achannel_id_01').value;
				}
				Str+="&column_id_1="+C.G('Acolumn_id_1').value;

				if(C.G('Achannel_id_1_01'))
				{
					Str+="&channel_id_1="+C.G('Achannel_id_1_01').value;
				}
				Str+="&column_id_2="+C.G('Acolumn_id_2').value;
				if(C.G('Achannel_id_2_01'))
				{
					Str+="&channel_id_2="+C.G('Achannel_id_2_01').value;
				}
				if(C.G('Aisshow').checked == true){	
				     Str+="&isshow=1";
				}else{
                     Str+="&isshow=0";
				}

				return Str;
			},
            Gi:function()
            {
				
				/*前端验证   下拉选择框*/
				 var str = "AddCompRt|Aclassname";
			 	 CheckIsExist('',str);
				
				
				
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
						Dialog.Close('TMaddClassTmk');
//						location.reload();
						location.replace('<?php echo yii::app()->createUrl('Class/Showclass');?>');
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
	var Url="<?php echo yii::app()->createUrl('Class/Delclass');?>";
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

function Search(){
	var url = "";
	if(C.G('keyword')){
		var url="&keyword="+C.G('keyword').value;
	}
	if(url){
		location.href="<?php echo yii::app()->createUrl('Class/Showclass');?>"+encodeURI(url);
	}
}
//C.AddEvent(C.G('searchBtn'),"click",Search);



function EditClassMsg(Id){
	var Url="<?php echo yii::app()->createUrl('Class/Getclassmsg');?>";
	var Data="&Id="+Id;
	C.EXHR(function(Bj){ myValue(Bj);},"POST", Url, Data);
	function myValue(Bj)
	{
		if(Bj.errorno=='000'){
			
			var arrs = Bj.content.split("|");
			C.G("aid").value= arrs[0];
			C.G("hidValue").value = arrs[1];//隐藏的分类名称
			C.G("Eclassname").value= arrs[1];
			C.G("Ememo").value= arrs[2];
			C.G("Ecolumn_id").value= arrs[3];
			C.G("Echannel_id").value= arrs[4];
			C.G("Eclass_logo").src= arrs[5];
			C.G("Enavigation").value= arrs[6];
			C.G("Eadvertising").value= arrs[7];
			C.G("Equotation").value= arrs[8];
			C.G("Ecolumn_id_1").value= arrs[10];
			C.G("Echannel_id_1").value= arrs[11];
			C.G("Ecolumn_id_2").value= arrs[12];
			C.G("Echannel_id_2").value= arrs[13];
			
			upAchannel(arrs[3],'Echannel_id');//显示修改子栏目
			upAchannel(arrs[10],'Echannel_id_1');//显示修改子栏目
			upAchannel(arrs[12],'Echannel_id_2');//显示修改子栏目

			 if(arrs[9] == 1){
            	C.G('Eisshow').checked = true;
                }
		Dialog('TMmodifyClassTmk');
		setTimeout(function(){
			C.G("Echannel_id_01").value= arrs[4];
			C.G("Echannel_id_1_01").value= arrs[11];
			C.G("Echannel_id_2_01").value= arrs[13];
		},10);
	}else{
		alert(Bj.content);
	}
  }
	Dialog('TMmodifyClassTmk');
}

function Fmedit(Id){
	var Fm=C.G(Id);
//	Forms(Id);
//	Forms.Vf(Fm);/*前端表单验证*/
	Fmedit.prototype = {
            Gi:function()
            {
				var Str="";
				Str+="&aid="+C.G('aid').value;
				Str+="&classname="+C.G('Eclassname').value;// 类别名	
				Str+="&memo="+C.G('Ememo').value;// 类别简介
				Str+="&navigation="+C.G('Enavigation').value;
				Str+="&advertising="+C.G('Eadvertising').value;
				Str+="&class_logo="+C.G('Eclass_logo').src;
				Str+="&quotation="+C.G('Equotation').value;
				Str+="&column_id="+C.G('Ecolumn_id').value;
				if(C.G('Echannel_id_01'))
				{
					Str+="&channel_id="+C.G('Echannel_id_01').value;
				}
				Str+="&column_id_1="+C.G('Ecolumn_id_1').value;
				if(C.G('Echannel_id_1_01'))
				{
					Str+="&channel_id_1="+C.G('Echannel_id_1_01').value;
				}
				Str+="&column_id_2="+C.G('Ecolumn_id_2').value;
				if(C.G('Echannel_id_2_01'))
				{
					Str+="&channel_id_2="+C.G('Echannel_id_2_01').value;
				}
				if(C.G('Eisshow').checked == true){	
				     Str+="&isshow=1";
				}else{
                     Str+="&isshow=0";
				}
				
				
				var Url="<?php echo yii::app()->createUrl('Class/Saveclass');?>";
				var Data=Str;
				C.EXHR(function(Bj){Fmedit.prototype.Cb(Bj);},"POST", Url,Data);
			
            },
            Cb:function(Bj)
			{ 
            	try{
            		Rt = C.G('editRST');
				}catch(e){}
            	if(Bj.errorno=="1000"){
            		C.AddClass(Rt,"Tjok");
    				Rst=Bj.error;
    				Dialog.Close('TMmodifyClassTmk');
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
/*author by yuexl
 * date:2012.07.12;
 * description:判断所填分类名称是否已经存在;
 */
 function CheckIsExist(e,rtID){
	 var val = rtID.split("|");//拆分字符串
	  var Rt = C.G(val[0]);
	  if(C.G(val[1]).value==''){//内容为空
		  C.AddClass(Rt,"No");	
		  Rt.innerHTML = "该项不能为空";
		  BE = false;
	  }else{
	 	 var Url="<?php echo yii::app()->createUrl('class/checkisexist');?>";
	 	 var Data = "&Name="+C.G(val[1]).value;
	 		 C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  
	 			function goBackVal(Bj){
					
	 				if(Bj.errorno=='000'){
		 				BE = true;
		 				C.DelClass(Rt,"No");
	 					C.AddClass(Rt,"Ok");
	 					Rt.innerHTML = '';
						/*发送请求*/
						var Url="<?php echo yii::app()->createUrl('Class/Addshowclass');?>";
						var Data=Fmadd.prototype.Dt();
						if (C.G("Subtn").className.indexOf('disabled') == -1) 
						{ 
							C.EXHR(function(Bj){Fmadd.prototype.Cb(Bj);},"POST", Url,Data);
							C.AddClass(C.G("Subtn"),"disabled");
						}

	 				}else{
	 					BE = false;
	 					C.DelClass(Rt,"Ok");
	 					C.AddClass(Rt,"No");
	 					Rt.innerHTML = Bj.msg;
						
	 				}
	 			}
	 	}
}
 C.AddEvent(C.G('AddClass_Name'),"blur",CheckIsExist,'AddCompRt|AddClass_Name');//给添加公司名称文本框添加onblur事件;
 C.AddEvent(C.G('Eclassname'),"change",CheckIsExist,'EdtCompRt|Eclassname');//给添加公司名称文本框添加onblur事件;
</script>
</body>
</html>
