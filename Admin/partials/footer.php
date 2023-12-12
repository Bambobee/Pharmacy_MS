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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="./jquery/jquery.validate.min.js"></script>
<script src="./assets/datatables.min.js"></script>
<script src="./assets/pdfmake.min.js"></script>
<script src="./assets/vfs_fonts.js"></script>
<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/dataTables.responsive.min.js"></script>
<script src="./assets/sweetalert.min.js"></script>
    <script src="./assets/java.js"></script>
    <script src="./assets/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" 
integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<Script>
    $("#category").chosen();
</Script>
    
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
    
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#data-table').DataTable({
          "order":[],
          "columnDefs":[
          {
            "targets":[4, 5, 6],
            "orderable":false,
          },
        ],
        "pageLength": 25
        });
    $(document).on('click', '.delete', function(){
      var id = $(this).attr("id");
      if(confirm("Are you sure you want to remove this?"))
      {
        window.location.href="invoice.php?delete=1&id="+id;
      }
      else
      {
        return false;
      }
    });
  });

</script>

<script>
$(document).ready(function(){
$('.number_only').keypress(function(e){
return isNumbers(e, this);      
});
function isNumbers(evt, element) 
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (
(charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
(charCode < 48 || charCode > 57))
return false;
return true;
}
});
</script>

</body>
</html>