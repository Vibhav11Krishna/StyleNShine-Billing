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

$total = floatval($bill['total'] ?? 0);
$amount_paid = floatval($bill['amount_paid'] ?? $total); // Fallback to total if old record
$dues = floatval($bill['dues'] ?? 0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Parlour Invoice #<?= $invoice_no ?> - Style N Shine</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body { 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; 
            background: #f1f5f9; 
            margin: 0; 
            padding: 20px; 
        }

        #invoiceCapture {
            max-width: 680px;
            margin: 20px auto;
            padding: 40px;
            background: linear-gradient(135deg, #ffffff 0%, #fcfdfe 100%);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 51, 102, 0.08), 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        #invoiceCapture::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #003366, #3b82f6, #003366);
        }

        #invoiceCapture::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 480px;
            height: 480px;
            background: url('assets/logo.png') no-repeat center center;
            background-size: contain;
            opacity: 0.085;
            filter: grayscale(0%) contrast(140%) brightness(110%);
            z-index: 0;
            pointer-events: none;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .invoice-content {
            position: relative;
            z-index: 7;
        }

        .invoice-header-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 18px;
            margin-bottom: 22px;
        }
        .side-img {
            width: 65px;
            height: 85px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 2px;
            background: #ffffff;
            box-shadow: 0 3px 8px rgba(0,0,0,0.06);
        }
        .header-center {
            text-align: center;
            flex-grow: 1;
            padding: 0 15px;
        }
        .main-logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 4px;
        }
        .brand h1 { 
            margin: 0; 
            color: #003366; 
            font-size: 32px; 
            letter-spacing: 1px; 
            text-transform: uppercase; 
            font-weight: 800; 
        }
        .salon-info { 
            color: #64748b; 
            font-size: 11.5px; 
            line-height: 1.4; 
            margin-top: 4px; 
            font-weight: 500;
        }

        .bill-meta { 
            display: flex; 
            justify-content: space-between; 
            background: rgba(248, 250, 252, 0.9); 
            backdrop-filter: blur(4px);
            padding: 16px; 
            border-radius: 10px; 
            margin-bottom: 22px; 
            font-size: 13px; 
            line-height: 1.6;
            border: 1px solid #e2e8f0;
        }

        table { width: 100%; border-collapse: collapse; margin-bottom: 18px; border-radius: 8px; overflow: hidden; }
        table th { background: #003366 !important; color: #fff !important; padding: 12px 14px; text-align: left; font-size: 13px; font-weight: 600; letter-spacing: 0.3px; }
        table td { padding: 11px 14px; border-bottom: 1px solid #f1f5f9; font-size: 13px; color: #334155; }

        .subtotal-row td, .discount-row td {
            font-size: 13px;
            color: #64748b;
            background: #f8fafc !important;
            border-bottom: 1px solid #f1f5f9;
        }

        .total-row td { 
            font-weight: bold; 
            font-size: 15px; 
            color: #003366; 
            background: #f1f5f9 !important; 
            border-top: 2px solid #003366; 
            border-bottom: none;
            padding: 12px 14px;
        }

        .payment-summary-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 18px;
            font-size: 13px;
        }
        .pay-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            color: #475569;
        }
        .pay-line:last-child {
            margin-bottom: 0;
        }
        .dues-highlight {
            font-weight: bold;
            color: #c62828 !important;
        }

        .amt-words { 
            font-size: 12px; 
            font-style: italic; 
            color: #475569; 
            background: #f8fafc;
            padding: 11px 14px;
            border-left: 4px solid #003366;
            border-radius: 0 8px 8px 0;
            margin-bottom: 22px; 
            border-top: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .promo-footer {
            text-align: center;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px dashed #cbd5e1;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 22px;
        }
        .promo-footer h4 { margin: 0; color: #003366; font-size: 13px; font-weight: 600; }

        .signature-section { 
            display: flex; 
            justify-content: flex-end; 
            align-items: flex-end; 
            margin-top: 30px;
        }
        .sig-box { 
            text-align: right; 
            flex-shrink: 0;
            padding-top: 10px;
            width: 160px;
        }
        .auth-sign-img {
            height: 80px;
            max-width: 180px;
            object-fit: contain;
            margin-bottom: 2px;
            display: block;
            margin-left: auto;
        }
        .sig-line { border-top: 1.5px solid #64748b; width: 100%; margin-top: 4px; }

        .badge-paid { background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 6px; font-weight: bold; font-size: 10.5px; text-transform: uppercase; display: inline-block; letter-spacing: 0.5px; border: 1px solid #bbf7d0; }
        .badge-due { background: #ffebee; color: #c62828; padding: 4px 10px; border-radius: 6px; font-weight: bold; font-size: 10.5px; text-transform: uppercase; display: inline-block; letter-spacing: 0.5px; border: 1px solid #ffcdd2; }

        .btn-area { text-align: center; margin: 30px; padding-bottom: 40px; }
        .btn { padding: 12px 28px; border-radius: 8px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; margin: 6px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.2s ease; font-size: 14px; }
        .btn:hover { opacity: 0.95; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.12); }
        .btn-wa { background: #25D366; color: #fff; }
        .btn-print { background: #003366; color: #fff; }

        @media print { 
            body { background: #fff; padding: 0; }
            .btn-area, .btn { display: none !important; }
            #invoiceCapture { border: none; margin: 0; padding: 15px; width: 100%; max-width: 100%; box-shadow: none; }
        }
    </style>
</head>
<body>

<div id="invoiceCapture">
    <div class="invoice-content">
        <!-- Header with Parlour Side Images -->
        <div class="invoice-header-wrapper">
            <img src="./assets/parlour_left.png" alt="Parlour Left" class="side-img" onerror="this.style.display='none';">

            <div class="header-center">
                <img src="assets/logo.png" alt="Main Logo" class="main-logo">
                <div class="brand">
                    <h1>Style N Shine Studio</h1>
                </div>
                <div class="salon-info"><?= $salon_address ?> | Ph: +91 9876543210</div>
            </div>

            <img src="./assets/parlour_right.png" alt="Parlour Right" class="side-img" onerror="this.style.display='none';">
        </div>

        <div class="bill-meta">
            <div>
                <strong style="color:#003366; font-size: 11.5px; letter-spacing: 0.5px;">BILLED TO:</strong><br>
                <span style="font-size: 15px; font-weight: bold; color:#0f172a;"><?= htmlspecialchars($bill['customer_name']) ?></span><br>
                <span style="font-size: 12px; color: #475569;">Phone: <?= htmlspecialchars($bill['customer_phone']) ?></span>
                <?php if(!empty($bill['customer_address'])): ?>
                    <br><span style="font-size: 12px; color: #475569;">Address: <?= nl2br(htmlspecialchars($bill['customer_address'])) ?></span>
                <?php endif; ?>
            </div>
            <div style="text-align: right;">
                <span style="font-size: 12px; color: #475569;"><strong>INVOICE:</strong> #<?= $invoice_no ?></span><br>
                <span style="font-size: 12px; color: #475569;"><strong>DATE:</strong> <?= date("d-M-Y", strtotime($bill['created_at'])) ?></span><br>
                <span style="font-size: 12px; color: #475569;"><strong>TYPE:</strong> Beauty Parlour</span><br>
                <div style="margin-top: 4px;">
                    <?php if ($dues > 0): ?>
                        <span class="badge-due">DUE: ₹<?= number_format($dues, 2) ?></span>
                    <?php else: ?>
                        <span class="badge-paid">PAID (<?= htmlspecialchars($bill['payment_mode']) ?>)</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Salon Service & Treatment Description</th>
                    <th style="text-align:right;">Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
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
                    $sPrice = floatval(trim($details[1] ?? 0));
                    $subtotal += $sPrice;
                    echo "<tr><td>".trim($details[0])."</td><td style='text-align:right;'>".number_format($sPrice, 2)."</td></tr>";
                }

                $discount = isset($bill['discount']) ? floatval($bill['discount']) : 0.00;
                ?>

                <tr class="subtotal-row">
                    <td>Subtotal</td>
                    <td style="text-align:right;"><?= number_format($subtotal, 2) ?></td>
                </tr>

                <?php if ($discount > 0): ?>
                <tr class="discount-row">
                    <td>Discount Applied</td>
                    <td style="text-align:right; color: #15803d; font-weight: 500;">- <?= number_format($discount, 2) ?></td>
                </tr>
                <?php endif; ?>

                <tr class="total-row">
                    <td>GRAND TOTAL</td>
                    <td style="text-align:right;">₹<?= number_format($total, 2) ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Breakdown Summary Box -->
        <div class="payment-summary-box">
            <div class="pay-line">
                <span>Amount Paid (<?= htmlspecialchars($bill['payment_mode']) ?>):</span>
                <span><strong>₹<?= number_format($amount_paid, 2) ?></strong></span>
            </div>
            <div class="pay-line">
                <span>Pending Dues:</span>
                <span class="dues-highlight">₹<?= number_format($dues, 2) ?></span>
            </div>
        </div>

        <div class="amt-words">
            <strong>Amount in words:</strong> <?= getAmountInWords($total) ?>
        </div>

        <div class="promo-footer">
            <h4>Thank you for choosing Style N Shine Beauty Salon! ✨ Pamper yourself again soon.</h4>
        </div>

        <!-- Authorized Signature Section -->
        <div class="signature-section">
            <div class="sig-box">
                <img src="assets/signature.png" alt="Authorized Signature" class="auth-sign-img" onerror="this.style.display='none';">
                <div class="sig-line"></div>
                <strong style="font-size: 10px; color: #003366; letter-spacing: 0.3px; display: block; margin-top: 2px;">Authorized Signatory</strong>
            </div>
        </div>
    </div>
</div>

<div class="btn-area">
    <a href="index.php" class="btn" style="background-color: #64748b; color: white; text-decoration: none;">&larr; New Bill</a>
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
                const duesAmount = <?= $dues ?>;
                let duesText = duesAmount > 0 ? " Your pending balance is ₹" + duesAmount.toFixed(2) + "." : " Your bill is fully paid.";
                const message = encodeURIComponent("Hello <?= htmlspecialchars($bill['customer_name']) ?>! Thank you for visiting Style N Shine Parlour. Here is your invoice #<?= $invoice_no ?>." + duesText);

                let waUrl = `https://wa.me/${phoneNumber}?text=${message}`;
                window.open(waUrl, "_blank");

                alert("Invoice copied! WhatsApp chat opened with the customer's number. Press Ctrl+V in the chat to paste and send the image.");
            } catch (clipErr) {
                btn.innerText = "Send to WhatsApp 📱";
                window.open("https://wa.me/<?= $clean_phone ?>?text=" + encodeURIComponent("Hello! Here is your bill #<?= $invoice_no ?> from Style N Shine."));
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