<?php include('./partials/menu.php'); ?>
<div class="contain">
    <h1 class="title">Medicine</h1>
    <button type="button" id="add_button" class="btn btn-sm btn-primary mb-4" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        Add Medicine
    </button>
    <div id="finish">

    </div>
    <div class="hr"></div>
    <!--- HTML for the table starts here-->
    <div class="recent-orders">
        <div class="container-fluid">
            <table id="example" class="display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Active</th>
                        <th>Featured</th>
                        <th>date</th>
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
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="card-list" style="height: 730px;">
                    <div class="inner-box" id="card">
                        <div class="card-font">
                            <form method="post" id="user_form" enctype="multiple/form-data">
                                <h2 class="modal-title" id="modalTitleId">Add Medicine</h2>
                                <p class="success" style="font-size: 17px; text-align: center;" id="order">

                                </p>
                                <label class="label">Enter Medicine name</label>
                                <input type="text" name="name" class="input-box" placeholder="Name..." id='name'><br>

                                <label class="label">Enter the medicine description</label>
                                <textarea class="input-box1" name="description" id="description" rows="4"
                                    placeholder="Decription..."></textarea>
                                <br>

                                <label class="label">Enter the price</label>
                                <input type="number" name="price" class="input-box" placeholder="Price..."
                                    id='price'><br>

                                <label class="label">Choose category from the options</label>
                                <select name="category" id="category" class="input-box">
                                    <option selected disabled>-Select from the options-</option>
                                    <?php 
                                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                            $res = mysqli_query($conn, $sql);
                                            $count = mysqli_num_rows($res);
                                            if($count>0){
                                                while($row=mysqli_fetch_assoc($res)){
                                                    $id = $row['id'];
                                                    $name = $row['name'];
                                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                    <?php
                                                }
                                            } 
                                            else{
                                                ?>
                                    <option value="0">No category found</option>
                                    <?php
                                            } 
                                            ?>
                                </select>

                                <label class="label">Pick the current date</label>
                                <input type="date" name="date" class="input-box" placeholder="Date..." id='date'><br>

                                <label class="label">Upload Your Photo</label>
                                <input type="file" class="upload-box mb-2" name="user_image" id="user_image" /><br>
                                <span id="user_uploaded_image"></span><br>

                                <Label class="label">Active</Label>
                                <select class="input-box" id="active" name="active">
                                    <option selected disabled>-Select from the options-</option>
                                    <option style="background: blue;" value="Yes">Yes</option>
                                    <option style="background: blue;" value="No">No</option>
                                </select><br>

                                <Label class="label">Featured</Label>
                                <select class="input-box" id="featured" name="featured">
                                    <option selected disabled>-Select from the options-</option>
                                    <option style="background: blue;" value="Yes">Yes</option>
                                    <option style="background: blue;" value="No">No</option>
                                </select><br>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('#add_button').click(function() {
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Medicine");
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
            url: "manage_medicine/fetch.php",
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


    $(document).on('submit', '#user_form', function(event) {
        event.preventDefault();
        var name = $('#name').val();
        var description = $('#description').val();
        var price = $('#price').val();
        var category = $('#category').val();
        var date = $('#date').val();
        var active = $('#active').val();
        var featured = $('#featured').val();

        $.ajax({
            url: "manage_medicine/insert.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                // alert(data);
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
            url: "manage_medicine/fetch_single.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#exampleModal').modal('show');
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#price').val(data.price);
                $('#date').val(data.date);
                $('#category').val(data.category);
                $('#active').val(data.active);
                $('#featured').val(data.featured);
                $('.modal-title').text("Edit Medicine");
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
                    url: "manage_medicine/delete.php",
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
            'description': {
                required: true,
                minlength: 3,
                maxlength: 200,
            },
            'price': {
                required: true,
            },
            'category': {
                required: true,
            },
            'date': {
                required: true,
            },
            'active': {
                required: true,
            },
            'featured': {
                required: true,
            },
            'user_image': {
                extension: "jpg|png|jpeg",
                filesize: 3 * (1024 * 1024), // 3mb
            }
        },
        messages: {
            'name': {
                required: "Please enter the medicine Name.",
                minlength: "A minimum of 3 characters is required",
                maxlength: "Field accepts maximum of 15 characters",
                // regex: "Enter alphabets only for name fields",
            },
            'description': {
                required: "Please enter the medicine description.",
                minlength: "A minimum of 3 characters is required",
                maxlength: "Field accepts maximum of 15 characters",
            },
            'price': {
                required: "Please enter the price.",
            },
            'category': {
                required: "Please choose the category.",
            },
            'date': {
                required: "Please pick the current date.",
            },
            'active': {
                required: "Please choose weather active or not.",
            },
            'featured': {
                required: "Please choose weather featured or not.",
            },
            'user_image': {
                extension: "Please enter a valid image types(PNG, JPG, JPEG).",
                filesize: "Picture should not exceed 5mb",
            }
        },
    });
});
</script>
<script>
$("#category").chosen();
</script>
</body>

</html>