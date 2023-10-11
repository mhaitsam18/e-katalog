function previewGmb() {
  const sampul = document.querySelector("#gambar");
  const sampulLabel = document.querySelector(".custom-file-input");
  const label = document.querySelector(".custom-file-label");
  const imgPreview = document.querySelector(".img-preview");

  // label.classList.add("selected");

  sampulLabel.textContent = sampul.files[0].name;
  const fileSampul = new FileReader();
  fileSampul.readAsDataURL(sampul.files[0]);

  fileSampul.onload = function(e) {
    imgPreview.src = e.target.result;
  };

}
