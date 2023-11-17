$(document).ready(function () {
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
  $("#searchInput").on("keyup", function () {
    performSearch();
  });
});
