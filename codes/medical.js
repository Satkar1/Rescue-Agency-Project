function showHospitalOnMap(event) {
  var index = event.target.getAttribute("data-index");
  var selectedHospital = hospitalsData[index];

  // Send hospital name to PHP script to retrieve email and send email
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "send_email.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Response from PHP script
      alert(xhr.responseText);
    }
  };
  xhr.send("hospitalName=" + encodeURIComponent(selectedHospital.name));
}
