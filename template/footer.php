 <!-- jQuery -->
 <script src="./asset/admin-template/assets/js/jquery-3.5.1.min.js"></script>

 <!-- Bootstrap Core JS -->
 <script src="./asset/admin-template/assets/js/popper.min.js"></script>
 <script src="./asset/admin-template/assets/js/bootstrap.min.js"></script>

 <!-- Slimscroll JS -->
 <script src="./asset/admin-template/assets/js/jquery.slimscroll.min.js"></script>

 <!-- Chart JS -->
 <script src="./asset/admin-template/assets/plugins/morris/morris.min.js"></script>
 <script src="./asset/admin-template/assets/plugins/raphael/raphael.min.js"></script>
 <script src="./asset/admin-template/assets/js/chart.js"></script>

 <!-- Custom JS -->
 <script src="./asset/admin-template/assets/js/app.js"></script>
 <script>
function previewImage() {
    var preview = document.getElementById('imagePreview');
    var fileInput = document.getElementById('fotoInput');
    var file = fileInput.files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
        preview.src = reader.result;
    }
    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}
 </script>
 </body>

 </html>