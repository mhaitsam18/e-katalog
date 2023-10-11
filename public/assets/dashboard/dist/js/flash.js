// sweet alert2
const flashData = $(".flash-data").data("flashdata");

if (flashData) {
  Swal.fire({
    title: "Sukses",
    text: "Data Berhasil " + flashData,
    type: "success",
  });
}

// Sweet Alert
const flashGagal = $(".flash-data-gagal").data("flashdata");

if (flashGagal) {
  Swal.fire({
    title: "Gagal",
    text: "Data Gagal " + flashGagal,
    type: "error",
  });
}
