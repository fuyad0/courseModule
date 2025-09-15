const fileInput = document.getElementById("course_feature_image");
const preview = document.getElementById("feature_image_preview");

fileInput.addEventListener("change", () => {
  const file = fileInput.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.classList.remove("d-none");
    }
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
    preview.classList.add("d-none"); 
  }
});

function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
