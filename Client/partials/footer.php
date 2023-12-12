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
    <script src="./assets/java.js"></script>
    <script src="./assets/index.js"></script>

    
    <script>
        $(document).ready(function(){
            var data = $('#example').DataTable(
        {
            responsive: "true",
            buttons: [
              
            {
            extend: 'excel',
            text: 'Excel <i class="bx bx-export"></i>',
            titleAttr: 'Export to PDF',
            className: 'btn btn-sm m-1 mt-3 btn-Success'
            },
            {
            extend: 'pdf',
            text: 'Pdf <i class="bx bx-export"></i>',
            titleAttr: 'Export to PDF',
            className: 'btn btn-sm m-1 mt-3 btn-warning'
            },
            {
            extend: 'copy',
            text: 'Copy <i class="bx bx-copy-alt"></i>',
            titleAttr: 'copy',
            className: 'btn btn-sm m-1 mt-3 btn-primary'
            },
            {
            extend: 'print',
            text: 'Print <i class="bx bx-printer"></i>',
            titleAttr: 'Print',
            className: 'btn btn-sm m-1 mt-3 btn-danger'
            }
        ]
        })
        data.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
    });
   
    </script>
</body>
</html>