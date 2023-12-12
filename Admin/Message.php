<?php include('./partials/menu.php'); ?>
<div class="contain">
    <h1 class="title">Messages</h1>
    <div class="hr"></div>
    <br>
    <div id="finish">

    </div>
    <!--- HTML for the table starts here-->
    <div class="recent-orders">
        <div class="container-fluid">
            <table id="example" class="display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
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
                <div class="card-list" style="height: 455px;">
                    <div class="inner-box" id="card">
                        <div class="card-font">
                            <form method="post" id="customer_form" enctype="multiple/form-data">
                                <h2 class="modal-title" id="modalTitleId">Add Supplier</h2>
                                <p class="success" style="font-size: 17px; text-align: center;" id="order">

                                </p>
                                <label class="label">Client's Names</label>
                                <input type="text" name="name" id="name" class="input-box" disabled><br>

                                <Label class="label">Client's Email</Label>
                                <input type="email" name="email" id="email" class="input-box" disabled><br>

                                <label class="label">Client's Contact</label>
                                <input type="text" name="contact" id="contact" class="input-box" disabled><br>

                                <label class="label">Date</label>
                                <input type="text" class="input-box" name="date" id="date" disabled><br>

                                <label class="label">Select to Update Status of the message</label>
                                <select name="status" id="status" class="input-box">
                                    <option value="Read">Read</option>
                                    <option value="Viewed">Viewed</option>
                                </select>


                                <div class="submit-btn mt-1">
                                    <input type="hidden" name="user_id" id="user_id" />
                                    <input type="hidden" name="operation" id="operation" />
                                    <input type="submit" name="action" id="action"
                                        style="background: none; color: #fff;" value="Update" />
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

    var dataTable = $('#example').DataTable({
        dom: 'Blfrtip',
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "manage_message/fetch.php",
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
        var status = $('#status').val();


        $.ajax({
            url: "manage_message/insert.php",
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
            url: "manage_message/fetch_single.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#exampleModal').modal('show');
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#contact').val(data.contact);
                $('#date').val(data.date);
                $('#status').val(data.status);
                $('.modal-title').text("Update");
                $('#user_id').val(user_id);
                $('#action').val("Update");
                $('#operation').val("Update");
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
                    url: "manage_message/delete.php",
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
</script>