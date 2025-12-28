<?php
require 'config.php';

/* ---------- HANDLE DELETE REQUEST ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $del = $connection->prepare("DELETE FROM bills WHERE id = ?");
    $del->bind_param("i", $delete_id);
    if ($del->execute()) {
        $msg = "Bill #$delete_id deleted successfully.";
    } else {
        $msg = "Failed to delete bill.";
    }
    $del->close();
}

/* ---------- FILTER & FETCH RECORDS ---------- */
$month = $_GET['month'] ?? '';
$search = trim($_GET['q'] ?? '');

$where = [];
$params = [];
$types   = '';

if ($month !== '') {
    $where[] = "DATE_FORMAT(created_at,'%Y-%m') = ?";
    $params[] = $month;
    $types   .= 's';
}

if ($search !== '') {
    $where[] = "(customer_name LIKE CONCAT('%',?,'%')
            OR customer_phone LIKE CONCAT('%',?,'%')
            OR services LIKE CONCAT('%',?,'%'))";
    $params[] = $search; 
    $params[] = $search; 
    $params[] = $search;
    $types   .= 'sss';
}

$sql = "SELECT * FROM bills";
if ($where) $sql .= " WHERE " . implode(" AND ", $where);
$sql .= " ORDER BY created_at DESC";

$stmt = $connection->prepare($sql);
if ($params) $stmt->bind_param($types, ...$params);
$stmt->execute();

$res  = $stmt->get_result();
$rows = $res->fetch_all(MYSQLI_ASSOC);

$stmt->close();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Style N Shine — View Bills</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f7fa;
    margin: 0;
    padding: 20px;
    color: #333;
}

/* NEW LOGO & BACK BUTTON SECTION */
.top-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto 20px auto;
}
.top-nav img {
    max-width: 80px;
}
.back-link {
    text-decoration: none;
    background: #003366;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: bold;
    font-size: 14px;
    display: flex;
    align-items: center;
}
.back-link:hover {
    background: #0059b3;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
h2 {
    text-align: center;
    color: #003366;
    margin-bottom: 20px;
    margin-top: 0;
}
form {
    display: flex;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}
input[type="month"], input[type="text"] {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
}
.btn, button {
    padding: 8px 14px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-weight: bold;
}
.btn { background: #003366; color: #fff; text-decoration: none; display: inline-block; font-size: 14px; }
.btn-clear { background: #fff; color: #003366; border: 2px solid #003366; }

.delete-btn { background:#cc0000; color:#fff; border:none; padding:6px 10px; border-radius:6px; cursor:pointer; }
.delete-btn:hover{ background:#ff3333; }

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    text-align: left;
}
table th, table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}
table th {
    background: #003366;
    color: #fff;
}
table tr:nth-child(even) {
    background: #f9f9f9;
}
.msg {
    text-align: center;
    font-weight: bold;
    color: #28a745;
    margin-bottom: 15px;
    padding: 10px;
    background: #e8f5e9;
    border-radius: 6px;
}
/* ---------- TABLETS ---------- */
@media (max-width: 1024px) {

  body {
    padding: 12px;
  }

  .container {
    padding: 18px;
  }

  form {
    gap: 6px;
  }
}


/* ---------- MOBILE — STRUCTURED UI ---------- */
@media (max-width: 768px) {

  body {
    padding: 10px;
    background: #ffffff;
  }

  /* Top Navigation */
  .top-nav {
    width: 100%;
    flex-direction: column;
    gap: 12px;
    align-items: center;
  }

  .top-nav img {
    max-width: 72px;
  }

  .back-link {
    width: 100%;
    justify-content: center;
    padding: 12px;
    border-radius: 10px;
    font-size: 13px;
    letter-spacing: .3px;
  }

  /* Container */
  .container {
    padding: 16px;
    border-radius: 14px;
  }

  h2 {
    font-size: 17px;
    margin-top: 4px;
    margin-bottom: 14px;
    font-weight: 700;
    letter-spacing: .4px;
  }

  /* Section Wrapper */
  .section-block {
    background: #f5f7ff;
    border: 1px solid #d8e0f3;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 14px;
  }

  .section-title {
    font-size: 13px;
    font-weight: 800;
    color: #003366;
    margin-bottom: 6px;
    letter-spacing: .4px;
  }

  /* Filters / Form */
  form {
    flex-direction: column;
    width: 100%;
    gap: 10px;
  }

  input[type="month"],
  input[type="text"] {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    font-size: 13px;
    border: 1px solid #bfc8dd;
    background: #ffffff;
  }

  .btn,
  button,
  .btn-clear {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-align: center;
  }

  /* Status Message */
  .msg {
    font-size: 13px;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 12px;
  }

  /* ---------- TABLE → CARD VIEW ---------- */
  table {
    border: 0;
    margin-top: 4px;
  }

  thead {
    display: none;
  }

  table tr {
    display: flex;
    flex-direction: column;
    gap: 6px;
    background: #f7f9ff;
    border: 1px solid #d9e1f4;
    border-radius: 14px;
    padding: 12px;
    margin-bottom: 12px;
  }

  table td {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    padding: 4px 2px;
    border: none;
  }

  table td::before {
    content: attr(data-label);
    font-weight: 800;
    color: #003366;
    margin-right: 10px;
  }

  /* Action Button */
  .delete-btn {
    width: 100%;
    padding: 10px;
    margin-top: 4px;
    font-size: 13px;
    border-radius: 10px;
  }
}


/* ---------- VERY SMALL PHONES ---------- */
@media (max-width: 420px) {

  h2 {
    font-size: 16px;
  }

  .top-nav img {
    max-width: 62px;
  }

  table td {
    font-size: 12px;
  }

  .btn,
  button {
    font-size: 12px;
  }
}

</style>
</head>

<body>

<div class="top-nav">
    <img src="assets/logo.png" alt="Style N Shine Logo">
    <a href="index.php" class="back-link">← Back to Billing</a>
</div>

<div class="container">

  <h2>All Bill Records</h2>

  <?php if (!empty($msg)): ?>
    <div class="msg"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <form method="get">
    <input type="month" name="month" value="<?=htmlspecialchars($month)?>">
    <input type="text" name="q" placeholder="Search customer/phone..." value="<?=htmlspecialchars($search)?>">
    <button class="btn" type="submit">Filter</button>
    <a class="btn btn-clear" href="view_bills.php">Reset</a>
  </form>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Customer</th>
        <th>Phone</th>
        <th>Services</th>
        <th>Total</th>
        <th>Invoice</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
      <?php if(empty($rows)): ?>
        <tr><td colspan="8" style="text-align:center;">No records found.</td></tr>
      <?php else: ?>
          <?php foreach($rows as $r): ?>
          <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars(date("d M Y", strtotime($r['created_at']))) ?></td>
            <td><?= htmlspecialchars($r['customer_name']) ?></td>
            <td><?= htmlspecialchars($r['customer_phone']) ?></td>
            <td style="max-width:250px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                <?php
                    $services_list = explode(",", $r['services']);
                    $service_names = [];
                    foreach($services_list as $s){
                        $parts = explode("|", $s);
                        $service_names[] = $parts[0];
                    }
                    echo htmlspecialchars(implode(", ", $service_names));
                ?>
            </td>
            <td><strong>₹<?= number_format($r['total'], 2) ?></strong></td>
            <td><a class="btn" href="invoice.php?id=<?= $r['id'] ?>">View</a></td>
            <td>
              <form method="post" onsubmit="return confirm('Delete permanently?');" style="margin:0;">
                <input type="hidden" name="delete_id" value="<?= $r['id'] ?>">
                <button class="delete-btn" type="submit">Delete</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

</div>
</body>
</html>