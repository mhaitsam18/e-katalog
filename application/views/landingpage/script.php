<script src="<?=base_url()?>assets/landingpage/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
  integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="<?=base_url()?>assets/landingpage/js/vendor/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/landingpage/js/jquery.sticky.js"></script>
<script src="<?=base_url()?>assets/landingpage/js/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url()?>assets/landingpage/js/owl.carousel.min.js"></script>
<script src="<?=base_url()?>assets/landingpage/js/main_edited.js"></script>

<script src="<?=base_url()?>assets/landingpage/js/dynamic-link.js"></script>

<!-- Acordion -->
<script>
var acc = document.getElementsByClassName("klik");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    // this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>