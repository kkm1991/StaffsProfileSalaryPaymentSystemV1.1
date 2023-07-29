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