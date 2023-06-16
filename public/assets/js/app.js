
const image = document.getElementById("image");
const imagePrev = document.getElementById("image_prev");
const imageERR = document.getElementById("image_err");
const mimes = ['image/png', 'image/jpeg', 'image/jpg'];
// Image Preview
image.addEventListener('change', function(event) {
    const files = image.files;

    if (files.length > 0) {
        let img = files[0];

        if (! mimes.includes(img.type) || img.size > 16384) {
            imageERR.innerHTML = "ERROR: INVALID IMAGE";
            console.log("HERE");
            return;
        }
        imagePrev.src = URL.createObjectURL(img);
    }
});