<?php include('./partials/menu.php'); ?>
<div class="contain">
    <h1 class="title">Dashboard</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Home</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Dashboard</a></li>
    </ul>
    <div class="hr"></div>
    <div class="info-data">
        <div class="cards">
            <div class="head">
                <div>
                    <?php 
                        //Create a sql query to get total revenue generated
                        //aggregate function in sql
                        $sql4 = "SELECT SUM(CAST(amount_paid AS DECIMAL(10,2))) AS amount_paid from tbl_orders WHERE status='Delivered'";
                        //Executed the query 
                        $res4 = mysqli_query($conn, $sql4);
                        //Get the value
                        $row4 = mysqli_fetch_assoc($res4);
                        //get the total revenue
                        $total_revenue = $row4['amount_paid']; 
                        ?>
                    <h2>Shs <?php echo $total_revenue; ?>/-</h2>
                    <p>Total Online sales</p>
                </div>
                <i class="bx bx-credit-card-front icon"></i>
            </div>
        </div>

        <div class="cards">
            <div class="head">
                <div>
                    <?php 
                        //Create a sql query to get total revenue generated
                        //aggregate function in sql
                        $sql5 = "SELECT SUM(order_total_after_tax) AS order_total_after_tax from tbl_order";
                        //Executed the query 
                        $res5 = mysqli_query($conn, $sql5);
                        //Get the value
                        $row5 = mysqli_fetch_assoc($res5);
                        //get the total revenue
                        $total_revenue = $row5['order_total_after_tax']; 
                        ?>
                    <h2>Shs <?php echo $total_revenue; ?>/-</h2>
                    <p>Total Sales Physically</p>
                </div>
                <i style="color: blue;" class="bx bx-money icon"></i>
            </div>
        </div>

        <div class="cards">
            <div class="head">
                <div>
                    <?php
                //sql query
                $sql7 = "SELECT * FROM tbl_order";
                //Execute Query
                $res7 = mysqli_query($conn, $sql7);
                //Count row
                $count7 = mysqli_num_rows($res7);                
                ?>
                    <h2><?= $count7; ?></h2>
                    <p>Total Invoices</p>
                </div>
                <i style="color: brown;" class="bx bx-coin-stack icon"></i>
            </div>
        </div>

        <div class="cards">
            <div class="head">
                <div>
                    <?php
                //sql query
                $sql3 = "SELECT * FROM tbl_users";
                //Execute Query
                $res3 = mysqli_query($conn, $sql3);
                //Count row
                $count3 = mysqli_num_rows($res3);                
                ?>
                    <h2><?= $count3; ?></h2>
                    <p>Total Online Customers</p>
                </div>
                <i class="bx bx-user icon down"></i>
            </div>
        </div>
    </div>
    <div class="hr"></div>
    <!--- HTML for the table starts here-->
    <div class="recent-orders">
        <h1 class="title">Customers</h1>
        <button type="button" id="add_button" class="btn btn-sm btn-primary mb-4" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Add Admin
        </button>
        <div id="finish">

        </div>
        <!--- HTML for the table starts here-->
        <div class="container-fluid">
            <table id="example" class="display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Image</th>
                        <th>Full Names</th>
                        <th>Email</th>
                        <th>User Group</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="card-list">
                        <div class="inner-box" id="card">
                            <div class="card-font">
                                <form method="post" id="user_form" enctype="multiple/form-data">
                                    <h2 class="modal-title" id="modalTitleId">Add Admin</h2>
                                    <p class="success" style="font-size: 17px; text-align: center;" id="order">

                                    </p>
                                    <label class="label">Enter Your Names</label>
                                    <input type="text" name="name" class="input-box" placeholder="Name..."
                                        id='name'><br>

                                    <Label class="label">Enter Your Email</Label>
                                    <input type="email" name="email" class="input-box" placeholder="Email..."
                                        id='email'><br>

                                    <label class="label">Upload Your Photo</label>
                                    <input type="file" class="upload-box mb-2" name="user_image" id="user_image" /><br>
                                    <span id="user_uploaded_image"></span><br>

                                    <label class="label">Enter Your Password</label>
                                    <input type="password" name="password" id='password' class="input-box"
                                        placeholder="Password...">

                                    <label class="label">Select the user group</label>
                                    <select name="userType" id="userType" class="input-box">
                                        <option value="admin">Admin</option>
                                        <option value="employee">Employee</option>
                                    </select>

                                    <div class="submit-btn">
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
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Admin");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#user_uploaded_image').html('');
    });
    var dataTable = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "manage_Admin/fetch.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 5],
            "orderable": false,
        }, ],

    });


    $(document).on('submit', '#user_form', function(event) {
        event.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var userType = $('#userType').val();


        $.ajax({
            url: "manage_Admin/insert.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                $("#order").html(data);
                $('#user_form')[0].reset();
                // $('#exampleModal').modal('hide');
                dataTable.ajax.reload();
            }
        });

    });

    $(document).on('click', '.update', function() {
        var user_id = $(this).attr("id");
        $.ajax({
            url: "manage_Admin/fetch_single.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#exampleModal').modal('show');
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#userType').val(data.userType);
                $('.modal-title').text("Edit Admin");
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
                    url: "manage_Admin/delete.php",
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

    $("#user_form").validate({
        rules: {
            'name': {
                required: true,
                minlength: 3,
                maxlength: 30,
                // regex: /^[a-zA-Z]+$/,
            },
            'email': {
                required: true,
                email: true,
            },
            'user_image': {
                extension: "jpg|png|jpeg",
                filesize: 3 * (1024 * 1024), // 3mb
            },
            'password': {
                required: true,
                minlength: 5,
            }
        },
        messages: {
            'name': {
                required: "Please enter full Names.",
                minlength: "A minimum of 3 characters is required",
                maxlength: "Field accepts maximum of 15 characters",
                regex: "Enter alphabets only for name fields",
            },
            'email': {
                required: "Please enter the email.",
                email: "Enter a valid email address",
            },
            'user_image': {
                extension: "Please enter a valid image types(PNG, JPG, JPEG).",
                filesize: "Picture should not exceed 5mb",
            },
            'password': {
                required: "Please enter the password.",
                minlength: "Enter a strong password.",
            },
        },
    });
})
</script>

</body>

</html>