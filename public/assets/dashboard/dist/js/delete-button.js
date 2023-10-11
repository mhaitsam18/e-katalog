$(document).ready(function () {
  $(".tombol-hapus").on("click", function (e) {
    e.preventDefault();
    const form_hapus = $("#form-hapus")[0];

    Swal.fire({
      title: "Apakah anda yakin?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#e74c3c",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Tidak"
    }).then((result) => {
      if (result.value) {
        form_hapus.requestSubmit($(this)[0]);
      }
    });
  });
});
