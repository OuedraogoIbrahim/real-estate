function previewImage(event) {
    const fileInput = event.target;
    const imagePreview = document.getElementById('imagePreview');
    const preview = document.getElementById('preview');

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);

        imagePreview.style.display = 'block';
    } else {
        imagePreview.style.display = 'none';
    }
}
