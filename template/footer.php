</div> <!-- end container -->

<footer class="text-center mb-0 py-3">
    <p class="text-muted small mb-0">Copyright &copy; <?php echo  date("Y"); ?> <a href="#"
            style="text-decoration:none;">
            <b>FAHES</b></a>. All Rights Reserved</p>
</footer>

<!--
<footer class="text-center mb-0 py-3">
    <p class="text-muted small mb-0">Copyright &copy; <?php echo  date("Y"); ?> <a href="https://www.youtube.com/channel/UCyHwOyTkQBgwfWMOrblSUDg" style="text-decoration:none;">
    <b>ADGRAFIKA</b></a>. All Rights Reserved</p>
</footer>
 -->
<script src="assets/jquery/jquery.min.js"></script>
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

</body>

</html>