/**
 * Created by xucaozhi on 2015/6/27.
 */

//左侧功能按钮选择
function selectModule(n){
    var leftBtn = document.getElementsByClassName("leftBtn");
    var rowContent = document.getElementsByClassName("row-content");

    for(var i=0; i<leftBtn.length; i++){
        leftBtn[i].className = "leftBtn";
        rowContent[i].className = "row row-content display-none";
    }
    leftBtn[n].className = "leftBtn active";
    rowContent[n].className = "row row-content";
}


//给学校添加关联品牌
function addBrandToSchool(){
    var form = document.getElementById("brand-price-school-form");
    var div = document.getElementsByClassName("brand-for-school-item");
    var select = div[0].getElementsByTagName("select")[0];
    var option = select.options;

    var newDiv = div[0].cloneNode(true);
    var newSelect = newDiv.getElementsByTagName("select");
    var newOption = newSelect[0].options;
    var selectedNum = 0;

    if(option.length == div.length){
        alert("该学校已关联了所有品牌了。");
        return false;
    }else{
        for(var i=0; i<option.length; i++){
            if(option[i].disabled == true){
                newOption[i].disabled = "true";
            }else if(option[i].selected == true){
                newOption[i].disabled = "true";
                newOption[i].removeAttribute("selected");
            }else if(selectedNum == 0){
                newOption[i].setAttribute("selected","true");
                selectedNum++;
                for(var j=0; j<div.length; j++){
                    var selectN = div[j].getElementsByTagName("select");
                    selectN[0].options[i].disabled = "true";
                }
            }
        }
        form.appendChild(newDiv);
    }
}
//选中某项后，将selected添加给该项目
function changeOptions(selection){
    var select = selection;
    var defaultSelVal = 0;
    var selectIndVal = 0;

    for(var i=0; i<select.options.length; i++){
        if(select.options[i].defaultSelected){
            defaultSelVal = select.options[i].innerHTML;
        }
        select.options[i].removeAttribute('selected');
    }
    select.options[select.selectedIndex].setAttribute('selected', 'true');
    selectIndVal = select.options[select.selectedIndex].innerHTML;

    //获取父盒子
    var div = document.getElementsByClassName("brand-for-school-item");
    for(var i=0; i<div.length; i++){
        var optionsAll = div[i].getElementsByTagName("select")[0].options;
        for(var j=0; j<optionsAll.length; j++){
            if(optionsAll[j].innerHTML == defaultSelVal){
                optionsAll[j].removeAttribute("disabled");
            }
            if(optionsAll[j].innerHTML == selectIndVal && optionsAll[j].selected != true){
                optionsAll[j].setAttribute("disabled","true");
            }
        }
    }
}
//删除学校关联的品牌
function deleteBrandFromSchool(btn){

    if(confirm("确定要删除吗？")) {
        var form = document.getElementById("brand-price-school-form");
        var divDel = btn.parentNode;
        var selectDel = divDel.getElementsByTagName("select")[0];
        var defaultOptVal = 0;

        for (var i = 0; i < selectDel.options.length; i++) {
            if (selectDel.options[i].defaultSelected) {
                defaultOptVal = selectDel.options[i].innerHTML;
            }
        }
        //获取父盒子
        var div = document.getElementsByClassName("brand-for-school-item");
        for (var i = 0; i < div.length; i++) {
            var optionsAll = div[i].getElementsByTagName("select")[0].options;
            for (var j = 0; j < optionsAll.length; j++) {
                if (optionsAll[j].innerHTML == defaultOptVal) {
                    optionsAll[j].removeAttribute("disabled");
                }
            }
        }
        var length = div.length;
        if (length == 1) {
            alert("至少关联一个品牌");
        } else {


            form.removeChild(divDel);
        }
    }
}
//重置关联的宿舍
function resetDor(){
    var dormitoryBox = document.getElementById('dormitory-whole-box');
    var firstSelect = document.getElementsByClassName('form-control')[0];

    firstSelect.innerHTML = "<option></option>";

    var firstDor = document.getElementsByClassName('dormitory-box')[0];
    var cloneFirstDor = firstDor.cloneNode(true);

    dormitoryBox.innerHTML = "";

    dormitoryBox.appendChild(cloneFirstDor);
}


//送水员关联学校&宿舍
//选择不同宿舍
function changeDorOpt(selection){
    var select = selection;
    var defaultSelVal = 0;
    var selectIndVal = 0;

    for(var i=0; i<select.options.length; i++){
        if(select.options[i].defaultSelected){
            defaultSelVal = select.options[i].innerHTML;
        }
        select.options[i].removeAttribute('selected');
    }
    select.options[select.selectedIndex].setAttribute('selected', 'true');
    selectIndVal = select.options[select.selectedIndex].innerHTML;

    //获取父盒子
    var div = document.getElementsByClassName("dormitory-box");
    for(var i=0; i<div.length; i++){
        var optionsAll = div[i].getElementsByTagName("select")[0].options;
        for(var j=0; j<optionsAll.length; j++){
            if(optionsAll[j].innerHTML == defaultSelVal){
                optionsAll[j].removeAttribute("disabled");
            }
            if(optionsAll[j].innerHTML == selectIndVal && optionsAll[j].selected != true){
                optionsAll[j].setAttribute("disabled","true");
            }
        }
    }
}
//点击添加宿舍按钮
function addDorToSchool(){
    var faDiv = document.getElementById("dormitory-whole-box");
    var div = document.getElementsByClassName("dormitory-box");
    var select = div[0].getElementsByTagName("select")[0];
    var option = select.options;

    var newDiv = div[0].cloneNode(true);
    var newSelect = newDiv.getElementsByTagName("select");
    var newOption = newSelect[0].options;
    var selectedNum = 0;

    if(option.length == div.length){
        alert("该学校的所有宿舍楼都已经添加了。");
        return false;
    }else{
        for(var i=0; i<option.length; i++){
            if(option[i].disabled == true){
                newOption[i].disabled = "true";
            }else if(option[i].selected == true){
                newOption[i].disabled = "true";
                newOption[i].removeAttribute("selected");
            }else if(selectedNum == 0){
                newOption[i].setAttribute("selected","true");
                selectedNum++;
                for(var j=0; j<div.length; j++){
                    var selectN = div[j].getElementsByTagName("select");
                    selectN[0].options[i].disabled = "true";
                }
            }
        }
        faDiv.appendChild(newDiv);
    }
}
//点击删除按钮
function delDor(btn){
    if(confirm("确定要删除吗？")) {
        var faDiv = document.getElementById("dormitory-whole-box");
        var divDel = btn.parentNode;
        var selectDel = divDel.getElementsByTagName("select")[0];
        var defaultOptVal = 0;

        for (var i = 0; i < selectDel.options.length; i++) {
            if (selectDel.options[i].defaultSelected) {
                defaultOptVal = selectDel.options[i].innerHTML;
            }
        }
        //获取父盒子
        var div = document.getElementsByClassName("dormitory-box");
        for (var i = 0; i < div.length; i++) {
            var optionsAll = div[i].getElementsByTagName("select")[0].options;
            for (var j = 0; j < optionsAll.length; j++) {
                if (optionsAll[j].innerHTML == defaultOptVal) {
                    optionsAll[j].removeAttribute("disabled");
                }
            }
        }
        var length = div.length;
        if (length == 1) {
            alert("至少关联该学校的一栋宿舍楼");
        } else {
            faDiv.removeChild(divDel);
        }
    }
}
//点击删除按钮，功能同上
function delDor_C(btn){
    var faDiv = document.getElementById("dormitory-whole-box");
    var divDel = btn.parentNode;
    var selectDel = divDel.getElementsByTagName("select")[0];
    var defaultOptVal = 0;

    for (var i = 0; i < selectDel.options.length; i++) {
        if (selectDel.options[i].defaultSelected) {
            defaultOptVal = selectDel.options[i].innerHTML;
        }
    }
    //获取父盒子
    var div = document.getElementsByClassName("dormitory-box");
    for (var i = 0; i < div.length; i++) {
        var optionsAll = div[i].getElementsByTagName("select")[0].options;
        for (var j = 0; j < optionsAll.length; j++) {
            if (optionsAll[j].innerHTML == defaultOptVal) {
                optionsAll[j].removeAttribute("disabled");
            }
        }
    }
    var length = div.length;
    if (length == 1) {
        alert("至少关联该学校的一栋宿舍楼");
    } else {
        faDiv.removeChild(divDel);
    }
}

//修改空桶数量功能是否可用
function oneCheck(){
    var td = document.getElementsByClassName('checkbox-tbody');
    var trueNum = 0;
    var btn = parent.document.getElementById('empty-button');
    var btnSubstitute = parent.document.getElementById('empty-button-substitute');


    for(var i=0;i<td.length;i++){
        if(td[i].checked==true){
            trueNum++;
        }
    }
    if(trueNum == 1){
        btn.style.display = 'block';
        btnSubstitute.style.display = 'none';
    }else{
        btn.style.display = 'none';
        btnSubstitute.style.display = 'block';
    }
}