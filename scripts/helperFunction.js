const isDarkMode = () => {
    return document.documentElement.classList.contains("darkMode");
}

// return the current html/PHP file
const getCurrentDisplay = () => {
    return location.href.split("/").slice(-1)[0].split("?")[0];
}

function formatDate(dateString) {
    const date = new Date(dateString);
    // 月-日-年(最后两位)
    return `${String(date.getMonth() + 1).padStart(2, "0")}-${String(
        date.getDate()
    ).padStart(2, "0")}-${String(date.getFullYear()).slice(-2)}`;
}

// setup logic for new application
const setApplicationFormData = () => {
    // validating cohort data
    const cohortInput = document.getElementById("cohort");

    cohortInput.addEventListener("input", function () {
        if (cohortInput.value < 1 || cohortInput.value > 100) {
            cohortInput.setCustomValidity("Please enter a cohort number between 1 and 100.");
        } else {
            cohortInput.setCustomValidity("");
        }
    })

    // setting date data
    const twoWeeksFromNow = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 14);
    const today = new Date();

    document.getElementById('dateOfApplication').value = today.toISOString().split('T')[0];
    document.getElementById('followUpDate').value = twoWeeksFromNow.toISOString().split('T')[0];

    // validating URL data
    var inputUrl = this.value.trim();
    var urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;

    if (urlRegex.test(inputUrl)) {
        this.setCustomValidity('');
        document.getElementById("urlHelp").style.display = 'none';
    } else {
        this.setCustomValidity('Invalid URL. Please enter a valid URL.');
        document.getElementById("urlHelp").style.display = 'block';
    }
}

// setup logic for new user and validation
function checkAndSubmit() {
    // Checkboxes validation
    var checkBoxes = document.getElementsByName("checkboxes[]");
    var atLeastOneChecked = false;
    for (var i = 0; i < checkBoxes.length; i++) {
        if (checkBoxes[i].checked) {
            atLeastOneChecked = true;
            break;
        }
    }
    var messageElement = document.getElementById("checkboxMessage");
    if (!atLeastOneChecked) {
        messageElement.style.display = "block"; // Show the message
        return false; // Prevent form submission
    }
    messageElement.style.display = "none"; // Hide the message

    // Password validation
    var password = document.getElementById('password').value;
    var errorMessage = '';
    if (password.length < 9) {
        errorMessage += 'Password must be at least 9 characters long.\n';
    }
    if (!/[A-Z]/.test(password)) {
        errorMessage += 'Password must contain at least one uppercase letter.\n';
    }
    if (!/[^A-Za-z0-9]/.test(password)) {
        errorMessage += 'Password must contain at least one special character.\n';
    }
    if (errorMessage) {
        alert(errorMessage);
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}

function createNoteModal(appId, notes) {
    return `<div class="modal fade" id="${appId}-notes" aria-labelledby="${appId}-label" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="${appId}-label">Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>${notes}</p>
                  </div>
                </div>
              </div>
            </div>
        `
}

function changeDisplay(id, next) {
    document.getElementById(id).classList.toggle("active")
    document.getElementById(next).classList.toggle("active")
}

const currPage = getCurrentDisplay();

if (currPage === "NewApplicationForm.html") {
    document.addEventListener('DOMContentLoaded', () => setApplicationFormData);
} else if (currPage === "SignUp_Form.html") {
    document.addEventListener('DOMContentLoaded', () => checkAndSubmit());
}
