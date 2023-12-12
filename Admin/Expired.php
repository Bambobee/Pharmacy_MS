<?php include('./partials/menu.php'); ?>
<div class="contain">
    <h1 class="title">Medicine Stock</h1>
    <!-- <button class="btn btn-primary mb-2">
                Add Stock
            </a> -->
    <div class="straight">
        <button type="button" id="add_button" class="btn btn-sm btn-primary mb-4" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Add Medicine_stock
        </button>
        <div id="finish">

        </div>

    </div>
    <div class="hr"></div>
    <!--- HTML for the table starts here-->
    <div class="recent-orders">
        <div class="container-fluid">
            <table id="example" class="display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Generic Name</th>
                        <th>Packing</th>
                        <th>Batch ID</th>
                        <th>Expiry Date</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>active</th>
                        <th>date and time</th>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="card-list" style="height: 760px;">
                    <div class="inner-box" id="card">
                        <div class="card-font">
                            <form method="post" id="customer_form" enctype="multiple/form-data">
                                <h2 class="modal-title" id="modalTitleId">Add Medicine_stock</h2>
                                <p class="success" style="font-size: 17px; text-align: center;" id="order">

                                </p>
                                <label class="label">Enter the Medicine Names</label>
                                <input type="text" name="name" id="name" class="input-box" placeholder="Name..."><br>

                                <Label class="label">Enter the Medicine Generic Name</Label>
                                <input type="text" name="generic" id="generic" class="input-box"
                                    placeholder="Generic name..."><br>

                                <label class="label">Enter the Medicine Packing</label>
                                <input type="text" name="packing" id="packing" class="input-box"
                                    placeholder="packing e.g 10tabs..."><br>

                                <label class="label">Enter the Batch Id</label>
                                <input type="text" name="batch" id="batch" class="input-box"
                                    placeholder="Batch Id..."><br>

                                <label class="label">Choose or Enter the Expiry date</label>
                                <input type="date" name="expiry" id="expiry" class="input-box"><br>

                                <label class="label">Enter the Supplier's name</label>
                                <input type="text" name="supplier" id="supplier" class="input-box"
                                    placeholder="Supplier's Name..."><br>

                                <label class="label">Enter the Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="input-box"
                                    placeholder="Quantity eg 10boxes..."><br>

                                <label class="label">Enter the Medicine Price</label>
                                <input type="number" name="price" id="price" class="input-box"
                                    placeholder="Medicine price..."><br>

                                <Label class="label">Active</Label>
                                <select class="input-box" id="active" name="active">
                                    <option selected >-Select from the options-</option>
                                    <option style="background: blue;" value="Yes">Yes</option>
                                    <option style="background: blue;" value="No">No</option>
                                </select><br>

                                <label class="label">Enter the date</label>
                                <input type="date" name="date" id="date" class="input-box"><br>

                                <div class="submit-btn mt-1">
                                    <input type="hidden" name="user_id" id="user_id" />
                                    <input type="hidden" name="operation" id="operation" />
                                    <input type="submit" name="action" id="action"
                                        style="background: none; color: #fff;" value="Add" />
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

<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('#add_button').click(function() {
        $('#customer_form')[0].reset();
        $('.modal-title').text("Add medicine_Stock");
        $('#action').val("Add");
        $('#operation').val("Add");
    });
    var dataTable = $('#example').DataTable({
        dom: 'Blfrtip',
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "manage_medicine_stock/fetch_expired.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 5],
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
        var generic = $('#generic').val();
        var packing = $('#packing').val();
        var batch = $('#batch').val();
        var expiry = $('#expiry').val();
        var supplier = $('#supplier').val();
        var quantity = $('#quantity').val();
        var price = $('#price').val();
        var active = $('#active').val();
        var date = $('#date').val();


        $.ajax({
            url: "manage_medicine_stock/insert.php",
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
            url: "manage_medicine_stock/fetch_single.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#exampleModal').modal('show');
                $('#name').val(data.name);
                $('#generic').val(data.generic);
                $('#packing').val(data.packing);
                $('#batch').val(data.batch);
                $('#expiry').val(data.expiry);
                $('#supplier').val(data.supplier);
                $('#quantity').val(data.quantity);
                $('#price').val(data.price);
                $('#active').val(data.active);
                $('#date').val(data.date);
                $('.modal-title').text("Edit Medicine_Stock");
                $('#user_id').val(user_id);
                $('#user_uploaded_image').html(data.user_image);
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
                    url: "manage_medicine_stock/delete.php",
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
                maxlength: 20,
                regex: /^[a-zA-Z]+$/,
            },
            'generic': {
                required: true,
                minlength: 3,
                maxlength: 20,
                // regex: /^[a-zA-Z]+$/,
            },
            'packing': {
                required: true,
            },
            'batch': {
                required: true,
            },
            'expiry': {
                required: true,
            },
            'supplier': {
                required: true,
                minlength: 3,
                maxlength: 20,
            },
            'quantity': {
                required: true,
            },
            'price': {
                required: true,
            },
            'date': {
                required: true,
            }

        },
        messages: {
            'name': {
                required: "Please enter full Names.",
                minlength: "A minimum of 3 characters is required",
                maxlength: "Field accepts maximum of 15 characters",
                regex: "Enter alphabets only for name fields",
            },
            'generic': {
                required: "Please enter the medicine generic name.",
                minlength: "A minimum of 3 characters is required",
                maxlength: "Field accepts maximum of 20 characters",
            },
            'packing': {
                required: "Please enter number of tabs packed.",
            },
            'batch': {
                required: "Please enter the batch ID.",
            },
            'expiry': {
                required: "Please enter the Expiry date.",
            },
            'supplier': {
                required: "Please enter the supplier's name.",
                minlength: "A minimum of 3 characters is required",
                maxlength: "Field accepts maximum of 15 characters",
            },
            'quantity': {
                required: "Please enter the quantity.",
            },
            'price': {
                required: "Please enter the price.",
            },
            'date': {
                required: "Please enter the date.",
            }
        },
    });
})
</script>

</body>

</html>