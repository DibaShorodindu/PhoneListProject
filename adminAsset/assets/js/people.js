'use strict';



// PEOPLE NAME SEARCH FILTER
function searchPeople() {
  let input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('searchPeople');
  filter = input.value.toUpperCase();
  table = document.getElementById('peopleTable');
  tr = table.getElementsByTagName('tr');

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
}





/*let collection,  buttonGroup, messageBox, messagePhone;

messageBox = document.getElementById('message');

function accessPhoneNumber(id, phone, email) {
  collection = document.getElementById(id);
  buttonGroup = document.getElementById('buttonGroup'+id);
  collection.classList.add('hide');
  buttonGroup.classList.remove('hide');
  document.getElementById('messagePhone'+id).innerHTML = phone;
  if (email != null)
    document.getElementById('messageEmail'+id).innerHTML = email;
  else
    document.getElementById('messageEmail'+id).innerHTML = 'N/A';

}*/







