<?php include('./partials/menu.php'); ?>
<div id="barchart_material" style="width: 80%; height: 500px; margin: 0 auto;"></div><br><br><br>
<div id="barchart_material1" style="width: 80%; height: 500px; margin: 0 auto;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'total_money','total_customers'],
          <?php
          $conn = new mysqli("localhost", "root", "", "pharmacy");

          if (!$conn) {
            echo "Connection Failed";
          }

          $query = "SELECT 
          COUNT(DISTINCT email) AS total_customers,
          SUM(CAST(amount_paid AS DECIMAL(10,2))) AS total_money,
          MONTH(date) AS month
        FROM 
          tbl_orders 
        WHERE 
          status = 'Delivered' 
        GROUP BY 
          MONTH(date)";
          $res = mysqli_query($conn, $query);
          while ($data = mysqli_fetch_array($res)) {
            $month = $data['month'];
            $total_money = $data['total_money'];
            $total_customers = $data['total_customers'];
          ?>
          ['<?php echo $month;?>',<?php echo $total_money;?>,<?= $total_customers;?>],
          <?php
          }
          ?>
        ]);

        var options = {
            'title': 'ONLINE SALES REPORT',
            'subtitle': 'Total Customers and amount of money earned in every month',
             'backgroundColor': 'transparent', // Set the background color of the graph
              'height':500,
            bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'total_money','total_invoices'],
          <?php
          $conn = new mysqli("localhost", "root", "", "pharmacy");

          if (!$conn) {
            echo "Connection Failed";
          }

          $query = "SELECT 
          COUNT(DISTINCT order_no) AS total_invoices,
          SUM(CAST(order_total_after_tax AS DECIMAL(10,2))) AS total_money,
          MONTH(order_date) AS month
        FROM 
          tbl_order  
        GROUP BY 
          MONTH(order_date)";
          $res = mysqli_query($conn, $query);
          while ($data = mysqli_fetch_array($res)) {
            $month = $data['month'];
            $total_money = $data['total_money'];
            $total_invoices = $data['total_invoices'];
          ?>
          ['<?php echo $month;?>',<?php echo $total_money;?>,<?= $total_invoices;?>],
          <?php
          }
          ?>
        ]);

      
        var options = {
            'title': 'ONLINE SALES REPORT',
            'subtitle': 'Total Customers and amount of money earned in every month',
             'backgroundColor': 'transparent', // Set the background color of the graph
              'height':500,
            bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
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