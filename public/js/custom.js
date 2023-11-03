function generateReport() {
    const selectedMonth = document.getElementById("monthPicker").value;
  
    axios.get(`/generate-report?monthPicker=${selectedMonth}`)
      .then(response => {
        const reportData = response.data;
        displayReport(reportData);
      })
      .catch(error => {
        console.error('Error generating report:', error);
      });
  }
  
  function displayReport(reportData) {
    const reportContainer = document.getElementById("reportContainer");
    // Customize how you want to display the report data
    reportContainer.innerHTML = `
      <h2>Report for ${reportData.selectedMonth}</h2>
      <p>Total Salary: ${reportData.totalSalary}</p>
      <!-- Add more report data as needed -->
    `;
  }
  /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}