<!-- jQuery -->
<script src="../../asset/admin-template/assets/js/jquery-3.5.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="../../asset/admin-template/assets/js/popper.min.js"></script>
<script src="../../asset/admin-template/assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="../../asset/admin-template/assets/js/jquery.slimscroll.min.js"></script>

<!-- Datatables JS -->
<script src="../../asset/admin-template/assets/js/jquery.dataTables.min.js"></script>
<script src="../../asset/admin-template/assets/js/dataTables.bootstrap4.min.js"></script>
<!-- Custom JS -->
<script src="../../asset/admin-template/assets/js/app.js"></script>

<script src="../../asset/admin-template/assets/js/dataTables-demo.js"></script>
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
<script>
function confirmDelete() {
    return confirm("Apakah Anda yakin ingin menghapus user ini?");
}

$(document).ready(function() {
    $('#username').on('input', function() {
        var inputValue = $(this).val();
        var pattern = /^[A-Za-z0-9]+$/;
        if (!pattern.test(inputValue)) {
            $('#validationMessage').text(
                'Hanya diperbolehkan huruf dan angka, tanpa spasi dan simbol.');
        } else {
            $('#validationMessage').text('');
        }
    });
});
</script>
</body>

</html>