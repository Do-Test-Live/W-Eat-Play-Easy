<script src="vendor/jQuery/jquery-3.6.4.min.js"></script>
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendor/chart.js/Chart.bundle.min.js"></script>
<script src="vendor/toastr/js/toastr.min.js"></script>
<script src="vendor/toastr/js/toastr.init.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>
<!-- Datatable -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script>
<script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="js/plugins-init/sweetalert.init.js"></script>
<script>
    (function ($) {
        var table = $('#example5').DataTable({
            searching: false,
            paging: true,
            select: false,
            //info: false,
            lengthChange: false

        });
        $('#example tbody').on('click', 'tr', function () {
            var data = table.row(this).data();

        });
    })(jQuery);
</script>