var ajax;
if (window.XMLHttpRequest) {
  ajax = new XMLHttpRequest();
}else{
  ajax = new ActiveXObject("Microsot.XMLHTTP");
}

function change_status(id,status,value)
{
  ajax.onreadystatechange = function()
  {
    if (ajax.status == 200 && ajax.readyState == 4) {
      alert(ajax.responseText);
      location.reload();
    }
  }
  ajax.open("GET","ajax_process.php?action=update_status&id="+id+"&status="+status+"&table="+value);
  ajax.send();
}

function getBookings(id)
{
  ajax.onreadystatechange = function()
  {
    if (ajax.status == 200 && ajax.readyState == 4) {
      document.getElementById('bookings').innerHTML = ajax.responseText;
    }
  }
  ajax.open("GET","ajax_process.php?action=get_bookings&id="+id);
  ajax.send();
}