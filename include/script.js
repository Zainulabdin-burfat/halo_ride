function change_status(id,status,value) {

  var ajax;
  if (window.XMLHttpRequest) {
    ajax = new XMLHttpRequest();
  }else{
    ajax = new ActiveXObject("Microsot.XMLHTTP");
  }

  ajax.onreadystatechange = function(){

    if (ajax.status == 200 && ajax.readyState == 4) {
      alert(ajax.responseText);
      location.reload();
    }
  }
  ajax.open("GET","ajax_process.php?action=update_status&id="+id+"&status="+status+"&table="+value);
  ajax.send();
}