function namaFile() {
  const sampul = document.querySelector("#unduhan");
  const sampulLabel = document.querySelector(".custom-file-input");
  sampulLabel.textContent = sampul.files[0].name;
  // console.log(sampulLabel.textContent)
}

$(".custom-file-input").on("change", function() {
  let fileName = $(this).val().split("\\").pop();
  $(this).next(".custom-file-label").addClass("selected").html(fileName);
});
