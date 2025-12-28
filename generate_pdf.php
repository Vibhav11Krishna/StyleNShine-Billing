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

// build HTML for PDF (professional)
$html = '<!doctype html><html><head><meta charset="utf-8"><style>
body{font-family:DejaVu Sans,Arial;margin:0;padding:18px;color:#111}
.wrap{max-width:700px;margin:0 auto;border:8px solid #d4af37;padding:18px}
h1{margin:0}
.small{font-size:12px;color:#555}
.table{width:100%;border-collapse:collapse;margin-top:12px}
.table th{background:#111;color:#fff;padding:10px;text-align:left}
.table td{padding:10px;border-bottom:1px solid #eee}
.totals{margin-top:12px;display:flex;justify-content:flex-end}
</style></head><body>';
$html .= '<div class="wrap">';
$html .= '<div style="display:flex;align-items:center;gap:12px"><div><h1>Style N Shine</h1><div class="small">Kankarbagh, Patna</div></div><div style="margin-left:auto;text-align:right"><strong>Invoice #'.htmlspecialchars($data['id']).'</strong><div class="small">'.htmlspecialchars($data['created_at']).'</div></div></div>';
$html .= '<div style="margin-top:12px"><strong>Billed To:</strong><div>'.htmlspecialchars($data['customer_name']).'</div><div class="small">'.nl2br(htmlspecialchars($data['customer_address'])).'</div><div class="small">Phone: '.htmlspecialchars($data['customer_phone']).'</div></div>';
$html .= '<table class="table"><thead><tr><th>Service</th><th style="text-align:right">Price (₹)</th></tr></thead><tbody>';
foreach ($rows as $r) {
    $html .= '<tr><td>'.htmlspecialchars($r['label']).'</td><td style="text-align:right">₹ '.$r['price'].'</td></tr>';
}
$html .= '</tbody></table>';
$html .= '<div class="totals"><table><tr><td class="small">Subtotal</td><td style="text-align:right">₹ '.number_format($data['subtotal'],2).'</td></tr>';
$html .= '<tr><td class="small">GST (18%)</td><td style="text-align:right">₹ '.number_format($data['gst'],2).'</td></tr>';
$html .= '<tr><td style="font-weight:800">Total</td><td style="text-align:right;font-weight:800">₹ '.number_format($data['total'],2).'</td></tr></table></div>';
$html .= '<div style="margin-top:18px" class="small">Payment Method: '.htmlspecialchars($data['payment_mode']).'</div>';
$html .= '<div style="margin-top:18px" class="small">Thank you for visiting Style N Shine!</div>';
$html .= '</div></body></html>';

// render PDF
$dompdf = new Dompdf(['isRemoteEnabled' => true]);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream("invoice_".$data['id'].".pdf", ["Attachment" => 0]);
exit;
