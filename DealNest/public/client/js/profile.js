document.addEventListener('DOMContentLoaded', (event) => {
    const avatarBtn = document.getElementById('avatarBtn');
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const fileName = document.getElementById('fileName');

    // Open file input when button is clicked
    avatarBtn.addEventListener('click', () => {
        avatarInput.click();
    });

    // Handle file selection and preview
    avatarInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            
            // Display the file name
            fileName.textContent = file.name;

            reader.onload = (e) => {
                avatarPreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
});
