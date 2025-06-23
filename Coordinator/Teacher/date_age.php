<script>
    // Disable today's date for the date input field
    var currentDate = new Date();
    currentDate.setDate(currentDate.getDate() - 1); // Set it to one day before today's date
    var maxDate = currentDate.toISOString().split('T')[0]; // Convert to YYYY-MM-DD format

    document.getElementById('birthdate').setAttribute('max', maxDate); // Set max attribute to one day before today's date

    // Age calculation
    document.getElementById('birthdate').addEventListener('input', function() {
        var birthDate = new Date(this.value);
        
        // Calculate the difference in years
        var age = currentDate.getFullYear() - birthDate.getFullYear();
        var m = currentDate.getMonth() - birthDate.getMonth();
        
        if (m < 0 || (m === 0 && currentDate.getDate() < birthDate.getDate())) {
            age--;
        }
        
        // Set the calculated age to the "age" input field
        document.getElementById('age').value = age;
    });
</script>