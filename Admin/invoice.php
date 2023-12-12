<?php include('./partials/menu1.php') ?>
<div class="contain">
    <?php
      if(isset($_GET["add"]))
      {
      ?>
    <form method="post" id="invoice_form">
        <div>
            <table class="table table-bordered">
                <tr>
                    <td colspan="2" align="center">
                        <h2 style="margin-top:10.5px">Create Invoice</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-4">
                                <b>Please in the following information if necessary</b><br /><br>
                                <select name="payment_method" id="payment_method" class="form-control form-control-sm">
                                    <option value="">--Select the payment method--</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Netbanking">Netbanking</option>
                                </select><br />
                                <input type="text" name="order_date" id="order_date" class="form-control input-sm"
                                    readonly placeholder="Select Invoice Date" /><br />
                                <textarea name="order_receiver_address" id="order_receiver_address"
                                    class="form-control form-control-sm" placeholder="Enter Billing Address"></textarea>
                            </div>
                        </div>
                        <br />
                        <table id="invoice-item-table" class="table table-bordered">
                            <tr style="color: var(--color-dark);">
                                <th width="7%">Sr No.</th>
                                <th width="20%">Item Name</th>
                                <th width="10%">Quantity</th>
                                <th width="11%">Price</th>
                                <th width="11%">Actual Amt.</th>
                                <th width="13%" colspan="2">Tax1 (%)</th>
                                <th width="13%" colspan="2">Tax2 (%)</th>
                                <th width="13.5%" rowspan="2">Total</th>
                            </tr>
                            <tr style="color: var(--color-dark);">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Rate</th>
                                <th>Amt.</th>
                                <th>Rate</th>
                                <th>Amt.</th>
                            </tr>
                            <tr>
                                <td><span id="sr_no">1</span></td>
                                <td>
                                    <select name="item_name[]" id="item_name1" class="form-control form-control-sm">
                                        <option selected disabled>-Select from the options-</option>
                                        <?php 
                                            $sql = "SELECT CONCAT(name, ' (', price, ')') AS Item FROM tbl_medicine_stock WHERE active='Yes'";
                                            $res = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($res) > 0){
                                                while($row = mysqli_fetch_assoc($res)){
                                                    $name = $row['Item'];
                                        ?>
                                        <option value="<?php echo htmlspecialchars($name); ?>">
                                            <?php echo htmlspecialchars($name); ?></option>
                                        <?php
                                                }
                                            } else {
                                        ?>
                                        <option value="0">No Medicine found</option>
                                        <?php
                                            }
                                        ?>
                                    </select>   
                                </td>

                            <td>
                        
                                <input type="text" name="order_item_quantity[]" id="order_item_quantity1" data-srno="1"
                                    class="form-control form-control-sm order_item_quantity" /></td>
                            <td><input type="text" name="order_item_price[]" id="order_item_price1" data-srno="1"
                                    class="form-control form-control-sm number_only order_item_price" /></td>
                            <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1"
                                    data-srno="1" class="form-control form-control-sm order_item_actual_amount"
                                    readonly /></td>
                            <td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate1"
                                    data-srno="1"
                                    class="form-control form-control-sm number_only order_item_tax1_rate" /></td>
                            <td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount1"
                                    data-srno="1" readonly
                                    class="form-control form-control-sm order_item_tax1_amount" /></td>
                            <td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate1"
                                    data-srno="1"
                                    class="form-control form-control-sm number_only order_item_tax2_rate" /></td>
                            <td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount1"
                                    data-srno="1" readonly
                                    class="form-control form-control-sm order_item_tax2_amount" /></td>
                            <td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount1"
                                    data-srno="1" readonly
                                    class="form-control form-control-sm order_item_final_amount" /></td>
                            <td></td>
                </tr>
            </table>
            <div align="right">
                <button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">+</button>
            </div>
            </td>
            </tr>
            <tr>
                <td align="right"><b>Total</td>
                <td align="right"><b><span id="final_total_amt"></span></b></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="hidden" name="total_item" id="total_item" value="1" />
                    <input type="submit" name="create_invoice" id="create_invoice" class="btn btn-info"
                        value="Create" />
                    <a href="<?php echo SITEURL; ?>invoice.php" class="btn btn-danger">
                        Back
                    </a>
                </td>
            </tr>
            </table>
        </div>
    </form>
    <script>
    $(document).ready(function() {
        var final_total_amt = $('#final_total_amt').text();
        var count = 1;

        $(document).on('click', '#add_row', function() {
    count++;
    $('#total_item').val(count);
    var html_code = '';
    html_code += '<tr id="row_id_' + count + '">';
    html_code += '<td><span id="sr_no">' + count + '</span></td>';

    html_code += '<td>';
    html_code += '<select name="item_name[]" id="item_name' + count + '" class="form-control form-control-sm">';
    html_code += '<option selected disabled>-Select from the options-</option>';
    <?php
    $sql = "SELECT CONCAT(name, ' (', price, ')') AS Item FROM tbl_medicine_stock WHERE active='Yes'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $name = htmlspecialchars($row['Item']);
            echo "html_code += '<option value=\"" . htmlspecialchars($name) . "\">" . htmlspecialchars($name) . "</option>';";
        }
    } else {
        echo "html_code += '<option value=\"0\">No Medicine found</option>';";
    }
    ?>
    html_code += '</select>';
    html_code += '</td>';
    
    html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity' +
        count + '" data-srno="' + count +
        '" class="form-control input-sm number_only order_item_quantity" /></td>';
    html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price' +
        count + '" data-srno="' + count +
        '" class="form-control input-sm number_only order_item_price" /></td>';
    html_code +=
        '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount' +
        count + '" data-srno="' + count +
        '" class="form-control input-sm order_item_actual_amount" readonly /></td>';

    html_code +=
        '<td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate' +
        count + '" data-srno="' + count +
        '" class="form-control input-sm number_only order_item_tax1_rate" /></td>';
    html_code +=
        '<td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount' +
        count + '" data-srno="' + count +
        '" readonly class="form-control input-sm order_item_tax1_amount" /></td>';
    html_code +=
        '<td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate' +
        count + '" data-srno="' + count +
        '" class="form-control input-sm number_only order_item_tax2_rate" /></td>';
    html_code +=
        '<td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount' +
        count + '" data-srno="' + count +
        '" readonly class="form-control input-sm order_item_tax2_amount" /></td>';
    html_code +=
        '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount' +
        count + '" data-srno="' + count +
        '" readonly class="form-control input-sm order_item_final_amount" /></td>';
    html_code += '<td><button type="button" name="remove_row" id="' + count +
        '" class="btn btn-danger btn-xs remove_row">X</button></td>';
    html_code += '</tr>';
    $('#invoice-item-table').append(html_code);
    
    $("#item_name" + count).chosen();
});

        $(document).on('click', '.remove_row', function() {
            var row_id = $(this).attr("id");
            var total_item_amount = $('#order_item_final_amount' + row_id).val();
            var final_amount = $('#final_total_amt').text();
            var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
            $('#final_total_amt').text(result_amount);
            $('#row_id_' + row_id).remove();
            count--;
            $('#total_item').val(count);
        });

        function cal_final_total(count) {
            var final_item_total = 0;
            for (j = 1; j <= count; j++) {
                var quantity = 0;
                var price = 0;
                var actual_amount = 0;
                var tax1_rate = 0;
                var tax1_amount = 0;
                var tax2_rate = 0;
                var tax2_amount = 0;
                var item_total = 0;
                quantity = $('#order_item_quantity' + j).val();
                if (quantity > 0) {
                    price = $('#order_item_price' + j).val();
                    if (price > 0) {
                        actual_amount = parseFloat(quantity) * parseFloat(price);
                        $('#order_item_actual_amount' + j).val(actual_amount);
                        tax1_rate = $('#order_item_tax1_rate' + j).val();
                        if (tax1_rate > 0) {
                            tax1_amount = parseFloat(actual_amount) * parseFloat(tax1_rate) / 100;
                            $('#order_item_tax1_amount' + j).val(tax1_amount);
                        }
                        tax2_rate = $('#order_item_tax2_rate' + j).val();
                        if (tax2_rate > 0) {
                            tax2_amount = parseFloat(actual_amount) * parseFloat(tax2_rate) / 100;
                            $('#order_item_tax2_amount' + j).val(tax2_amount);
                        }
                        item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(
                            tax2_amount);
                        final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                        $('#order_item_final_amount' + j).val(item_total);
                    }
                }
            }
            $('#final_total_amt').text(final_item_total);
        }

        $(document).on('blur', '.order_item_price', function() {
            cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax1_rate', function() {
            cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax2_rate', function() {
            cal_final_total(count);
        });

        $('#create_invoice').click(function() {
            if ($.trim($('#payment_method').val()).length == 0) {
                alert("Please Select the payment Method");
                return false;
            }

            if ($.trim($('#order_date').val()).length == 0) {
                alert("Please Select Invoice Date");
                return false;
            }

            for (var no = 1; no <= count; no++) {
                if ($.trim($('#item_name' + no).val()).length == 0) {
                    alert("Please Enter Item Name");
                    $('#item_name' + no).focus();
                    return false;
                }

                if ($.trim($('#order_item_quantity' + no).val()).length == 0) {
                    alert("Please Enter Quantity");
                    $('#order_item_quantity' + no).focus();
                    return false;
                }

                if ($.trim($('#order_item_price' + no).val()).length == 0) {
                    alert("Please Enter Price");
                    $('#order_item_price' + no).focus();
                    return false;
                }

            }

            $('#invoice_form').submit();

        });

    });
    </script>
    <?php
      }
      elseif(isset($_GET["update"]) && isset($_GET["id"]))
      {
        $statement = $connect->prepare("
          SELECT * FROM tbl_order 
            WHERE order_id = :order_id
            LIMIT 1
        ");
        $statement->execute(
          array(
            ':order_id'       =>  $_GET["id"]
            )
          );
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
        ?>
    <script>
    $(document).ready(function() {
        $('#order_no').val("<?php echo $row["order_no"]; ?>");
        $('#order_date').val("<?php echo $row["order_date"]; ?>");
        $('#payment_method').val("<?php echo $row["payment_method"]; ?>");
        $('#order_receiver_address').val("<?php echo $row["order_receiver_address"]; ?>");
    });
    </script>
    <form method="post" id="invoice_form">
        <div>
            <table class="table table-bordered">
                <tr>
                    <td colspan="2" align="center">
                        <h2 style="margin-top:10.5px">Edit Invoice</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-4">
                                <b>Information about this Order</b><br /><br>
                                <input type="text" name="order_no" id="order_no" value="<?= $row['order_no']?>"
                                    class="form-control input-sm" disabled /> <br>
                                <select name="payment_method" id="payment_method" value="<?= $row['payment_method']?>"
                                    class="form-control form-control-sm">
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Netbanking">Netbanking</option>
                                </select><br />
                                <input type="text" name="order_date" id="order_date" value="<?= $row['order_date']?>"
                                    class="form-control input-sm" readonly /><br />
                                <textarea name="order_receiver_address" id="order_receiver_address"
                                    class="form-control form-control-sm"><?= $row['order_receiver_address']?></textarea>
                            </div>
                            <table id="invoice-item-table" class="table table-bordered" style="margin-top: 10px;">
                                <tr style="color: var(--color-dark);">
                                    <th width="7%">Sr No.</th>
                                    <th width="20%">Item Name</th>
                                    <th width="10%">Quantity</th>
                                    <th width="11%">Price</th>
                                    <th width="11%">Actual Amt.</th>
                                    <th width="13%" colspan="2">Tax1 (%)</th>
                                    <th width="13%" colspan="2">Tax2 (%)</th>
                                    <th width="13.5%" rowspan="2">Total</th>
                                </tr>
                                <tr style="color: var(--color-dark);">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Rate</th>
                                    <th>Amt.</th>
                                    <th>Rate</th>
                                    <th>Amt.</th>
                                </tr>
                                <?php
                    $statement = $connect->prepare("
                      SELECT * FROM tbl_order_item 
                      WHERE order_id = :order_id
                    ");
                    $statement->execute(
                      array(
                        ':order_id'       =>  $_GET["id"]
                      )
                    );
                    $item_result = $statement->fetchAll();
                    $m = 0;
                    foreach($item_result as $sub_row)
                    {
                      $m = $m + 1;
                    ?>
                                <tr>
                                    <td><span id="sr_no"><?php echo $m; ?></span></td>
                                    <td><input type="text" name="item_name[]" id="item_nam<?php echo $m; ?>"
                                            class="form-control input-sm"
                                            value="<?php echo $sub_row["item_name"]; ?>" /></td>
                                    <td><input type="text" name="order_item_quantity[]"
                                            id="order_item_quantity<?php echo $m; ?>" data-srno="<?php echo $m; ?>"
                                            class="form-control input-sm order_item_quantity"
                                            value="<?php echo $sub_row["order_item_quantity"]; ?>" /></td>
                                    <td><input type="text" name="order_item_price[]"
                                            id="order_item_price<?php echo $m; ?>" data-srno="<?php echo $m; ?>"
                                            class="form-control input-sm number_only order_item_price"
                                            value="<?php echo $sub_row["order_item_price"]; ?>" /></td>
                                    <td><input type="text" name="order_item_actual_amount[]"
                                            id="order_item_actual_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>"
                                            class="form-control input-sm order_item_actual_amount"
                                            value="<?php echo $sub_row["order_item_actual_amount"];?>" readonly /></td>
                                    <td><input type="text" name="order_item_tax1_rate[]"
                                            id="order_item_tax1_rate<?php echo $m; ?>" data-srno="<?php echo $m; ?>"
                                            class="form-control input-sm number_only order_item_tax1_rate"
                                            value="<?php echo $sub_row["order_item_tax1_rate"]; ?>" /></td>
                                    <td><input type="text" name="order_item_tax1_amount[]"
                                            id="order_item_tax1_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>"
                                            readonly class="form-control input-sm order_item_tax1_amount"
                                            value="<?php echo $sub_row["order_item_tax1_amount"];?>" /></td>
                                    <td><input type="text" name="order_item_tax2_rate[]"
                                            id="order_item_tax2_rate<?php echo $m; ?>" data-srno="<?php echo $m; ?>"
                                            class="form-control input-sm number_only order_item_tax2_rate"
                                            value="<?php echo $sub_row["order_item_tax2_rate"];?>" /></td>
                                    <td><input type="text" name="order_item_tax2_amount[]"
                                            id="order_item_tax2_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>"
                                            readonly class="form-control input-sm order_item_tax2_amount"
                                            value="<?php echo $sub_row["order_item_tax2_amount"]; ?>" /></td>
                                    <td><input type="text" name="order_item_final_amount[]"
                                            id="order_item_final_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>"
                                            readonly class="form-control input-sm order_item_final_amount"
                                            value="<?php echo $sub_row["order_item_final_amount"]; ?>" /></td>
                                    <td></td>
                                </tr>
                                <?php
                    }
                    ?>
                            </table>

                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Total</td>
                    <td align="right"><b><span
                                id="final_total_amt"><?php echo $row["order_total_after_tax"]; ?></span></b></td>
                </tr>
                <tr>
                    <!-- <td colspan="2"></td> -->
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="hidden" name="total_item" id="total_item" value="<?php echo $m; ?>" />
                        <input type="hidden" name="order_id" id="order_id" value="<?php echo $row["order_id"]; ?>" />
                        <input type="submit" name="update_invoice" id="create_invoice" class="btn btn-info"
                            value="Edit" />
                        <a href="<?php echo SITEURL; ?>invoice.php" class="btn btn-danger">
                            Back
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <script>
    $(document).ready(function() {
        var final_total_amt = $('#final_total_amt').text();
        var count = "<?php echo $m; ?>";

        $(document).on('click', '#add_row', function() {
            count++;
            $('#total_item').val(count);
            var html_code = '';
            html_code += '<tr id="row_id_' + count + '">';
            html_code += '<td><span id="sr_no">' + count + '</span></td>';

            html_code += '<td><input type="text" name="item_name[]" id="item_name' + count +
                '" class="form-control input-sm" /></td>';

            html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity' +
                count + '" data-srno="' + count +
                '" class="form-control input-sm number_only order_item_quantity" /></td>';
            html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price' +
                count + '" data-srno="' + count +
                '" class="form-control input-sm number_only order_item_price" /></td>';
            html_code +=
                '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount' +
                count + '" data-srno="' + count +
                '" class="form-control input-sm order_item_actual_amount" readonly /></td>';

            html_code +=
                '<td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate' +
                count + '" data-srno="' + count +
                '" class="form-control input-sm number_only order_item_tax1_rate" /></td>';
            html_code +=
                '<td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount' +
                count + '" data-srno="' + count +
                '" readonly class="form-control input-sm order_item_tax1_amount" /></td>';
            html_code +=
                '<td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate' +
                count + '" data-srno="' + count +
                '" class="form-control input-sm number_only order_item_tax2_rate" /></td>';
            html_code +=
                '<td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount' +
                count + '" data-srno="' + count +
                '" readonly class="form-control input-sm order_item_tax2_amount" /></td>';
            html_code +=
                '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount' +
                count + '" data-srno="' + count +
                '" readonly class="form-control input-sm order_item_final_amount" /></td>';
            html_code += '<td><button type="button" name="remove_row" id="' + count +
                '" class="btn btn-danger btn-xs remove_row">X</button></td>';
            html_code += '</tr>';
            $('#invoice-item-table').append(html_code);
        });

        $(document).on('click', '.remove_row', function() {
            var row_id = $(this).attr("id");
            var total_item_amount = $('#order_item_final_amount' + row_id).val();
            var final_amount = $('#final_total_amt').text();
            var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
            $('#final_total_amt').text(result_amount);
            $('#row_id_' + row_id).remove();
            count--;
            $('#total_item').val(count);
        });

        function cal_final_total(count) {
            var final_item_total = 0;
            for (j = 1; j <= count; j++) {
                var quantity = 0;
                var price = 0;
                var actual_amount = 0;
                var tax1_rate = 0;
                var tax1_amount = 0;
                var tax2_rate = 0;
                var tax2_amount = 0;
                var item_total = 0;
                quantity = $('#order_item_quantity' + j).val();
                if (quantity > 0) {
                    price = $('#order_item_price' + j).val();
                    if (price > 0) {
                        actual_amount = parseFloat(quantity) * parseFloat(price);
                        $('#order_item_actual_amount' + j).val(actual_amount);
                        tax1_rate = $('#order_item_tax1_rate' + j).val();
                        if (tax1_rate > 0) {
                            tax1_amount = parseFloat(actual_amount) * parseFloat(tax1_rate) / 100;
                            $('#order_item_tax1_amount' + j).val(tax1_amount);
                        }
                        tax2_rate = $('#order_item_tax2_rate' + j).val();
                        if (tax2_rate > 0) {
                            tax2_amount = parseFloat(actual_amount) * parseFloat(tax2_rate) / 100;
                            $('#order_item_tax2_amount' + j).val(tax2_amount);
                        }
                        item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(
                            tax2_amount);
                        final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                        $('#order_item_final_amount' + j).val(item_total);
                    }
                }
            }
            $('#final_total_amt').text(final_item_total);
        }

        $(document).on('blur', '.order_item_price', function() {
            cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax1_rate', function() {
            cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax2_rate', function() {
            cal_final_total(count);
        });

        $('#create_invoice').click(function() {
            if ($.trim($('#payment_method').val()).length == 0) {
                alert("Please Enter Reciever Name");
                return false;
            }

            if ($.trim($('#order_no').val()).length == 0) {
                alert("Please Enter Invoice Number");
                return false;
            }

            if ($.trim($('#order_date').val()).length == 0) {
                alert("Please Select Invoice Date");
                return false;
            }

            for (var no = 1; no <= count; no++) {
                if ($.trim($('#item_nam' + no).val()).length == 0) {
                    alert("Please Enter Item Name");
                    $('#item_nam' + no).focus();
                    return false;
                }

                if ($.trim($('#order_item_quantity' + no).val()).length == 0) {
                    alert("Please Enter Quantity");
                    $('#order_item_quantity' + no).focus();
                    return false;
                }

                if ($.trim($('#order_item_price' + no).val()).length == 0) {
                    alert("Please Enter Price");
                    $('#order_item_price' + no).focus();
                    return false;
                }

            }

            $('#invoice_form').submit();

        });

    });
    </script>
    <?php 
        }
      }
      else
      {
      ?>
    <h1 class="title">CREATE AND MANAGE INVOICES</h1>
    <a href="invoice.php?add=1" class="btn btn-info btn-xs btn-sm mb-4">Create an Invoice</a>
    <div id="finish">

    </div>
    <div class="hr"></div>
    <br>
    <div class="recent-orders">
        <div class="container-fluid">

            <table id="data-table" class="display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>Invoice No.</th>
                        <th>Payment Method</th>
                        <th>Invoice Date</th>
                        <th>Invoice Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
        if($total_rows > 0)
        {
          foreach($all_result as $row)
          {
            echo '
              <tr>
                <td>'.$row["order_no"].'</td>
                <td>'.$row["payment_method"].'</td>
                <td>'.$row["order_date"].'</td>
                <td>'.$row["order_total_after_tax"].'</td>
                <td>
                <div class="dropdown">
                  <a class="btn btn-light hidden-arrow dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical text-danger"></i>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="print_invoice.php?pdf=1&id='.$row["order_id"].'" class=" dropdown-item update btn-sm btn btn-warning"><i class="bx bx-printer"></i> PDF</a>
                    </li>
                    <li>
                    <a href="invoice.php?update=1&id='.$row["order_id"].'" class="dropdown-item btn-sm btn btn-infor"><i class="bx bx-edit"></i>
                    Edit</a>
                    </li>
                    <li>
                    <a href="#" id="'.$row["order_id"].'" class="delete dropdown-item btn-sm btn btn-danger"><i class="bx bx-trash"></i>
                     Delete</a>
                    </li>
                  </ul>
                  </td>
              </tr>
              </div>
            ';
          }
        }
        ?>
            </table>
            <?php
      }
      ?>
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


        <script src="./assets/sweetalert2@11.js"></script>
        <script src="./assets/java.js"></script>
        <script src="./assets/index.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
        <Script>
        $("#item_name1").chosen();
        </Script>
       


        <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                dom: 'Blfrtip',
                "order": [],
                "columnDefs": [{
                    "targets": [4],
                    "orderable": false,
                }, ],
                "pageLength": 25,
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
                ],
            });

            $(document).on('click', '.delete', function() {
                var id = $(this).attr("id");
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
                        window.location.href = "invoice.php?delete=1&id=" + id;
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        )

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

        <script>
        $(document).ready(function() {
            $('.number_only').keypress(function(e) {
                return isNumbers(e, this);
            });

            function isNumbers(evt, element) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if (
                    (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
                    (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
        });
        </script>
        </body>

        </html>