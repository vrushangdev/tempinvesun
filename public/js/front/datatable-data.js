
    $(document).ready(function () {
        $('#example').DataTable({
            //DataTable Options
        });
        $('#example-height').DataTable({
            scrollY:        '50vh',
            scrollCollapse: true,
            paging:         false
        });
        $('#example-multi').DataTable({
            //DataTable Options
        });
        $('#example-multijob').DataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: 'th:not(:last-child)',
                        trim: true,
                    },
                },

                // {
                //     extend:  'pdf',
                //     className: 'btn btn-primary',
                //     exportOptions: {
                //         columns: 'th:not(:last-child)',
                //         trim: true,
                //     }
                // },
                
            ]
        });
        $('#example-multi tbody').on( 'click', 'tr', function () {
            //$(this).toggleClass('bg-gray-400');
        });
        $('#example-multi-export').DataTable({
            paging:  false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: 'th:not(:last-child)',
                        trim: true,
                    },
                },

                // {
                //     extend:  'pdf',
                //     className: 'btn btn-primary',
                //     exportOptions: {
                //         columns: 'th:not(:last-child)',
                //         trim: true,
                //     }
                // },
                
            ]
        });
    });



