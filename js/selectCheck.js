/*author by jiameng1015@126.com
/*date:2012.07.11
/*descript: 根据传入的值 判断下拉选择框是否已选中，如果选中，给定class = OK 否则class = No;
/*@params val 要验证的下拉选择框的值;
/*@params obj 存放验证信息的对象;
/*@params objtext 验证返回的信息内容;
*/
function checkSelect(val,obj,objtext){
	var objtext = objtext || "";
	if( obj!="" &&  C.G(obj) ){
		var _Rt = C.G(obj);
		val = String(val);//转化为字符类型
		if( val=="0" || val=="" ){/*值为未选择*/
			_Rt.className = 'No';
			_Rt.innerHTML = objtext;
		}else{
			_Rt.className = 'Ok';
			_Rt.innerHTML = '';
		}
	}
}
/*author by jiameng1015@126.com;
 * date:2012.07.18;
 * descript:公共提示框弹出;
 * @params alterid 存放弹出框的容器id;
 * @params msg 要显示的提示信息;
 * 注意:需要事先在页面上定义这个容器,如<div id="TMdelMsTipTmk" class="MsContent"></div>,传入的id需要遵循如下规则:前面加TM，后面加Tmk
 */
function MsgAlter( alterid,msg ){
	C.G(alterid).innerHTML='';
	var html='';
	html += "<div class=\"mgTpMain w250 L\">";
	html += "<div class=\"mgTpTitle\">信息提示</div>";
	html += "<div class=\"mgTpCont\">";
	html += "<p>"+ msg +"</p>";
	html += "<span style=\"text-align:center;\"><a href=\"javascript:void(0);\" class=\"sumitBtn\" onClick=\"Dialog.Close();\">确定</a></span>";
	html += " </div>";
	html += " </div>";
	html += "<a href=\"javascript:void(0);\" class=\"closeBtn L\" onClick=\"Dialog.Close();\"></a>";
	C.G(alterid).innerHTML = html;
	Dialog(alterid);
}

/*author by jiameng1015@126.com
 * date:2012.08.21
 * description:清空表单内容
 * @params form 表单id
 * 
 * */
function clearForm(form)
{
    var formObj = C.G(form);
    if(formObj == undefined)
    {
        return;
    }
    for(var i=0; i<formObj.elements.length; i++)
    {
        if(formObj.elements[i].type == "text")
        {
            formObj.elements[i].value = "";
        }
        else if(formObj.elements[i].type == "password")
        {
            formObj.elements[i].value = "";
        }
        else if(formObj.elements[i].type == "radio")
        {
            formObj.elements[i].checked = false;
        }
        else if(formObj.elements[i].type == "checkbox")
        {
            formObj.elements[i].checked = false;
        }
        else if(formObj.elements[i].type == "select-one")
        {
            formObj.elements[i].options[0].selected = true;
        }
        else if(formObj.elements[i].type == "select-multiple")
        {   
            for(var j = 0; j < formObj.elements[i].options.length; j++)
            {
                formObj.elements[i].options[j].selected = false;
            }
        }
        else if(formObj.elements[i].type == "file")
        {
            //formObj.elements[i].select();
            //document.selection.clear();            
            // for IE, Opera, Safari, Chrome
            var file = formObj.elements[i];
             if (file.outerHTML) {
                 file.outerHTML = file.outerHTML;
             } else {
                 file.value = "";  // FF(包括3.5)
            }
        }
        else if(formObj.elements[i].type == "textarea")
        {
            formObj.elements[i].value = "";
        }
    }
   
}