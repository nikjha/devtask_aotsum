document.addEventListener("DOMContentLoaded", function () {
    // Fetch states for the United States and bind options to the state dropdown
    fetch('get_states.php')
        .then(response => response.json())
        .then(states => {
            let stateDropdown = document.getElementById('state');
            states.forEach(state => {
                let option = document.createElement('option');
                option.value = state.state_id;
                option.text = state.state_name;
                stateDropdown.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));

    // Add change event listeners to state and city dropdowns
    document.getElementById('state').addEventListener('change', function () {
        let stateId = this.value;

        // Fetch cities based on selected state and bind options to the city dropdown
        fetch(`get_cities.php?state_id=${stateId}`)
            .then(response => response.json())
            .then(cities => {
                let cityDropdown = document.getElementById('city');
                // Clear previous options
                cityDropdown.innerHTML = '';

                cities.forEach(city => {
                    let option = document.createElement('option');
                    option.value = city.city_id;
                    option.text = city.city_name;
                    cityDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    });

    // Add change event listeners to course, tenth_per, and twelveth_per input fields
    document.getElementById('course').addEventListener('change', updateConcession);
    document.getElementById('tenth_per').addEventListener('input', updateConcession);
    document.getElementById('twelveth_per').addEventListener('input', updateConcession);

    function updateConcession() {
        let courseId = document.getElementById('course').value;
        let tenthPercentage = parseFloat(document.getElementById('tenth_per').value);
        let twelfthPercentage = parseFloat(document.getElementById('twelveth_per').value);

        // Calculate mean of 10th and 12th percentages
        let concessionPercentage = (tenthPercentage + twelfthPercentage) / 2;
        let formattedConcession = `${concessionPercentage.toFixed(1)}%`;

        // Update table heading with the calculated concession percentage
        //document.getElementById('concession-heading').textContent = `Concession (${formattedConcession})`;

        // Fetch course fees based on the selected course and update the course fees table and total fees field
        fetch(`get_course_fees.php?course_id=${courseId}`)
            .then(response => response.json())
            .then(courseFees => {
                let courseFeesTable = document.getElementById('course-fees');
                let totalFeesInput = document.getElementById('total-fees');

                // Clear previous course fees and total fees
                courseFeesTable.innerHTML = '';
                totalFeesInput.value = '';

                let totalFees = 0;
                courseFees.forEach(fee => {
                    let row = courseFeesTable.insertRow();
                    let cell1 = row.insertCell(0);
                    // let cell2 = row.insertCell(1);
                    let cell3 = row.insertCell(1);
                    let cell4 = row.insertCell(2);
                    let cell5 = row.insertCell(3);

                    cell1.textContent = fee.year;
                    // cell2.textContent = fee.duration;
                    cell3.textContent = fee.fee;

                    // Calculate concession based on updated 10th and 12th percentages
                    let tenthConcession = calculateConcession(tenthPercentage, fee.fee);
                    let twelfthConcession = calculateConcession(twelfthPercentage, fee.fee);

                    // Use the mean of the concessions if both 10th and 12th percentages have different slabs
                    let concession = (tenthConcession + twelfthConcession) / 2;
                    cell4.textContent = concession;
                    let con_per = (concession * 100) / fee.fee;
                    
                    // cell4.textContent = con_per;
                    document.getElementById('concession-heading').textContent = `Concession (${con_per}%)`;








                    // Calculate total (fee - concession)
                    let total = fee.fee - concession;
                    cell5.textContent = total;

                    totalFees += total;
                });

                // Set total fees in the total fees input field
                totalFeesInput.value = totalFees;
            })
            .catch(error => console.error('Error:', error));
    }


    // Function to calculate concession based on percentage and fee
    function calculateConcession(percentage, fee) {
        let concession = 0;
        if (percentage > 90) {
            concession = fee * 50 / 100;
        } else if (percentage > 80 && percentage < 90) {
            concession = fee * 35 / 100;
        } else if (percentage > 70 && percentage < 80) {
            concession = fee * 20 / 100;
        } else if (percentage > 60 && percentage < 80) {
            concession = fee * 5 / 100;
        }
        return concession;
    }
});


document.getElementById('admission-form').addEventListener('submit', function (event) {
    let emailInput = document.getElementById('email');
    let emailError = document.getElementById('email-error');

    if (!emailInput.validity.valid) {
        emailError.textContent = 'Invalid email address.';
        event.preventDefault();
    } else {
        emailError.textContent = '';
    }
    let mobileInput = document.getElementById('mobile');
    mobileInput.addEventListener('input', function () {
        if (!/^\d{10}$/.test(mobileInput.value)) {
            mobileInput.setCustomValidity('Invalid mobile number (10 digits required).');
        } else {
            mobileInput.setCustomValidity('');
        }
    });

});


document.getElementById('dob').addEventListener('input', function () {
    let dob = new Date(this.value);
    let today = new Date();

    let years = today.getFullYear() - dob.getFullYear();
    let months = today.getMonth() - dob.getMonth();
    let days = today.getDate() - dob.getDate();

    if (days < 0) {
        months--;
        days += 30; 
    }
    if (months < 0) {
        years--;
        months += 12;
    }

    let ageText = `${years} Y ${months} M ${days} D`;
    document.getElementById('age').textContent = ageText;
});
