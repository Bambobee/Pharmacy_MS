<?php include('./partials/menu.php'); ?>
         <div class="contain">
                <h1 class="title">Customers</h1>
                 <div class="hr"></div>
                 <div class="recent-orders">
                <div class="container-fluid">
                    <table id="example" class="display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>S.N</th>
                               <th>Image</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Contact</th>
                               <th>Address</th>
                               <th>date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
             </div>
            </div>

                <!-- Modal -->
               
            
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
            $('#add_button').click(function() {
                $('#customer_form')[0].reset();
                $('.modal-title').text("Add Customer");
                $('#action').val("Add");
                $('#operation').val("Add");
                $('#user_uploaded_image').html('');
            });
            var dataTable = $('#example').DataTable({
                dom: 'Blfrtip',
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "manage_customer/fetch.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 6],
                    "orderable": false,
                }, ],

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
          ],


            });


        });
    </script>

</body>
</html>
      