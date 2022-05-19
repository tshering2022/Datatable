<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/plug-ins/1.12.0/features/mark.js/datatables.mark.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.4/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.4/vfs_fonts.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>

<script>
    /* -------------------------------------------------------------------------------------- */
    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
        className: 'btn btn-sm'
    })
    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.container, {
        className: 'dt-buttons'
    })

    $.extend(true, $.fn.dataTable.defaults, {
        dom: "<'row mb-1'<'col-sm-12 col-md-8'i><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-9'p>>" +
            "<'row'<'col-sm-12'tr>>",
        processing: true,
        deferRender: true,
        stateSave: true,
        stateDuration: -1,
        responsive: true,
        language: {
            url: "{{ asset('json/datatables/i18n/en_gb.json') }}"
        },
        lengthMenu: [
            [20, 25, 50, 75, 100, -1],
            [20, 25, 50, 75, 100, "All"]
        ],
        pageLength: 20,
        pagingType: 'full_numbers',
        mark: {
            element: 'span',
            className: 'bg-info'
        },
        select: true,
        order: [],
        buttons: [{
                className: 'btn-info',
                text: '<i class="bi bi-question"></i>',
                titleAttr: 'Help',
                action: function(e, dt, node, config) {
                    $.ajax({
                        method: 'GET',
                        url: "{{ route('backend.general.getDatatablesHelp') }}",
                        success: function(response) {
                            bootbox.dialog({
                                title: "Help",
                                message: response,
                                size: 'xl',
                                onEscape: true,
                                backdrop: true,
                            });
                        }
                    });
                }
            },
            {
                extend: 'colvis',
                className: 'btn-outline-dark',
                text: '<i class="bi bi-columns"></i>',
                titleAttr: 'Column visibility',
                postfixButtons: [{
                    extend: 'colvisRestore',
                    text: 'Show all',
                    className: 'bg-info',
                }],
            },
            {
                extend: 'copyHtml5',
                className: 'btn-outline-dark',
                text: '<i class="bi bi-clipboard"></i>',
                titleAttr: 'Copy to clipboard',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn-secondary',
                text: '<i class="bi bi-file-earmark-pdf"></i>',
                titleAttr: 'Export to PDF',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                },
                download: 'open',
                orientation: 'landscape',
                customize: function(doc) {
                    doc.pageMargins = [10, 15, 10, 15];
                    doc.defaultStyle.fontSize = 9;
                },
            },
            {
                extend: 'excelHtml5',
                className: 'btn-secondary',
                text: '<i class="bi bi-file-earmark-excel"></i>',
                titleAttr: 'Export to spreadsheet',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                },
                autoFilter: true,
            },
            {
                extend: 'print',
                className: 'btn-secondary',
                text: '<i class="bi bi-printer"></i>',
                titleAttr: 'Print',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                },
                //autoPrint: false,
                customize: function(win) {
                    $(win.document.body).css('padding-top', '0.5rem');
                    $(win.document.body).find('h1').css('font-size', '12px');
                    $(win.document.body).find('table')
                        .addClass('display')
                        .addClass('compact')
                        .css('font-size', '10px');
                },
            },
            {
                extend: 'selectNone',
                className: 'btn-info',
                text: '<i class="bi bi-x"></i>',
                titleAttr: 'Deselect all',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'selectAll',
                className: 'btn-info',
                text: '<i class="bi bi-check"></i>',
                titleAttr: 'Select all',
                exportOptions: {
                    columns: ':visible'
                },
                action: function(e, dt, node, config) {
                    dt.rows({
                        search: 'applied',
                        page: 'current'
                    }).select()
                }
            },
        ]
    });
    /* -------------------------------------------------------------------------------------- */
    let dtButtonsLeft = $.extend(true, [], $.fn.dataTable.defaults.buttons);
    let dtButtonsCenter = [];
    let dtButtonsRight = [];
    /* -------------------------------------------------------------------------------------- */
</script>
