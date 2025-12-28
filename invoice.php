<?php
require 'config.php';
$bill_id = intval($_GET['id'] ?? 0);
$stmt = $connection->prepare("SELECT * FROM bills WHERE id=?");
$stmt->bind_param("i",$bill_id);
$stmt->execute();
$bill = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$bill) { die("Invoice not found."); }

// --- Function to convert Number to Words ---
function getAmountInWords($number) {
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . ' Only';
}

$invoice_no = str_pad($bill_id, 4, '0', STR_PAD_LEFT);
$clean_phone = preg_replace('/[^0-9]/', '', $bill['customer_phone']);
if (strlen($clean_phone) == 10) { $clean_phone = "91" . $clean_phone; }

$salon_address = "G-01, Rana Residency, E Boring Canal Rd, Patna, Bihar 800001";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #<?= $bill_id ?> - Style N Shine</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f7fa; margin: 0; padding: 0; }
        #invoiceCapture {
            max-width: 600px;
            margin: 30px auto;
            padding: 40px;
            background: #fff;
            border: 1px solid #ddd;
        }
        .logo-container { text-align: center; margin-bottom: 5px; }
        .logo-container img { max-width: 100px; }
        .invoice-header { text-align: center; border-bottom: 2px solid #003366; padding-bottom: 15px; margin-bottom: 30px; }
        .brand h1 { margin: 5px 0; color: #003366; font-size: 26px; text-transform: uppercase; }
        .salon-info { color: #555; font-size: 12px; }
        .bill-meta { display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 14px; line-height: 1.5; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        table th { background: #003366; color: #fff; padding: 12px; text-align: left; }
        table td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        .cat-row { background: #f1f4f8; font-weight: bold; color: #003366; font-size: 12px; text-transform: uppercase; }
        .total-row td { font-weight: bold; font-size: 20px; color: #003366; background: #f9f9f9; border-top: 2px solid #003366; }
        
        /* New Styles */
        .amt-words { font-size: 12px; font-style: italic; color: #555; margin-bottom: 40px; }
        .signature-section { text-align: right; margin-top: 30px; }
        .sig-line { border-top: 1px solid #333; display: inline-block; width: 200px; margin-top: 50px; }
        
        .btn-area { text-align: center; margin: 20px; padding-bottom: 40px; }
        .btn { padding: 12px 25px; border-radius: 5px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; margin: 5px; border: none; }
        .btn-wa { background: #25D366; color: #fff; }
        .btn-print { background: #003366; color: #fff; }
        @media print { .btn-area { display: none; } }
    </style>
</head>
<body>

<div id="invoiceCapture">
    <div class="logo-container"><img src="assets/logo.png" alt="Logo"></div>
    <div class="invoice-header">
        <div class="brand"><h1>Style N Shine</h1></div>
        <div class="salon-info"><?= $salon_address ?></div>
    </div>

    <div class="bill-meta">
        <div>
            <strong style="color:#003366;">BILL TO:</strong><br>
            <span style="font-size: 16px; font-weight: bold;"><?= htmlspecialchars($bill['customer_name']) ?></span><br>
            Phone: <?= htmlspecialchars($bill['customer_phone']) ?><br>
            <?php if(!empty($bill['customer_address'])): ?>
                Address: <?= nl2br(htmlspecialchars($bill['customer_address'])) ?>
            <?php endif; ?>
        </div>
        <div style="text-align: right;">
            <strong>INVOICE:</strong> #<?= $invoice_no ?><br>
            <strong>DATE:</strong> <?= date("d-M-Y", strtotime($bill['created_at'])) ?><br>
            <strong>STATUS:</strong> PAID (<?= $bill['payment_mode'] ?>)
        </div>
    </div>

    <table>
        <thead><tr><th>Service Description</th><th style="text-align:right;">Amount</th></tr></thead>
        <tbody>
            <?php
            $services = explode(",", $bill['services']);
            $last_category = "";
            foreach($services as $s){
                $parts = explode(":", $s); 
                if(count($parts) > 1) {
                    $category = trim($parts[0]);
                    $details = explode("|", $parts[1]);
                } else {
                    $category = "General";
                    $details = explode("|", $parts[0]);
                }
                
                if($category !== $last_category) {
                    echo "<tr class='cat-row'><td colspan='2'>$category</td></tr>";
                    $last_category = $category;
                }
                echo "<tr><td style='padding-left:25px;'>".trim($details[0])."</td><td style='text-align:right;'>₹".number_format(trim($details[1] ?? 0), 2)."</td></tr>";
            }
            ?>
            <tr class="total-row"><td>GRAND TOTAL</td><td style="text-align:right;">₹<?= number_format($bill['total'], 2) ?></td></tr>
        </tbody>
    </table>

    <div class="amt-words">
        <strong>Amount in words:</strong> <?= getAmountInWords($bill['total']) ?>
    </div>

    <div class="signature-section">
        <div class="sig-line"></div><br>
        <strong>Authorized Signatory</strong>
    </div>
</div>

<div class="btn-area">
    <button class="btn btn-print" onclick="window.print()">Print PDF</button>
    <button class="btn btn-wa" onclick="copyAndOpenWhatsApp()">Send to WhatsApp </button>
</div>

<script>
async function copyAndOpenWhatsApp() {
    const element = document.getElementById('invoiceCapture');
    const btn = document.querySelector('.btn-wa');
    btn.innerText = "Copying...";
    try {
        const canvas = await html2canvas(element, { backgroundColor: "#ffffff", scale: 2 });
        canvas.toBlob(async (blob) => {
            const item = new ClipboardItem({ "image/png": blob });
            await navigator.clipboard.write([item]);
            window.open("https://web.whatsapp.com/send?phone=<?= $clean_phone ?>&text=" + encodeURIComponent("Hello! Here is your bill from Style N Shine."), "_blank");
            btn.innerText = "Send to WhatsApp ";
            alert("Copied! Paste (Ctrl+V) in WhatsApp.");
        });
    } catch (err) { 
        btn.innerText = "Send to WhatsApp ";
        alert("Error copying image. Make sure you are using HTTPS.");
    }
}
</script>
</body>
</html>