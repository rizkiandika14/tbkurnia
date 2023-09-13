$(function () {

    $(document).ready(function () {
        $('#tabungan').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [


                {
                    extend: 'excel',
                    text: 'Excel',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Pdf',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }


            ]
        });
    });
});