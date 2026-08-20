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
            $str [] = ($number < 21) ? $words[(int) $number].' '. $digits[$counter]. $plural.' '.$hundred:$words[(int) (floor($number / 10) * 10)].' '.$words[(int) ($number % 10)]. ' '.$digits[$counter].$plural.' '.$hundred;
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
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #eaeaea;
            position: relative;
            overflow: hidden;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Top Accent Bar */
        #invoiceCapture::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: #003366;
        }

        /* Background Glowing Logo Watermark */
        #invoiceCapture::before {
            content: "";
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 340px;
            height: 340px;
            background: url('assets/logo.png') no-repeat center center;
            background-size: contain;
            opacity: 0.04;
            filter: drop-shadow(0 0 15px rgba(0, 51, 102, 0.4));
            z-index: 0;
            pointer-events: none;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .invoice-content {
            position: relative;
            z-index: 1;
        }

        .logo-container { text-align: center; margin-bottom: 5px; }
        .logo-container img { max-width: 90px; }
        .invoice-header { text-align: center; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 25px; }
        .brand h1 { margin: 5px 0 2px 0; color: #003366; font-size: 24px; letter-spacing: 0.5px; text-transform: uppercase; }
        .salon-info { color: #666; font-size: 11px; line-height: 1.4; }
        
        .bill-meta { 
            display: flex; 
            justify-content: space-between; 
            background: #f8fafc; 
            padding: 15px; 
            border-radius: 6px; 
            margin-bottom: 25px; 
            font-size: 13px; 
            line-height: 1.6;
            border: 1px solid #edf2f7;
        }

        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table th { background: #003366 !important; color: #fff !important; padding: 10px 12px; text-align: left; font-size: 13px; }
        table td { padding: 10px 12px; border-bottom: 1px solid #f0f0f0; font-size: 13px; color: #333; }
        
        .total-row td { 
            font-weight: bold; 
            font-size: 16px; 
            color: #003366; 
            background: #f8fafc !important; 
            border-top: 2px solid #003366; 
            border-bottom: none;
            padding: 12px;
        }
        
        .amt-words { 
            font-size: 12px; 
            font-style: italic; 
            color: #555; 
            background: #fdfdfd;
            padding: 8px 12px;
            border-left: 3px solid #003366;
            margin-bottom: 30px; 
        }

        /* Thank you & Offer Box */
        .promo-footer {
            text-align: center;
            background: #f4f7fa;
            border: 1px dashed #cbd5e1;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 25px;
        }
        .promo-footer h4 { margin: 0 0 4px 0; color: #003366; font-size: 13px; }
        .promo-footer p { margin: 0; color: #555; font-size: 11px; }

        .signature-section { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 20px; }
        .badge-paid { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 11px; text-transform: uppercase; display: inline-block; }
        .sig-box { text-align: right; }
        .sig-line { border-top: 1px solid #333; width: 160px; margin-top: 40px; display: inline-block; }
        
        .btn-area { text-align: center; margin: 20px; padding-bottom: 40px; }
        .btn { padding: 12px 25px; border-radius: 5px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; margin: 5px; border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: 0.2s; }
        .btn:hover { opacity: 0.9; }
        .btn-wa { background: #25D366; color: #fff; }
        .btn-print { background: #003366; color: #fff; }
        
        @media print { 
            body { background: #fff; }
            .btn-area { display: none; }
            #invoiceCapture { border: none; margin: 0; padding: 15px; width: 100%; max-width: 100%; box-shadow: none; }
        }
    </style>
</head>
<body>

<div id="invoiceCapture">
    <div class="invoice-content">
        <div class="logo-container"><img src="assets/logo.png" alt="Logo"></div>
        <div class="invoice-header">
            <div class="brand"><h1>Style N Shine</h1></div>
            <div class="salon-info"><?= $salon_address ?> | Ph: +91 9876543210</div>
        </div>

        <div class="bill-meta">
            <div>
                <strong style="color:#003366;">BILLED TO:</strong><br>
                <span style="font-size: 15px; font-weight: bold; color:#111;"><?= htmlspecialchars($bill['customer_name']) ?></span><br>
                Phone: <?= htmlspecialchars($bill['customer_phone']) ?><br>
                <?php if(!empty($bill['customer_address'])): ?>
                    Address: <?= nl2br(htmlspecialchars($bill['customer_address'])) ?>
                <?php endif; ?>
            </div>
            <div style="text-align: right;">
                <strong>INVOICE:</strong> #<?= $invoice_no ?><br>
                <strong>DATE:</strong> <?= date("d-M-Y", strtotime($bill['created_at'])) ?><br>
                <span class="badge-paid">PAID (<?= $bill['payment_mode'] ?>)</span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Service Description</th>
                    <th style="text-align:right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $services = explode(",", $bill['services']);
                foreach($services as $s){
                    $parts = explode(":", $s); 
                    if(count($parts) > 1) {
                        $details = explode("|", $parts[1]);
                    } else {
                        $details = explode("|", $parts[0]);
                    }
                    echo "<tr><td>".trim($details[0])."</td><td style='text-align:right;'>₹".number_format(trim($details[1] ?? 0), 2)."</td></tr>";
                }
                ?>
                <tr class="total-row">
                    <td>GRAND TOTAL</td>
                    <td style="text-align:right;">₹<?= number_format($bill['total'], 2) ?></td>
                </tr>
            </tbody>
        </table>

        <div class="amt-words">
            <strong>Amount in words:</strong> <?= getAmountInWords($bill['total']) ?>
        </div>

        <!-- Extra Professional Addition: Special Thank You / Offer Note -->
        <div class="promo-footer">
            <h4>Thank you for choosing Style N Shine! ✨</h4>
        </div>

        <div class="signature-section">
            <div style="font-size: 11px; color: #777;">
                Terms & Conditions:<br>
                1. Services once rendered are non-refundable.<br>
                2. Please keep this invoice for future reference.
            </div>
            <div class="sig-box">
                <div class="sig-line"></div><br>
                <strong style="font-size: 12px; color: #003366;">Authorized Signatory</strong>
            </div>
        </div>
    </div>
</div>

<div class="btn-area">
    <button class="btn btn-print" onclick="window.print()">Print PDF</button>
    <button class="btn btn-wa" onclick="copyAndOpenWhatsApp()">Send to WhatsApp 📱</button>
</div>

<script>
async function copyAndOpenWhatsApp() {
    const element = document.getElementById('invoiceCapture');
    const btn = document.querySelector('.btn-wa');
    btn.innerText = "Copying Invoice...";
    
    try {
        const canvas = await html2canvas(element, { backgroundColor: "#ffffff", scale: 2, useCORS: true });
        canvas.toBlob(async (blob) => {
            try {
                const item = new ClipboardItem({ "image/png": blob });
                await navigator.clipboard.write([item]);
                
                btn.innerText = "Send to WhatsApp 📱";
                
                const phoneNumber = "<?= $clean_phone ?>";
                const message = encodeURIComponent("Hello <?= htmlspecialchars($bill['customer_name']) ?>! Thank you for visiting Style N Shine. Here is your bill #<?= $invoice_no ?>.");
                
                let waUrl = `https://wa.me/${phoneNumber}?text=${message}`;
                window.open(waUrl, "_blank");
                
                alert("Invoice copied! WhatsApp chat opened with the customer's number. Press Ctrl+V in the chat to paste and send the image.");
            } catch (clipErr) {
                btn.innerText = "Send to WhatsApp 📱";
                window.open("https://wa.me/<?= $clean_phone ?>", "?text=" + encodeURIComponent("Hello! Here is your bill #<?= $invoice_no ?> from Style N Shine."));
                alert("Opened WhatsApp chat, but direct image writing failed. Ensure you are running via localhost or HTTPS.");
            }
        });
    } catch (err) { 
        btn.innerText = "Send to WhatsApp 📱";
        alert("Error generating invoice image. Make sure you are running via localhost or HTTPS.");
    }
}
</script>
</body>
</html>