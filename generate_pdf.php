<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
require 'config.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) die('Invalid ID');

$stmt = $connection->prepare("SELECT * FROM bills WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$data) die('Bill not found');

// parse services
$rows = [];
if (!empty($data['services'])) {
    $parts = explode(',', $data['services']);
    foreach ($parts as $p) {
        if (trim($p) === '') continue;
        [$lbl, $pr] = array_pad(explode('|', $p), 2, '0.00');
        $rows[] = ['label'=>$lbl, 'price'=>number_format((float)$pr,2)];
    }
}

// build HTML for PDF (Dompdf Compatible using tables instead of Flexbox)
$html = '<!doctype html><html><head><meta charset="utf-8"><style>
body{font-family:DejaVu Sans,Arial;margin:0;padding:10px;color:#111;font-size:14px;}
.wrap{max-width:700px;margin:0 auto;border:6px solid #d4af37;padding:20px;}
h1{margin:0;font-size:24px;color:#003366;}
.small{font-size:12px;color:#555;}
.header-table, .table, .totals-table{width:100%;border-collapse:collapse;}
.header-table td{vertical-align:top;}
.table{margin-top:15px;}
.table th{background:#003366;color:#fff;padding:8px 10px;text-align:left;font-size:13px;}
.table td{padding:8px 10px;border-bottom:1px solid #eee;font-size:13px;}
.totals-container{width:100%;margin-top:15px;}
.totals-table{width:260px;margin-left:auto;}
.totals-table td{padding:5px 8px;font-size:13px;}
.invoice-footer{margin-top:20px;border-top:1px dashed #ccc;padding-top:10px;}
</style></head><body>';

$html .= '<div class="wrap">';

// Header Section using a safe table layout instead of flex
$html .= '<table class="header-table"><tr>';
$html .= '<td><h1>Style N Shine</h1><div class="small">Kankarbagh, Patna</div></td>';
$html .= '<td style="text-align:right;"><strong>Invoice #'.htmlspecialchars($data['id']).'</strong><div class="small">'.htmlspecialchars($data['created_at']).'</div></td>';
$html .= '</tr></table>';

// Customer Details Section
$html .= '<div style="margin-top:15px;background:#f9f9f9;padding:10px;border-radius:4px;">';
$html .= '<strong>Billed To:</strong><div style="font-size:15px;font-weight:bold;margin-top:2px;">'.htmlspecialchars($data['customer_name']).'</div>';
if(!empty($data['customer_address'])) {
    $html .= '<div class="small">'.nl2br(htmlspecialchars($data['customer_address'])).'</div>';
}
$html .= '<div class="small">Phone: '.htmlspecialchars($data['customer_phone']).'</div>';
$html .= '</div>';

// Services Table
$html .= '<table class="table"><thead><tr><th>Service Description</th><th style="text-align:right">Price (₹)</th></tr></thead><tbody>';
foreach ($rows as $r) {
    $html .= '<tr><td>'.htmlspecialchars($r['label']).'</td><td style="text-align:right">₹ '.$r['price'].'</td></tr>';
}
$html .= '</tbody></table>';

// Totals Section using a right-aligned table container
$html .= '<div class="totals-container"><table class="totals-table">';
$html .= '<tr><td class="small">Subtotal</td><td style="text-align:right">₹ '.number_format($data['subtotal'],2).'</td></tr>';
$html .= '<tr><td class="small">GST (18%)</td><td style="text-align:right">₹ '.number_format($data['gst'],2).'</td></tr>';
$html .= '<tr><td style="font-weight:bold;border-top:1px solid #333;">Total</td><td style="text-align:right;font-weight:bold;border-top:1px solid #333;">₹ '.number_format($data['total'],2).'</td></tr>';
$html .= '</table></div>';

// Footer Info
$html .= '<div class="invoice-footer">';
$html .= '<div class="small"><strong>Payment Method:</strong> '.htmlspecialchars($data['payment_mode']).'</div>';
$html .= '<div class="small" style="margin-top:5px;">Thank you for visiting Style N Shine!</div>';
$html .= '</div>';

$html .= '</div></body></html>';

// render PDF
$dompdf = new Dompdf(['isRemoteEnabled' => true]);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream("invoice_".$data['id'].".pdf", ["Attachment" => 0]);
exit;