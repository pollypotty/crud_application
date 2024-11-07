let storedFileName = '';

function toggleLogo() {
    const checkbox = document.getElementById('no_logo');
    const logoPreviews = document.querySelectorAll('.logoPreview');
    const logoInput = document.getElementById('logo_image');
    const fileNameSpans = document.querySelectorAll('.fileName');

    if (checkbox.checked) {
        // hide all logo previews and clear the file input
        logoPreviews.forEach(logoPreview => {
            logoPreview.style.display = 'none';
        });

        // reset the file input
        logoInput.value = '';
        fileNameSpans.forEach(fileNameSpan => {
            fileNameSpan.textContent = ''; // Clear file name
        });
    } else {
        // show the logo previews if they exist
        logoPreviews.forEach(logoPreview => {
            if (logoPreview.src) {
                logoPreview.style.display = 'block';
            }
        });
    }
}

function previewImage() {
    const logoInput = document.getElementById('logo_image');
    const logoPreviews = document.querySelectorAll('.logoPreview');
    const fileNameSpans = document.querySelectorAll('.fileName');
    const checkbox = document.getElementById('no_logo');

    // uncheck the checkbox when a file is selected
    if (logoInput.files.length > 0) {
        checkbox.checked = false;
    }

    const file = logoInput.files[0];

    // if file exists set logo preview src and show logo
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            logoPreviews.forEach(logoPreview => {
                logoPreview.src = e.target.result;
                logoPreview.style.display = 'block';
            });

            // display the file name
            fileNameSpans.forEach(fileNameSpan => {
                fileNameSpan.textContent = file.name; // Show file name
            });
        }
        reader.readAsDataURL(file);
    }
}

// assign the functions to the global scope
window.toggleLogo = toggleLogo;
window.previewImage = previewImage;

