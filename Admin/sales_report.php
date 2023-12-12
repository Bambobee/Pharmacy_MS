<?php include('./partials/menu.php'); ?>
<div class="contain">
    <h1 class="title">Sale's Report</h1>
    <div class="hr"></div>
    <br>
    <!--- HTML for the table starts here-->
    <div class="recent-orders">
        <h5>Online Sale's report Monthly</h5>
        <div class="container-fluid">
            <table id="example1" class="display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Total Customers</th>
                        <th>Total Money</th>
                        <th>Month</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="recent-orders">
        <h5>Physical Sale's report Monthly</h5>
        <div class="container-fluid">
            <table id="example" class="display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Total Invoices</th>
                        <th>Total Money</th>
                        <th>Month</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


</div>
</main>
<!-- MAIN -->
</section>
<!-- section for navigation bar ends here -->

<!--Html for the footer-->
<footer class="footer">
    <!-- <div class="hr"></div> -->
    <div class="last">
        <p>&copy;copyright all rights reserved by Ssewankambo Derick</p>
    </div>
</footer>

<script src="./jquery/jquery-3.6.1.min.js"></script>
<script src="./jquery/jquery.validate.min.js"></script>
<script src="./assets/datatables.min.js"></script>
<script src="./assets/pdfmake.min.js"></script>
<script src="./assets/vfs_fonts.js"></script>
<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/dataTables.responsive.min.js"></script>
<script src="./assets/sweetalert2@11.js"></script>
<script src="./assets/java.js"></script>
<script src="./assets/index.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function() {
    var dataTable = $('#example1').DataTable({
        dom: 'Blfrtip',
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "manage_sales/fetch.php",
            type: "POST",
            data: function(d) {
                d.draw = d.start / d.length +
                1; // Update 'draw' parameter value based on pagination
            }
        },
        columns: [{
                data: "0"
            },
            {
                data: "1"
            },
            {
                data: "2"
            },
            {
                data: "3"
            }
        ],
        columnDefs: [{
            targets: [0, 3],
            orderable: false
        }],
        buttons: [{
                extend: 'excel',
                text: 'Excel <i class="bx bx-export"></i>',
                titleAttr: 'Export to Excel',
                className: 'btn btn-sm m-1 mt-3 btn-Success'
            },
            {
                extend: 'pdf',
                text: 'PDF <i class="bx bx-export"></i>',
                titleAttr: 'Export to PDF',
                className: 'btn btn-sm m-1 mt-3 btn-warning'
            },
            {
                extend: 'copy',
                text: 'Copy <i class="bx bx-copy-alt"></i>',
                titleAttr: 'Copy',
                className: 'btn btn-sm m-1 mt-3 btn-primary'
            },
            {
                extend: 'print',
                text: 'Print <i class="bx bx-printer"></i>',
                titleAttr: 'Print',
                className: 'btn btn-sm m-1 mt-3 btn-danger'
            }
        ],
    });
});
</script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
    var dataTable = $('#example').DataTable({
        dom: 'Blfrtip',
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "2/fetch.php",
            type: "POST",
            data: function(d) {
                d.draw = d.start / d.length +
                    1; // Update 'draw' parameter value based on pagination
            }
        },
        columns: [{
                data: "0"
            },
            {
                data: "1"
            },
            {
                data: "2"
            },
            {
                data: "3"
            }
        ],
        columnDefs: [{
            targets: [0, 3],
            orderable: false
        }],
        buttons: [{
                extend: 'excel',
                text: 'Excel <i class="bx bx-export"></i>',
                titleAttr: 'Export to Excel',
                className: 'btn btn-sm m-1 mt-3 btn-Success'
            },
            {
                extend: 'pdf',
                text: 'PDF <i class="bx bx-export"></i>',
                titleAttr: 'Export to PDF',
                className: 'btn btn-sm m-1 mt-3 btn-warning'
            },
            {
                extend: 'copy',
                text: 'Copy <i class="bx bx-copy-alt"></i>',
                titleAttr: 'Copy',
                className: 'btn btn-sm m-1 mt-3 btn-primary'
            },
            {
                extend: 'print',
                text: 'Print <i class="bx bx-printer"></i>',
                titleAttr: 'Print',
                className: 'btn btn-sm m-1 mt-3 btn-danger'
            }
        ],
    });
});
</script>
</body>

</html>