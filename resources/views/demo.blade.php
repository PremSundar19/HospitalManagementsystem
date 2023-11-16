<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic Select Example</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<!-- Select field to choose a location -->
<label for="location">Choose a location:</label>
<select id="location">
  <option value="1">Location 1</option>
  <option value="2">Location 2</option>
  <option value="3">Location 3</option>
  <!-- Add more locations as needed -->
</select>

<!-- Container for displaying nearby doctors -->
<div id="doctors-container">
  <label for="doctors">Select a doctor:</label>
  <select id="doctors" disabled>
    <!-- Dynamic options will be added here -->
  </select>
</div>

<script>
$(document).ready(function() {
  // Array of doctors for each location
  var doctorsByLocation = {
    1: ["Doctor A", "Doctor B", "Doctor C"],
    2: ["Doctor X", "Doctor Y", "Doctor Z"],
    3: ["Doctor P", "Doctor Q", "Doctor R"]
    // Add more doctors for each location as needed
  };

  // Function to update the doctors select field based on the selected location
  function updateDoctors(location) {
    var doctors = doctorsByLocation[location] || [];
    var doctorsSelect = $("#doctors");
    
    doctorsSelect.empty(); // Clear previous options

    if (doctors.length > 0) {
      doctorsSelect.prop("disabled", false); // Enable the select field

      // Add options for each doctor
      $.each(doctors, function(index, doctor) {
        doctorsSelect.append("<option value='" + doctor + "'>" + doctor + "</option>");
      });
    } else {
      doctorsSelect.prop("disabled", true); // Disable the select field if no doctors are available
    }
  }

  // Event handler for the location select field change
  $("#location").on("change", function() {
    var selectedLocation = $(this).val();
    updateDoctors(selectedLocation);
  });

  // Initialize doctors select based on the default location
  updateDoctors($("#location").val());
});
</script>

</body>
</html>
