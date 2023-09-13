$(function () {

    $(document).ready(function () {
        $('#example1').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [


                {
                    extend: 'excel',
                    text: 'Excel',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Pdf',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }


            ]
        });
    });

    $(document).ready(function () {
        $('#tabungan_table').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [


                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }


            ]
        });
    });
});