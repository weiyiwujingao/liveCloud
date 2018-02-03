<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<title>路演中心-嘉宾管理-嘉宾列表</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css,ub/Css/NetGold/File.css,uf/Css/GoldLoad/ExSlc.css" />
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body class="Mh" style="min-height:730px;">
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">
<?php date_default_timezone_set('Asia/Chongqing');?>
	<i class="osHg tAlignL">嘉宾列表</i>
    <p class="SearBar">
            <span><i>姓名：</i><input type="text" value="<?php echo (isset($_GET['username'])&& $_GET['username'])?$_GET['username']:''?>" id="username"/></span>
			<a href="javascript:Search();" class="searBtnBig" id="searchBtn">搜索</a>
    </p>
	 <?php if($add){?><a href="javascript:void(0);" class="addBtn" onClick="Dialog('TMaddUserTmk');SetH('Ifr','TMaddUserTmk');">添加</a><?php }?>
	 <p class="SRTitle"><?php if($del){?><a href="javascript:void(0);" class="delBtn R" onClick="DelRecord(0);">删除</a><?php }?>查询结果：</p>
      <table  cellspacing="0" cellpadding="0" border="0" width="100%" class="serchResult MyMsgTab" id="Fa1">      
      <thead>
      <tr>
      	<th width="3%"><label class="Ca" for="Ca"><input type="checkbox" id="Ca" /></label></th>
		<th>嘉宾ID</th>
        <th>姓名</th>
		<th>所属分类</th>
        <th>公司名称</th>
        <th>是否主持人</th>
		<th>嘉宾链接</th>
        <th>更新日期</th>
        <th>操作</th>
      </tr>
	  
	 </thead>
    <tbody id="TabM">
    <?php 
       $i=0;
      	if($userList){
      		foreach($userList as $item){
      ?>
      <tr class="<?php echo $i%2==0?'':'evenTr'?>" id="<?php echo $item->id ;?>">
      	<td><input type="checkbox" name="box_id" value="<?php echo $item->id;?>"/></td>
		<td class="Nrp" title="<?php echo $item->id;?>"><?php echo $item->id;?>&nbsp;</td>
        <td class="Nrp" title="<?php echo $item->username;?>"><?php echo $item->username;?>&nbsp;</td>
		<td class="Nrp" title="<?php echo $item->classname->classname;?>"><?php echo $item->classname->classname;?>&nbsp;</td>
        <td class="Nrp" title="<?php echo $item->corpname->corpname;?>"><?php echo $item->corpname->corpname;?>&nbsp;</td>
        <td><?php echo $item->isadmin == 1?'是':'否'?></td>
		<td><?php echo $item->user_descurl; ?></td>
        <td class="Nrp" title="<?php echo date('Y-m-d H:i'," $item->addtime;")?>"><?php echo date('Y-m-d H:i'," $item->addtime;")?>&nbsp;</td>
        <td class="spTd">
		<?php 
			if($edit)
				{
		?>
		<a href="javascript:void(0);" class="btnStyleA L" onClick="EditUserMsg('<?php echo $item->id;?>');">修改</a><?php }?><?php if($del){?><a onClick="DelRecord(<?php echo $item->id?>);" class="btnStyleA L" href="javascript:void(0);">删除</a><?php }?>
		<a  class="btnStyleA L" href="<?php echo yii::app()->createUrl('Show/Showlist&uid='.$item->id);?>">查看路演</a>
		</td>
      </tr>
      <?php $i++;}}?>
	   
     </tbody>
    </table>
    <div class="page">
<i class="pageL L">共有 <a href="####" id="totalP"><?php echo $count; ?></a> 条数据<?php $this->widget('Pagination', array('pages' => $pages,'pagesize'=>$pagesize,'url'=>$url)); ?>
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
<!--添加嘉宾-->
<div id="TMaddUserTmk" class="MsContent">
<!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
    <dl class="mgTpMain w530 L">
    	<dt class="mgTpTitle">添加嘉宾</dt>
        <dd class="mgTpCont" style="display:block;">
		  <form id="Sm1" class="vFmV" enctype="multipart/form-data" method='post' name='Sm1' action="<?php echo yii::app()->createUrl('user/Img_Upload');?>">
            <label class="labelTd03 La" for="Nm"><i class="W80">姓名：</i><input type="text" value="" id="ausername" onblur="checkIsnull(this.value,'AddCompRt')"/><var id="AddCompRt"></var></label>
			<label class="labelTd03 La"><i class="W80">性别：</i><select name="" id="sex"><option value="1">男</option><option value="1">女</option></select></label>
			<label class="labelTd03 La" for="Pw"><i class="W80">密码：</i><input type="password" value=""  id="password" onblur="checkPwd(this.value,'ApwdRt')"/><var id="ApwdRt"></var></label>
            <label class="labelTd03" for="Jj"><i class="W80">简介：</i><textarea name=""  rows="8" class="W300 Res" id="userdesc"/></textarea></label>
			<div class="labelTd03"><i class="W80">是否主持人：</i><input type="checkbox" name="" id="isadmin" class="Vm"/>主持人所在的公司必须是“中金在线”</div>
			<div class="labelTd03"><i class="W80"></i><input type="checkbox" class="Vm" id="ischeck" name="">回复及留言不通过审核</div>
			
			<label class="labelTd03 La" for="user_descurl"><i class="W80">嘉宾链接：</i><input type="text" value=""  id="user_descurl" 
			name="user_descurl" onblur="checkIsnull(this.value,'EdtNLink')"/><var id="EdtNLink"></var></label>

			<label class="labelTd03 La"><i class="W80">公司：</i>
			<select name="" class="W130" id="cid" onchange="checkSelect(this.value,'AddComRt','请选择所在公司');">
			<option value="" selected="selected">请选择</option>
			<?php $i=0?>
     	 	<?php foreach($corplist as $key=>$item):?>
        	<option value="<?php echo $item['id']?>"><?php echo($item['corpname'])?></option>
        	<?php $i++;?>
            <?php endforeach;?>
			</select><var id="AddComRt"></var></label>
			<label class="labelTd03 La"><i class="W80">嘉宾分类：</i>
			<select name="" class="W130" id="classid" onchange="checkSelect(this.value,'AddClassRt','请选择所在分类');">
			<option value="" selected="selected">请选择</option>
			<?php $i=0?>
     	 	<?php foreach($classlist as $key=>$item):?>
        	<option value="<?php echo $item['id']?>"><?php echo($item['classname'])?></option>
        	<?php $i++;?>
            <?php endforeach;?>
			</select><var id="AddClassRt"></var></label>
			<label class="labelTd03 La" for="userid"><i class="W80">中金ID：</i><input type="text" value=""  id="userid" onblur="checkId(this.value,'AddIdRt')"/><var id="AddIdRt"></var></label>
			<label class="labelTd03 La" for="user_name"><i  class="W80">中金用户名：</i><input type="text" value=""  id="user_name" /></label>
			<label class="labelTd03 La" for="nick_name"><i class="W80">中金昵称：</i><input type="text" value="" id="nick_name" /></label>
				<!--添加擅长字段-->
			<label class="labelTd03">
				<i class="W80">擅长：</i>
				<div class="Cf ExpertBox">
				<div class="ExpertLst Fl">
					<p class="Tit">所有专家</p>
					<div class="LstWrp">
						<ul id="allExpert0">
							<li onclick="toggleClass(this,'Slced');" value="0">黄金</li>
							<li onclick="toggleClass(this,'Slced');" value="1">白银</li>
							<li onclick="toggleClass(this,'Slced');" value="2">外汇</li>
							<li onclick="toggleClass(this,'Slced');" value="3">原油</li>
							
						</ul>
					</div>
				</div>
				<div class="OpearLst Fl">
					<a class="Btn" href="javascript:void(0);" id="addExBtn0">添加&nbsp;&gt;&gt;</a>
					<a class="Btn" href="javascript:;" id="delExBtn0">&lt;&lt;&nbsp;移除</a>
					<a class="Btn" href="javascript:;" id="addAllBtn0">全部添加</a>
				</div>
				<div class="ExpertLst Fl">
					<p class="Tit">需要推送的专家</p>
					<div class="LstWrp">
						<ul id="slcedExpert0">
						</ul>
					</div>
				</div>
				</div>
			</label>
			<!--添加擅长字段end-->
              <label class="labelTd03 La" for="zhuanlan"><i class="W80">嘉宾专栏：</i><input type="text" value="" id="zhuanlan" name='zhuanlan'></label>
			<label class="hAuto labelTd03 Pst"><i class="W130">嘉宾头像：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i><!-- <input type="text" class="W190" id="AddNm4" /> -->

			<img src="" class="rePic" style="float:left;width:120px;height:120px" id="imgpath"  /><a href="javascript:Dialog.Mask(C.G('TMImgsUploadTmk'));" class="sentPicBtn" onClick="Dialog('TMImgsUploadTmk');" >上传图片</a>
			</label>
			 <span class="pm10 Pst"><a href="javascript:void(0);"  onClick="Fmadd('Sm1');checkIsnull(C.G('ausername').value,'AddCompRt');checkPwd(C.G('password').value,'ApwdRt');" id="Subtn" class="sumitBtn">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();location.reload();">取消</a><i id="addRST"></i></span>	
          </form>
	    </dd>
    </dl>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();location.reload();"></a>
</div>
<!--修改嘉宾-->
<div id="TMmodifyUserTmk" class="MsContent">
<!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
  <dl class="mgTpMain w530 L">
    	<dt class="mgTpTitle">修改嘉宾</dt>
        <dd class="mgTpCont" style="display:block;">
        <input type="hidden" class="norTxtBox" id="aid"/>
		  <form id="Sm2" name="Sm2" class="vFmV">
            <label class="labelTd03 La" for="eusername"><i class="W80">姓名：</i><input type="text" value=""  id="eusername" onblur="checkIsnull(this.value,'EdtCompRt')"/><var id="EdtCompRt"></var></label>
			<label class="labelTd03 La"><i class="W80">性别：</i><select name="" id="asex"><option value="1">男</option><option value="0">女</option></select></label>
			<label class="labelTd03 La" for="apassword"><i class="W80">密码：</i><input type="password" value=""  id="apassword" onblur="checkPwd(this.value,'EpwdRt')"/><var id="EpwdRt"></var></label>
            <label class="labelTd03" for="auserdesc"><i class="W80">简介：</i><textarea name=""  rows="8" class="W300 Res" id="auserdesc"/></textarea></label>
			<div class="labelTd03"><i class="W80">是否主持人：</i><input type="checkbox" name=""  id="aisadmin" class="Vm"/>主持人所在的公司必须是“中金在线”</div>
			<div class="labelTd03"><i class="W80"></i><input type="checkbox" class="Vm" id="aischeck" name="">回复及留言不通过审核</div>
			<div class="labelTd03"><i class="W80"></i><input type="checkbox" class="Vm" id="aissuperuser" name="">直接查看用户留言，无需主持人审核</div>
			 <label class="labelTd03 La" for="auser_descurl"><i class="W80">嘉宾链接：</i><input type="text" value=""  id="auser_descurl" name="auser_descurl" onblur=""/><var id="AEdtNLink"></var></label>
			<label class="labelTd03 La"><i class="W80">公司：</i>
			<select name="" class="W130" id="acid" onchange="checkSelect(this.value,'EdtComRt','请选择所在公司');">
			<option value="" selected="selected">请选择</option>
			<?php $i=0?>
     	 	<?php foreach($corplist as $key=>$item):?>
        	<option value="<?php echo $item['id']?>"  ><?php echo($item['corpname'])?></option>
        	<?php $i++;?>
            <?php endforeach;?>
			</select><var id="EdtComRt"></var></label>
			<label class="labelTd03 La"><i class="W80">嘉宾分类：</i>
			<select name="" class="W130" id="aclassid" onchange="checkSelect(this.value,'EdtClassRt','请选择所属分类');">
			<option value="" selected="selected">请选择</option>
			<?php $i=0?>
     	 	<?php foreach($classlist as $key=>$item):?>
        	<option value="<?php echo$item['id']?>"><?php echo($item['classname'])?></option>
        	<?php $i++;?>
            <?php endforeach;?>
			</select><var id="EdtClassRt"></var></label>
			<label class="labelTd03 La" for="auserid"><i class="W80">中金ID：</i><input type="text" value=""  id="auserid" onblur="checkId(this.value,'EditIdRt')"/><var id="EditIdRt"></var></label>
			<label class="labelTd03 La" for="auser_name"><i  class="W80">中金用户名：</i><input type="text" value="" id="auser_name" /><var></var></label>
			<label class="labelTd03 La" for="anick_name"><i class="W80">中金昵称：</i><input type="text" value="" id="anick_name" /><var></var></label>
				<!--修改添加擅长字段-->
			<label class="labelTd03">
				<i class="W80">擅长：</i>
				<div class="Cf ExpertBox">
				<div class="ExpertLst Fl">
					<p class="Tit">所有专家</p>
					<div class="LstWrp">
						<ul id="allExpert1">
							<li onclick="toggleClass(this,'Slced');" value="0">黄金</li>
							<li onclick="toggleClass(this,'Slced');" value="1">白银</li>
							<li onclick="toggleClass(this,'Slced');" value="2">外汇</li>
							<li onclick="toggleClass(this,'Slced');" value="3">原油</li>
					
						</ul>
					</div>
				</div>
				<div class="OpearLst Fl">
					<a class="Btn" href="javascript:;" id="addExBtn1">添加&nbsp;&gt;&gt;</a>
					<a class="Btn" href="javascript:;" id="delExBtn1">&lt;&lt;&nbsp;移除</a>
					<a class="Btn" href="javascript:;" id="addAllBtn1">全部添加</a>
				</div>
				<div class="ExpertLst Fl">
					<p class="Tit">需要推送的专家</p>
					<div class="LstWrp">
						<ul id="slcedExpert1">
							
						</ul>
					</div>
				</div>
				</div>
			</label>
			<!--修改添加擅长字段end-->
            <label class="labelTd03 La" for="nick_name"><i class="W80">嘉宾专栏：</i><input type="text" value="" id="zhuanlan1" name='zhuanlan'></label>
			<label class="hAuto labelTd03 Pst"><i class="W130">嘉宾头像：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i><!-- <input type="text" class="W190" id="AddNm4" /> -->

			<img src="" class="rePic" style="float:left;width:120px;height:120px" id="imgpath1"  /><a href="javascript:Dialog.Mask(C.G('TMImgsUploadTmk'));" class="sentPicBtn" onClick="Dialog('TMImgsUploadTmk');" >上传图片</a>
			</label>

		
            <span class="pm10 Pst"><a href="javascript:void(0);"  onClick="Fmedit('Sm2');checkIsnull(C.G('eusername').value,'EdtCompRt');checkPwd(C.G('apassword').value,'EpwdRt');" class="sumitBtn">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();location.reload();">取消</a><i id="editRST"></i></span>		
          </form>
	    </dd>
    </dl>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();location.reload();"></a>
</div>
<!--end window-->
<div id="TMImgsUploadTmk" class="MsContent"><!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
	<?php $this->widget('application.widget.Upload_User');?>
</div>
<script type="text/javascript" src="http://hs.cnfol.com/Cm/Js/Jquery16.js" charset="utf-8"></script>
<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,ue/Js/Cloud/DiaFix2.js,Cm/Js/Tabs.js,Cm/Js/Checkbox.js,ua/js/Clouds/Tables.js,ua/js/Clouds/Calendar.js,ub/Js/NetGold/File.js,uf/js/GoldLoad/ExpertSlc.js" type="text/javascript"></script><!--,Cm/Js/Menus.js,ud/Js/Guijs/uploadPreview.min.js-->
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/selectCheck.js"></script>
<script charset="utf-8" type="text/javascript">
Checkbox("Fa1");
//Menus("Cs1");
Tables("TabM","Ccl","Ocl");
/*
//setFile("FileBox1");	
$(function () {
	$("#Up1").uploadPreview({ Img: "ImgPr1", Width: 200, Height: 100 });
});
//setFile("FileBox");	
$(function () {
	$("#Up").uploadPreview({ Img: "ImgPr", Width: 200, Height: 100 });
});
*/
</script>
<script charset="utf-8" type="text/javascript">
var sparr=new Array('黄金','白银','外汇','原油');//嘉宾擅长的项目


function Fmadd(Id)
{  

	var Fm=C.G(Id);
//	Forms(Id);
//	Forms.Vf(Fm);/*前端表单验证*/

	Fmadd.prototype = {
            Gi:function()
            {
				/*前端验证   下拉选择框*/
				var _var = true;
				if(C.G("cid").value==""){/*判断是否选择公司*/
					C.G("AddComRt").innerHTML = "请选择所在公司";
					C.G("AddComRt").className = "No";
					_var = false;
				}else{
					C.G("AddComRt").className = "Ok";
					C.G("AddComRt").innerHTML = "";
					_var = true;
				}
				//所属分类验证
				var _var1 = true;
				if(C.G("classid").value==""){/*判断是否选择公司*/
					C.G("AddClassRt").innerHTML = "请选择所属分类";
					C.G("AddClassRt").className = "No";
					_var1 = false;
				}else{
					C.G("AddClassRt").className = "Ok";
					C.G("AddClassRt").innerHTML = "";
					_var1 = true;
				}

				if(C.G("user_descurl").value==""){/*请输入嘉宾链接*/
					C.G("EdtNLink").innerHTML = "请输入嘉宾链接";
					C.G("EdtNLink").className = "No";
					_var1 = false;
				}else{
					C.G("EdtNLink").className = "Ok";
					C.G("EdtNLink").innerHTML = "";
					_var1 = true;
				}
				//alert(exSlc0.getSlcId());

				var Str="";
				Str+="&username="+C.G('ausername').value;
				Str+="&sex="+C.G('sex').value;
				Str+="&password="+C.G('password').value;
				Str+="&userdesc="+C.G('userdesc').value;
				Str+="&user_descurl="+C.G('user_descurl').value;
				Str+="&specialty="+exSlc0.getSlcId();

				var isadmin =false;			
				if(C.G('isadmin').checked == true){
					isadmin = true;
					Str+="&isadmin=1";
					var opt = C.G('cid').options;
					var m = "";
					var flag=false;
					var flag2=false;
					for(var i=0;i<opt.length;i++){
						if(opt[i].innerHTML=="中金在线"){
								flag2=true;
								if(opt[i].selected==true){
									m = opt[i].value;
									Str+="&cid="+m;
									flag=true;
								}
						}
					}
					if(!flag2){
						alert("没有中金在线公司，不能勾选主持人");
					}else if(!flag){
						alert("请选择公司中金在线");
					}
				}else{
					isadmin = false;
				    Str+="&isadmin=0";
				    Str+="&cid="+C.G('cid').value;
				}
				if(C.G('ischeck').checked == true){	
				     Str+="&check=0";
				}else{
                     Str+="&check=1";
				}	
				
				var option = C.G('classid').options;
					var m = "";
					for(var i=0;i<option.length;i++){					
								if(option[i].selected==true){
									m = option[i].value;
									Str+="&classid="+m;
								}
					
					}
				Str+="&userid="+C.G('userid').value;
				Str+="&user_name="+C.G('user_name').value;
				Str+="&nick_name="+C.G('nick_name').value;
				Str+="&zhuanlan="+C.G('zhuanlan').value;
				Str+="&imgpath="+C.G('imgpath').src;

				if((flag==true && flag2==true && isadmin == true && C.G('AddComRt').className == "Ok" && C.G('AddClassRt').className == "Ok" && C.G('AddIdRt').className != "No" && C.G('ApwdRt').className == "Ok")||(isadmin == false && C.G('AddComRt').className == "Ok" && C.G('AddIdRt').className != "No" && C.G('ApwdRt').className == "Ok")){
					var Url="<?php echo yii::app()->createUrl('user/Adduser');?>";
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
						Dialog.Close('TMaddUserTmk');
						SetH('Ifr','TMaddUserTmk');
						location.replace('<?php echo yii::app()->createUrl('user/Userlist');?>');
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
	var Url="<?php echo yii::app()->createUrl('user/Deluser');?>";
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
			MsgAlter('TMconfirmTmk','请选中要删除的记录！');
		}else{
			Dialog('TMdelMsTipTmk');
			SetH('Ifr','TMdelMsTipTmk');

				C.G('SureDel').onclick = function () {
					MakeSureDel(ids);
				};
			}
		}else if(rid != 0){
			Dialog('TMdelMsTipTmk');
			SetH('Ifr','TMdelMsTipTmk');
				C.G('SureDel').onclick = function () {
					MakeSureDel(rid);
				};
		}
		
}

function Search(){
	var url = "";
	if(C.G('username')){
		 url="&username="+C.G('username').value;
	}
	if(url){
		location.href="<?php echo yii::app()->createUrl('user/Userlist');?>"+encodeURI(url);
	}
}
//C.AddEvent(C.G('searchBtn'),"click",Search);

function EditUserMsg(Id){
	var Url="<?php echo yii::app()->createUrl('User/Getusermsg');?>";
	var Data="&Id="+Id;
	C.EXHR(function(Bj){ myValue(Bj);},"POST", Url, Data);
	function myValue(Bj)
	{
		if(Bj.errorno=='000'){
			var arrs = Bj.content.split("|");	
			C.G("aid").value= arrs[0];
			C.G("eusername").value= arrs[1];
            C.G("asex").value= arrs[2];
            C.G("apassword").value= arrs[3];
            C.G("auserdesc").value= arrs[4];
            if(arrs[5] == 1){
            	C.G('aisadmin').checked = true;
                }
			 if(arrs[11] == 0){
            	C.G('aischeck').checked = true;
                }
			 if(arrs[16] == 0){
            	C.G('aissuperuser').checked = true;
                }
            var editcomp = C.G("acid");
			for(var i=0;i<editcomp.length;i++){
				if(editcomp.options[i].value == arrs[6]){
					editcomp.options[i].selected=true;
				}
			}	
            C.G("auserid").value= arrs[7];
			C.G("auser_name").value= arrs[8];
			C.G("anick_name").value= arrs[9];
			C.G("imgpath1").src = arrs[12];
			C.G("zhuanlan1").value= arrs[13];
			C.G("auser_descurl").value= arrs[14];
			
			/*将擅长分割成字符串*/
			var specialty=arrs[15];
			var specialtys= new Array(); //定义一数组
				specialtys=specialty.split(","); //字符分割 
				
			if(specialtys!='')
			{
				$("#slcedExpert1").html();
				for(i=0;i<specialtys.length;i++)
				{
					$("#slcedExpert1").append('<li onclick="toggleClass(this,'+"'Slced'"+');" value="'+specialtys[i]+'">'+sparr[specialtys[i]]+'</li>');
					$("#allExpert1 li[value='"+specialtys[i]+"']").remove();	
				}
			}

			var editclass = C.G("aclassid");
			for(var i=0;i<editclass.length;i++){
				if(editclass.options[i].value == arrs[10]){
					editclass.options[i].selected=true;
				}
			}	
		Dialog('TMmodifyUserTmk');
		SetH('Ifr','TMmodifyUserTmk');
	}else{
		alert(Bj.content);
	}
  }
	Dialog('TMmodifyUserTmk');
	SetH('Ifr','TMmodifyUserTmk');
}

function Fmedit(Id){
	var Fm=C.G(Id);
	Fmedit.prototype = {	
     Gi:function()
      {
	      /*拼接上传链接*/
			var Str="";
			Str+="&aid="+C.G('aid').value;
			Str+="&eusername="+C.G('eusername').value;
			Str+="&asex="+C.G('asex').value;
			Str+="&apassword="+C.G('apassword').value;
			Str+="&auserdesc="+C.G('auserdesc').value;
			/*2015/5/12 添加嘉宾链接*/
			Str+="&user_descurl="+C.G('auser_descurl').value;
			/*2015/5/12 添加嘉宾链接*/
			
			
			var isadmin =false;			
			if(C.G('aisadmin').checked == true){
				isadmin = true;
				Str+="&aisadmin=1";
				var opt = C.G('acid').options;
				var m = "";
				var flag=false;
				var flag2=false;
				for(var i=0;i<opt.length;i++){
					if(opt[i].innerHTML=="中金在线"){
							flag2=true;
							if(opt[i].selected==true){
								m = opt[i].value;
								Str+="&acid="+m;
								flag=true;
							}
					}
				}

				if(!flag2){
					alert("没有中金在线公司，不能勾选主持人");
				}else if(!flag){
					alert("请选择中金在线");
				}

			}else{
				isadmin = false;
			    Str+="&aisadmin=0";
			    Str+="&acid="+C.G('acid').value;
			}

			if(C.G('aischeck').checked == true){
			    Str+="&acheck=0";
			}else{
			    Str+="&acheck=1";
			}
			if(C.G('aissuperuser').checked == true){
			    Str+="&asuperuser=0";
			}else{
			    Str+="&asuperuser=1";
			}


			
				if(C.G("auser_descurl").value==""){/*请输入嘉宾链接*/
					C.G("AEdtNLink").innerHTML = "请输入嘉宾链接";
					C.G("AEdtNLink").className = "No";
					flag = false;
				}else{
					C.G("AEdtNLink").className = "Ok";
					C.G("AEdtNLink").innerHTML = "";
					flag = true;
				}


			
			Str+="&aclassid="+C.G('aclassid').value;
			Str+="&auserid="+C.G('auserid').value;
			Str+="&auser_name="+C.G('auser_name').value;
			Str+="&anick_name="+C.G('anick_name').value;
			Str+="&zhuanlan="+C.G('zhuanlan1').value;
			Str+="&imgpath="+C.G('imgpath1').src;
			Str+="&specialty="+exSlc1.getSlcId();

			setTimeout(function(){
				if((flag==true && flag2==true && isadmin == true && C.G('EditIdRt').className != "No" && C.G('EpwdRt').className == "Ok")||(isadmin == false && C.G('EditIdRt').className != "No" && C.G('EpwdRt').className == "Ok")){				
					var Url="<?php echo yii::app()->createUrl('user/SaveUser');?>";
					var Data=Str;
					C.EXHR(function(Bj){Fmedit.prototype.Cb(Bj);},"POST", Url,Data);
				}
	
			}, 200);
     },
            Cb:function(Bj)
			{ 
            	try{
            		Rt = C.G('editRST');
				}catch(e){}
            	if(Bj.errorno=="1000"){
            		C.AddClass(Rt,"Tjok");
    				Rst=Bj.error;
    				Dialog.Close('TMmodifyUserTmk');
					SetH('Ifr','TMmodifyUserTmk');
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
function checkSelect(val,obj,objtext){
	var objtext = objtext || "";
	if( obj!="" &&  C.G(obj) ){
		var _Rt = C.G(obj);
		if( val==0 || val=="" ){/*值为未选择*/
			_Rt.className = 'No';
			_Rt.innerHTML = objtext;
		}else{
			_Rt.className = 'Ok';
			_Rt.innerHTML = '';
		}
	}
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
		  return false;
	  }else{
	 	 var Url="<?php echo yii::app()->createUrl('user/checkisexist');?>";
	 	 var Data = "&Name="+C.G(val[1]).value+"&ID="+C.G(val[2]).val;
	 		 C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  
	 			function goBackVal(Bj){ 
	 				if(Bj.errorno=='000'){
		 				C.DelClass(Rt,"No");
	 					C.AddClass(Rt,"Ok");
	 					Rt.innerHTML = '';
	 				}else{
	 					C.DelClass(Rt,"Ok");
	 					C.AddClass(Rt,"No");
	 					Rt.innerHTML = Bj.msg;
	 				}
	 			}
	 	}
}
 C.AddEvent(C.G('ausername'),"blur",CheckIsExist,'AddCompRt|ausername|cid');//给添加公司名称文本框添加onblur事件;
 C.AddEvent(C.G('eusername'),"change",CheckIsExist,'EdtCompRt|eusername|acid');//给添加公司名称文本框添加onblur事件;

 function checkId( val , obj){
		if(val!=''){
			if(val.match(/^[0-9]*$/ )){
				C.G(obj).className ="Ok";
				C.G(obj).innerHTML = '';
			}else{
				C.G(obj).className ="No";
				C.G(obj).innerHTML = "ID格式不正确";
			}
		}else{
			C.G(obj).className ="";
			C.G(obj).innerHTML = "";
			}
	}

 function checkIsnull( val , obj){
		if(val!=''){
			C.G(obj).className ="Ok";
			C.G(obj).innerHTML = '';				
		}else{
			C.G(obj).className ="No";
			C.G(obj).innerHTML = "该项不能为空!";
			}
	}
 function checkPwd(val,obj){
		if(val!=''){
			if( val.match(/^\S{6,128}$/)){
				C.G(obj).className ="Ok";
				C.G(obj).innerHTML = '';
			}else{
				C.G(obj).className ="No";
				C.G(obj).innerHTML = "密码长度须在6-128位之间";
			}
		}else{
			C.G(obj).className ="No";
			C.G(obj).innerHTML = "该项不能为空!";
			}
	}

		/*
		 *添加擅长字段
		 *exSlc0.getSlcId()返回选中的擅长分类的ID数组.
		 */
		var exSlc0=new ExSlc(document.getElementById("allExpert0"),document.getElementById("slcedExpert0"));
		exSlc0.initFun("addExBtn0","delExBtn0","addAllBtn0");
		var exSlc1=new ExSlc(document.getElementById("allExpert1"),document.getElementById("slcedExpert1"));
		exSlc1.initFun("addExBtn1","delExBtn1","addAllBtn1");
</script>
<script charset="utf-8" type="text/javascript">
if(top.C.G("CM1")){
   setTimeout(function(){top.C.G("CM1").style.height="600px";top.C.Ehs("CM1","Ifr")},500);
}
</script>
</body>
</html>
