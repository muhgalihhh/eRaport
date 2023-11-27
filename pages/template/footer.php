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
$(document).ready(function() {
    // Function to perform search
    function performSearch() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".datatable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            // Skip header and footer rows
            if (
                tr[i].getElementsByTagName("th").length > 0 ||
                tr[i].parentElement.tagName === "tfoot"
            ) {
                continue;
            }

            // Initialize flag to check if any column contains the search text
            var found = false;

            // Iterate over all columns for each row
            for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;

                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break; // Exit the loop if a match is found in any column
                    }
                }
            }

            // Display or hide the row based on the search result
            tr[i].style.display = found ? "" : "none";
        }
    }

    // Trigger search on keyup event
    $("#searchInput").on("keyup", function() {
        performSearch();
    });
});
</script>
<!-- Slider -->
<script>
// Mendapatkan elemen slider
var sliders = document.querySelectorAll("[id^='slider_']");

// Mendapatkan elemen untuk menampilkan nilai slider
var sliderValues = document.querySelectorAll("[id^='sliderValue_']");

// Menetapkan fungsi yang akan dijalankan ketika nilai slider berubah
sliders.forEach(function(slider, index) {
    slider.oninput = function() {
        // Menampilkan nilai slider pada elemen
        sliderValues[index].innerHTML = "Nilai: " + this.value;
    };
});
</script>
</body>

</html>