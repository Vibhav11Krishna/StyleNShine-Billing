<?php
require 'config.php';
$bill_id = intval($_GET['id'] ?? 0);
$stmt = $connection->prepare("SELECT * FROM bills WHERE id=?");
$stmt->bind_param("i", $bill_id);
$stmt->execute();
$bill = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$bill) { die("Invoice not found."); }

$invoice_no = str_pad($bill_id, 4, '0', STR_PAD_LEFT);

// Determine current bill type to select the right file for the print button
$bill_type = trim($bill['bill_type'] ?? 'Parlour');
$is_parlour = (stripos($bill_type, 'parlour') !== false || stripos($bill_type, 'salon') !== false);
$print_target_file = $is_parlour ? 'invoice_parlour.php' : 'invoice.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Invoice #<?= $invoice_no ?> — Style N Shine</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f7fa; margin: 0; padding: 20px; }
        .edit-container { max-width: 750px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        h2 { color: #003366; margin-top: 0; border-bottom: 2px solid #003366; padding-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th { background: #003366; color: #fff; padding: 10px; text-align: left; font-size: 13px; }
        table td { padding: 10px; border-bottom: 1px solid #f0f0f0; font-size: 13px; }
        .item-row input[type="text"] { width: 100%; padding: 6px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; }
        .item-row input[type="number"] { width: 100px; padding: 6px; border: 1px solid #ddd; border-radius: 4px; }
        .summary-box { background: #f8fafc; padding: 15px; border-radius: 6px; margin-top: 20px; border: 1px solid #edf2f7; }
        .summary-line { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; font-size: 14px; }
        .summary-line.total { font-weight: bold; font-size: 18px; color: #003366; border-top: 2px solid #003366; padding-top: 10px; }
        .summary-line.dues { font-weight: bold; font-size: 16px; color: #c62828; background: #ffebee; padding: 8px; border-radius: 4px; margin-top: 10px; }
        .action-buttons { display: flex; gap: 15px; margin-top: 25px; }
        .btn { flex: 1; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 16px; border: none; text-align: center; text-decoration: none; display: inline-block; }
        .btn-update { background: #003366; color: #fff; }
        .btn-update:hover { background: #002244; }
        .btn-generate { background: #28a745; color: #fff; }
        .btn-generate:hover { background: #218838; }
        .btn-add { background: #17a2b8; color: #fff; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; margin-top: 10px; }
        .btn-delete { background: #dc3545; color: #fff; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; }
        .back-link { display: inline-block; margin-bottom: 15px; color: #003366; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="edit-container">
    <a href="index.php" class="back-link">&larr; Back to New Bill</a>
    <h2>Manage Bill #<?= $invoice_no ?></h2>

    <form action="update_bill.php" method="POST" id="editForm">
        <input type="hidden" name="bill_id" value="<?= $bill_id ?>">

        <div style="display: flex; gap: 15px;">
            <div class="form-group" style="flex: 2;">
                <label>Customer Name</label>
                <input type="text" name="customer_name" value="<?= htmlspecialchars($bill['customer_name']) ?>" required>
            </div>
            <div class="form-group" style="flex: 1;">
                <label>Phone Number</label>
                <input type="text" name="customer_phone" value="<?= htmlspecialchars($bill['customer_phone']) ?>" required>
            </div>
        </div>

        <div style="display: flex; gap: 15px;">
            <div class="form-group" style="flex: 1;">
                <label>Bill Type / Category</label>
                <select name="bill_type" id="billTypeSelect" required>
                    <option value="Parlour" <?= $is_parlour ? 'selected' : '' ?>>Beauty Parlour</option>
                    <option value="Boutique" <?= !$is_parlour ? 'selected' : '' ?>>Designer Boutique</option>
                </select>
            </div>
            <div class="form-group" style="flex: 1;">
                <label>Payment Mode</label>
                <select name="payment_mode">
                    <option value="Cash" <?= $bill['payment_mode'] == 'Cash' ? 'selected' : '' ?>>Cash</option>
                    <option value="UPI" <?= $bill['payment_mode'] == 'UPI' ? 'selected' : '' ?>>UPI</option>
                    <option value="Card" <?= $bill['payment_mode'] == 'Card' ? 'selected' : '' ?>>Card</option>
                </select>
            </div>
        </div>

        <h3>Services & Rates</h3>
        <table>
            <thead>
                <tr>
                    <th>Service Description</th>
                    <th style="width: 150px;">Amount (₹)</th>
                    <th style="width: 60px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody id="servicesTableBody">
                <?php
                $services = explode(",", $bill['services']);
                $subtotal = 0;
                foreach($services as $s){
                    $parts = explode(":", $s); 
                    if(count($parts) > 1) {
                        $details = explode("|", $parts[1]);
                    } else {
                        $details = explode("|", $parts[0]);
                    }
                    $sName = trim($details[0]);
                    $sPrice = floatval(trim($details[1] ?? 0));
                    $subtotal += $sPrice;
                ?>
                <tr class="item-row">
                    <td>
                        <input type="text" name="service_names[]" value="<?= htmlspecialchars($sName) ?>" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="service_prices[]" value="<?= $sPrice ?>" class="price-input" required oninput="calculateTotal()">
                    </td>
                    <td style="text-align: center;">
                        <button type="button" class="btn-delete" onclick="removeRow(this)">X</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="button" class="btn-add" onclick="addServiceRow()">+ Add Service</button>

        <?php 
            $discount = isset($bill['discount']) ? floatval($bill['discount']) : 0.00;
            $amount_paid = isset($bill['amount_paid']) ? floatval($bill['amount_paid']) : 0.00;
            $dues = isset($bill['dues']) ? floatval($bill['dues']) : 0.00;
        ?>

        <div class="summary-box">
            <div class="summary-line">
                <span>Subtotal:</span>
                <span>₹ <span id="subtotalDisplay"><?= number_format($subtotal, 2) ?></span></span>
            </div>
            <div class="summary-line">
                <span>Discount (₹):</span>
                <input type="number" step="0.01" name="discount" id="discountInput" value="<?= $discount ?>" style="width: 120px; padding: 6px; text-align: right;" oninput="calculateTotal()">
            </div>
            <div class="summary-line total">
                <span>Grand Total:</span>
                <span>₹ <span id="grandTotalDisplay"><?= number_format($bill['total'], 2) ?></span></span>
            </div>
            
            <div class="summary-line" style="margin-top: 15px;">
                <span>Amount Paid by Customer (₹):</span>
                <input type="number" step="0.01" name="amount_paid" id="amountPaidInput" value="<?= $amount_paid ?>" style="width: 120px; padding: 6px; text-align: right;" oninput="calculateTotal()">
            </div>
            <div class="summary-line dues">
                <span>Pending Dues:</span>
                <span>₹ <span id="duesDisplay"><?= number_format($dues, 2) ?></span></span>
            </div>
        </div>

        <input type="hidden" name="total" id="hiddenTotal" value="<?= $bill['total'] ?>">
        
        <div class="action-buttons">
            <button type="submit" class="btn btn-update">Update Bill</button>
            <a href="<?= $print_target_file ?>?id=<?= $bill_id ?>" class="btn btn-generate" style="text-decoration: none; text-align: center; line-height: normal;">Generate Final Bill & Print</a>
        </div>
    </form>
</div>

<script>
function calculateTotal() {
    let priceInputs = document.querySelectorAll('.price-input');
    let subtotal = 0;
    
    priceInputs.forEach(input => {
        let val = parseFloat(input.value) || 0;
        subtotal += val;
    });

    let discount = parseFloat(document.getElementById('discountInput').value) || 0;
    let grandTotal = subtotal - discount;
    if (grandTotal < 0) grandTotal = 0;

    let amountPaid = parseFloat(document.getElementById('amountPaidInput').value) || 0;
    let dues = grandTotal - amountPaid;
    if (dues < 0) dues = 0;

    document.getElementById('subtotalDisplay').innerText = subtotal.toFixed(2);
    document.getElementById('grandTotalDisplay').innerText = grandTotal.toFixed(2);
    document.getElementById('hiddenTotal').value = grandTotal.toFixed(2);
    document.getElementById('duesDisplay').innerText = dues.toFixed(2);
}

function addServiceRow() {
    let tbody = document.getElementById('servicesTableBody');
    let newRow = document.createElement('tr');
    newRow.className = 'item-row';
    newRow.innerHTML = `
        <td>
            <input type="text" name="service_names[]" placeholder="Service Name" required>
        </td>
        <td>
            <input type="number" step="0.01" name="service_prices[]" value="0.00" class="price-input" required oninput="calculateTotal()">
        </td>
        <td style="text-align: center;">
            <button type="button" class="btn-delete" onclick="removeRow(this)">X</button>
        </td>
    `;
    tbody.appendChild(newRow);
    calculateTotal();
}

function removeRow(btn) {
    let row = btn.closest('tr');
    let tbody = document.getElementById('servicesTableBody');
    if (tbody.rows.length > 1) {
        row.remove();
        calculateTotal();
    } else {
        alert("An invoice must contain at least one service.");
    }
}
</script>

</body>
</html>