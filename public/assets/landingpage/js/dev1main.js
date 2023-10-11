function previewGmb() {
	const sampul = document.querySelector("#gambar");
	const sampulLabel = document.querySelector(".custom-file-input");
	const imgPreview = document.querySelector(".img-preview");

	sampulLabel.textContent = sampul.files[0].name;
	// console.log(sampulLabel.textContent);
	const fileSampul = new FileReader();
	fileSampul.readAsDataURL(sampul.files[0]);

	fileSampul.onload = function (e) {
		imgPreview.src = e.target.result;
	};
}

function namaFile() {
	const sampul = document.querySelector("#unduhan");
	const sampulLabel = document.querySelector(".custom-file-input");
	sampulLabel.textContent = sampul.files[0].name;
	console.log(sampulLabel.textContent);
}
