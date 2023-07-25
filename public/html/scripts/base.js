const apiUrl = 'https://korotkov.me/api/';

function fetchData(url, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        callback(JSON.parse(xhr.responseText));
      } else {
        console.error('Error fetching data. Status:', xhr.status);
      }
    }
  };

  xhr.send();
}

function formatDate(date) {
  const day = date.getDate().toString().padStart(2, '0');
  const month = (date.getMonth() + 1).toString().padStart(2, '0');
  const year = date.getFullYear();

  return `${day}.${month}.${year}`;
}


function getDateFrom(dateString, days = 0) {
  const date = new Date(dateString);
  date.setDate(date.getDate() + days);
  return formatDate(date);
}
