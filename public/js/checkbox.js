/**
 * Created by xucaozhi on 2015/6/28.
 */
function checkAll(iframe,checkbox){
    var tbody = document.getElementById(iframe).contentWindow.document.getElementsByClassName('checkbox-tbody');
    var headCheck = document.getElementById(checkbox);

    if(!headCheck.checked){
        for(var i=0; i<tbody.length; i++){
            tbody[i].removeAttribute('checked');
        }
    }else{
        for(var i=0; i<tbody.length; i++){
            tbody[i].setAttribute("checked","true");
        }
    }
}