<?php include('./partials/menu.php'); ?>
            <div class="contain">
                <h1 class="title">Purchase</h1>
                <button type="button" id="add_button" class="btn btn-sm btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Purchase
                 </button>
                 <div  id="finish">

                 </div>
                <div class="hr"></div>
                <!--- HTML for the table starts here-->
                <div class="recent-orders">
                    <div class="container-fluid">
                        <table id="example" class="display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                   <th>Supplier Name</th>
                                   <th>Medicine Name</th>
                                   <th>Price</th>
                                   <th>Qty</th>
                                   <th>Total Amount</th>
                                   <th>Paking</th>
                                   <th>Voucher Number</th>
                                   <th>Date</th>
                                   <th>Payment Method</th>
                                   <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                   <div class="modal-content">
                     <div class="modal-body">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="card-list" style="height: 500px;">
                            <div class="inner-box" id="card">
                                <div class="card-font">
                                <form method="post" id="customer_form" enctype="multiple/form-data">
                                    <h2 class="modal-title" id="modalTitleId">Add Purchase</h2>
                                    <p class="success" style="font-size: 17px; text-align: center;" id="order">
                                
                                      </p>
                                            <label class="label">Choose the Supplier's Names</label>
                                            <select name="name"  id="name" class="input-box" >
                                        <option selected disabled>-Select from the options-</option>
                                            <?php 
                                            $sql = "SELECT * FROM tbl_supplier";
                                            $res = mysqli_query($conn, $sql);
                                            $count = mysqli_num_rows($res);
                                            if($count>0){
                                                while($row=mysqli_fetch_assoc($res)){
                                                    $name = $row['name'];
                                                    ?>
                                                    <option  value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                    <?php
                                                }
                                            } 
                                            else{
                                                ?>
                                                <option value="0">No Supplier found</option>
                                                <?php
                                            } 
                                            ?>
                                        </select>

                                            <label class="label">Enter the Medicine Name</label>
                                            <input type="text" name="medicine" id="medicine" class="input-box" 
                                            placeholder="Medicine..."><br>

                                            <label class="label">Enter the medicine price</label>
                                            <input type="text" name="price" id="price" class="input-box" 
                                            placeholder="Price..."><br>

                                            <label class="label">Enter the Quantity</label>
                                            <input type="number" name="qty" id="qty" class="input-box" 
                                            placeholder="Quantity..." ><br>

                                            <label class="label">Enter the Paking</label>
                                            <input type="text" name="paking" id="paking" class="input-box" 
                                            placeholder="Paking..." ><br>

                                            <label class="label">Enter the Voucher Number</label>
                                            <input type="text" name="voucher" id="voucher" class="input-box" 
                                            placeholder="voucher Number..." ><br>

                                            <label class="label">Select the Payment method</label>
                                            <select name="payment" id="payment" class="input-box" >
                                            <option selected disabled>-Select from the options-</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Net_banking">NetBanking</option>
                                            <option value="Credit_Card">Credit Card</option>
                                            </select><br>
                                            

                                           <div class="submit-btn mt-1">
                                            <input type="hidden" name="user_id" id="user_id" />
                                            <input type="hidden" name="operation" id="operation" />
                                            <input type="submit" name="action" id="action" style="background: none; color: #fff;" value="Add" />
                                        </div>
                                        </form>
                            </div>
                         </div>
                       </div>
                     </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" 
integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script type="text/javascript" language="javascript">
    $(document).ready(function() {
            $('#add_button').click(function() {
                $('#customer_form')[0].reset();
                $('.modal-title').text("Add Purchase");
                $('#action').val("Add");
                $('#operation').val("Add");
            });
            var dataTable = $('#example').DataTable({
                dom: 'Blfrtip',
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "manage_purchase/fetch.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 4],
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


            $(document).on('submit', '#customer_form', function(event) {
                event.preventDefault();
                var name = $('#name').val();
                var voucher = $('#voucher').val();
                var medicine = $('#medicine').val();
                var price = $('#price').val();
                var qty = $('#qty').val();
                var paking = $('#paking').val();
                var payment = $('#payment').val();


                $.ajax({
                    url: "manage_purchase/insert.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // alert(data);
                        $("#order").html(data); 
                        $('#customer_form')[0].reset();
                        // $('#exampleModal').modal('hide');
                        dataTable.ajax.reload();
                    }
                });

            });

            $(document).on('click', '.update', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "manage_purchase/fetch_single.php",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#exampleModal').modal('show');
                        $('#name').val(data.name);
                        $('#voucher').val(data.voucher);
                        $('#medicine').val(data.medicine);
                        $('#price').val(data.price);
                        $('#qty').val(data.qty);
                        $('#paking').val(data.paking);
                        $('#payment').val(data.payment);
                        $('.modal-title').text("Edit Purchase");
                        $('#user_id').val(user_id);
                        $('#action').val("Edit");
                        $('#operation').val("Edit");
                    }
                })
            });
            $(document).on('click', '.delete', function(e) {
                var user_id = $(this).attr("id");
                e.preventDefault();
                                const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-sm m-3 btn-success',
                                    cancelButton: 'btn btn-sm btn-danger'
                                },
                                buttonsStyling: false
                                });

                                swalWithBootstrapButtons.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel!',
                                reverseButtons: true
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                              url: "manage_purchase/delete.php",
                             method: "POST",
                             data: {
                            user_id: user_id
                              },
                        success: function(data) {
                            $("#finish").html(data); 
                            swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success'
                                    )
                            dataTable.ajax.reload();
                        }
                         });
                                } else if (
                                    /* Read more about handling dismissals below */
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {
                                    swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    'Your data is safe.',
                                    'error'
                                    )
                                }
                                });

            });                      
                    
         });
                          
                    
         
        $(document).ready(() => {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var check = false;
                    return this.optional(element) || regexp.test(value);
                }
            );

            $.validator.addMethod("extension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
                return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            });

            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0} bytes');

            $("#customer_form").validate({
                rules: {
                    'name': {
                        required: true,
                        minlength: 3,
                        maxlength: 40,
                    },
                    'voucher': {
                        required: true,
                    },
                    'medicine': {
                        required: true,
                    },
                    'price': {
                        required: true,
                    },
                    'paking': {
                        required: true,
                    },
                    'qty': {
                        required: true,
                    }, 
                    'payment': {
                        required: true,
                    }
                },
                messages: {
                    'name': {
                        required: "Please enter full Names.",
                        minlength: "A minimum of 3 characters is required",
                        maxlength: "Field accepts maximum of 15 characters",
                    },
                    'voucher': {
                        required: "Please enter the voucher number.",
                    },
                    'medicine': {
                        required: "Please enter the Medicine name.",
                    },
                    'price': {
                        required: "Please enter the Medicine price.",
                    },
                    'qty': {
                        required: "Please enter the Quantity.",
                    },
                    'paking': {
                        required: "Please enter the Medicine paking.",
                    },
                    'paymnet': {
                        required: "Please enter the Payment method.",
                    }
                },
            });
        })
    </script>
<Script>
    $("#name").chosen();
</Script>
</body>
</html>
      