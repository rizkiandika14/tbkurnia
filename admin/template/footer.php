</div> <!-- end container -->

<footer class="text-center mb-0 py-3">
    <p class="text-muted small mb-0">Copyright &copy;
        <b>FAHES</b></a>. All Rights Reserved
    </p>
</footer>

<script src="assets/js/jquery.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/jquery-3.5.1.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/pdfmake.min.js"></script>
<script src="assets/js/jszip.min.js"></script>
<script src="assets/js/vfs_fonts.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/table_script.js"></script>
<script src="assets/js/produk_script.js"></script>
<script src="assets/js/alert.js"></script>
<!-- <script src="assets/js/tabungan_script.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {
    $("#bulan").on('change', function() {
        var value = $(this).val();

        $.ajax({
            url: "fetch_atas.php",
            type: "POST",
            data: 'request=' + value,
            success: function(data) {
                $(".laporan-atas").html(data);
            }
        });
    });
});

$(document).ready(function() {
    $("#bulan").on('change', function() {
        var value = $(this).val();

        $.ajax({
            url: "fetch.php",
            type: "POST",
            data: 'request=' + value,
            success: function(data) {
                $(".laporan-wrapper").html(data);
            }
        });
    });
});
$(document).ready(function() {
    $("#bulan_tabungan").on('change', function() {
        var value = $(this).val();

        $.ajax({
            url: "tabungan_fetch.php",
            type: "POST",
            data: 'request=' + value,
            success: function(data) {
                $(".tabungan-wrapper").html(data);
            }
        });
    });
});
$(document).ready(function() {
    $("#bulan_produk").on('change', function() {
        var value = $(this).val();

        $.ajax({
            url: "produk_fetch.php",
            type: "POST",
            data: 'request=' + value,
            success: function(data) {
                $(".produk-wrapper").html(data);
            }
        });
    });
});
$(document).ready(function() {
    $("#bulan_produk").on('change', function() {
        var value = $(this).val();

        $.ajax({
            url: "produk_atas.php",
            type: "POST",
            data: 'request=' + value,
            success: function(data) {
                $(".produk-atas").html(data);
            }
        });
    });
});
$(document).ready(function() {
    $("#bulan_stok").on('change', function() {
        var value = $(this).val();

        $.ajax({
            url: "stok_fetch.php",
            type: "POST",
            data: 'request=' + value,
            success: function(data) {
                $(".stok-wrapper").html(data);
            }
        });
    });
});
$(document).ready(function() {
    $("#bulan_stok").on('change', function() {
        var value = $(this).val();

        $.ajax({
            url: "stok_atas.php",
            type: "POST",
            data: 'request=' + value,
            success: function(data) {
                $(".stok-atas").html(data);
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#table').DataTable();
});
$('#cart').dataTable({
    searching: false,
    paging: false,
    info: false
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#laporan_table').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [


            {
                extend: 'excel',
                text: 'Excel',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'pdf',
                text: 'Pdf',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            }


        ]
    });
});
</script>



</body>

</html>