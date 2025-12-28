<?php
require 'config.php';
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Style N Shine — Professional Billing</title>
  <style>
    :root {
      --primary: #003366;
      --accent: #28a745;
      --bg: #f4f7fa;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: var(--bg);
      margin: 0;
      padding: 0;
      color: #333;
    }

    .header {
      display: flex;
      align-items: center;
      padding: 10px 40px;
      background: var(--primary);
      color: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .header h1 {
      margin: 0;
      font-size: 22px;
      letter-spacing: 1px;
      flex-grow: 1;
    }

    .nav-links a {
      color: #fff;
      text-decoration: none;
      margin-left: 20px;
      font-size: 14px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 5px 12px;
      border-radius: 4px;
    }

    .container {
      max-width: 1300px;
      margin: 20px auto;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    }

    .cust-meta {
      display: flex;
      gap: 20px;
      margin-bottom: 25px;
      background: #f9f9f9;
      padding: 15px;
      border-radius: 8px;
      border-left: 5px solid var(--primary);
    }

    .cust-meta input {
      flex: 1;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 5px;
      outline: none;
    }

    .billing-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .category-card {
      border: 1px solid #e0e6ed;
      border-radius: 8px;
      overflow: hidden;
      background: #fff;
      margin-bottom: 10px;
    }

    .category-card h3 {
      background: #eef2f7;
      color: var(--primary);
      margin: 0;
      padding: 10px 15px;
      font-size: 14px;
      text-transform: uppercase;
      border-bottom: 1px solid #e0e6ed;
    }

    .item-list {
      padding: 10px;
      max-height: 400px;
      overflow-y: auto;
    }

    .row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 7px 0;
      border-bottom: 1px solid #f1f1f1;
      font-size: 13px;
    }

    .row label {
      display: flex;
      align-items: center;
      cursor: pointer;
      flex: 1;
    }

    .row input {
      margin-right: 10px;
      width: 16px;
      height: 16px;
    }

    .price-label {
      font-weight: bold;
      color: #555;
      min-width: 70px;
      text-align: right;
    }

    .footer-bar {
      position: sticky;
      bottom: 20px;
      margin-top: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background: #003366;
      color: white;
      border-radius: 10px;
      box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2);
    }

    .pay-mode select {
      padding: 10px;
      border-radius: 5px;
      border: none;
      width: 200px;
      font-weight: bold;
    }

    .total-display {
      text-align: right;
    }

    .total-display h2 {
      margin: 0;
      font-size: 36px;
    }

    .btn-submit {
      background: var(--accent);
      color: white;
      border: none;
      padding: 15px 40px;
      border-radius: 6px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-submit:hover {
      background: #218838;
      transform: translateY(-2px);
    }

    /* Tablets */
@media (max-width: 1000px) {

  .billing-grid {
    grid-template-columns: 1fr 1fr;
  }

  .cust-meta {
    flex-direction: column;
  }

  .cust-meta input {
    width: 100%;
  }
}


/* Mobile — Structured Layout */
@media (max-width: 700px) {

  body {
    background: #ffffff;
  }

  .container {
    margin: 10px;
    padding: 14px;
    border-radius: 14px;
  }

  /* ---------- HEADER STRUCTURE ---------- */
  .header {
    padding: 12px 14px;
    flex-wrap: wrap;
  }

  .header h1 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 6px;
  }

  .nav-links {
    width: 100%;
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .nav-links a {
    flex: 1;
    text-align: center;
    padding: 6px 0;
    border-radius: 6px;
    font-size: 13px;
  }


  /* ---------- SECTION HEADINGS ---------- */
  .section-title {
    font-size: 15px;
    font-weight: 700;
    margin: 8px 0;
    color: #003366;
    letter-spacing: .5px;
  }


  /* ---------- CUSTOMER BLOCK ---------- */
  .cust-meta {
    flex-direction: column;
    gap: 10px;
    padding: 12px;
    border-radius: 10px;
  }

  .cust-meta input {
    padding: 12px;
    font-size: 14px;
  }


  /* ---------- BILLING GRID STRUCTURE ---------- */
  .billing-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .category-card {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #dde3ed;
  }

  /* Sticky category headings */
  .category-card h3 {
    position: sticky;
    top: 0;
    background: #eef3ff;
    padding: 10px;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: .4px;
  }

  .item-list {
    max-height: 320px;
    padding: 10px;
  }


  /* ---------- ROW STRUCTURE ---------- */
  .row {
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
    padding: 8px 0;
  }

  .row label {
    font-size: 14px;
    line-height: 1.3;
  }

  .row input {
    width: 18px;
    height: 18px;
    margin-right: 10px;
  }

  .price-label {
    font-size: 14px;
    font-weight: 700;
  }


  /* ---------- FOOTER — MOBILE BILLING BAR ---------- */
  .footer-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;

    border-radius: 14px 14px 0 0;
    padding: 14px;

    flex-direction: column;
    gap: 10px;
    text-align: center;
  }

  .pay-mode select {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    border-radius: 8px;
  }

  .total-display h2 {
    font-size: 26px;
  }

  .btn-submit {
    width: 100%;
    padding: 14px;
    border-radius: 10px;
    font-size: 16px;
  }
}


/* ---------- Extra Small Phones ---------- */
@media (max-width: 400px) {

  .header h1 {
    font-size: 16px;
  }

  .row label {
    font-size: 13px;
  }

  .price-label {
    font-size: 13px;
  }
}

  </style>
</head>

<body>

  <div class="header">
    <h1>STYLE N SHINE — BILLING SYSTEM</h1>
    <div class="nav-links">
      <a href="index.php">Refresh</a>
      <a href="view_bills.php">View History</a>
    </div>
  </div>

  <div class="container">
    <form action="process.php" method="POST" id="billForm">

      <div class="cust-meta">
        <input type="text" name="name" placeholder="Customer Name" required>
        <input type="tel" name="phone" placeholder="Phone Number (10 digits)" required>
        <input type="text" name="address" placeholder="Notes / Address">
      </div>

      <div class="billing-grid">
        <div class="category-card">
          <h3>HAIR CUT</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Cut: Women|299" data-price="299"> Women</label><span class="price-label">₹299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Cut: Women (Stylish)|399" data-price="399"> Women (Stylish)</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Cut: Happy Child-Girl|199" data-price="199"> Happy Child-Girl (Below 12 yrs)</label><span class="price-label">₹199</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>HAIR WASH (SHAMPOO & CONDITIONER)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Wash: Women Normal|99" data-price="99"> Women - Normal</label><span class="price-label">₹99</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Wash: Women Keratin|199" data-price="199"> Women - Keratin</label><span class="price-label">₹199</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>HAIR STYLING (IRONING, TONGS)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Styling: Upto Shoulder|299" data-price="299"> Upto Shoulder</label><span class="price-label">₹299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Styling: Below Shoulder|399" data-price="399"> Below Shoulder</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Styling: Upto Waist|499" data-price="499"> Upto Waist</label><span class="price-label">₹499</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>BLOW DRY (WITHOUT WASH)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Blow Dry: Women Upto Shoulder|299" data-price="299"> Women - Upto Shoulder</label><span class="price-label">₹299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Blow Dry: Women Below Shoulder|399" data-price="399"> Women - Below Shoulder</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Blow Dry: Women Upto Waist|449" data-price="449"> Women - Upto Waist</label><span class="price-label">₹449</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>GLOBAL COLOUR (FULL HAIR COLOURING)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Color: Women Upto Shoulder|1999" data-price="1999"> Women - Upto Shoulder</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Color: Women Below Shoulder|2399" data-price="2399"> Women - Below Shoulder</label><span class="price-label">₹2399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Color: Women Upto Waist|2999" data-price="2999"> Women - Upto Waist</label><span class="price-label">₹2999</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>ROOT TOUCH-UP</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Root Touch-up|899" data-price="899"> Root Touch-up</label><span class="price-label">₹899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Regrowth|1399" data-price="1399"> Regrowth</label><span class="price-label">₹1399</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>HI-LIGHTS (GLOBAL)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Upto Shoulder|1999" data-price="1999"> Women - Upto Shoulder</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Below Shoulder|2499" data-price="2499"> Women - Below Shoulder</label><span class="price-label">₹2499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Upto Waist|3899" data-price="3899"> Women - Upto Waist</label><span class="price-label">₹3899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Per Streak|399" data-price="399"> Per Streak</label><span class="price-label">₹399</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>HENNA</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Henna: Women|349" data-price="349"> Women</label><span class="price-label">₹349</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>WELLA PLEX (ADD ON)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Upto Shoulder|599" data-price="599"> Women - Upto Shoulder</label><span class="price-label">₹599</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Below Shoulder|899" data-price="899"> Women - Below Shoulder</label><span class="price-label">₹899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Upto Waist|1499" data-price="1499"> Women - Upto Waist</label><span class="price-label">₹1499</span></div>
        </div>
        </div>
         <div class="category-card">
          <h3>SMOOTHENING</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Upto Shoulder|2999" data-price="2999"> Women - Upto Shoulder</label><span class="price-label">₹2999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Below Shoulder|3499" data-price="3499"> Women - Below Shoulder</label><span class="price-label">₹3499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlights: Upto Waist|4999" data-price="4999"> Women - Upto Waist</label><span class="price-label">₹4999</span></div>
        </div>
        </div>
        <div class="category-card">
          <h3>ADVANCED HAIR TREATMENTS</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Perm Blow Dry: Upto Shoulder|2999" data-price="2999"> Permanent Blow Dry (Upto Shoulder)</label><span class="price-label">₹2999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Perm Blow Dry: Below Shoulder|3999" data-price="3999"> Permanent Blow Dry (Below Shoulder)</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Perm Blow Dry: Upto Waist|4999" data-price="4999"> Permanent Blow Dry (Upto Waist)</label><span class="price-label">₹4999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Straightening: Upto Shoulder|3999" data-price="3999"> Straightening ( Upto Shoulder)</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Straightening: Below Shoulder|4499" data-price="4499"> Straightening (Below Shoulder)</label><span class="price-label">₹4499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Straightening: Upto Waist|4999" data-price="4999"> Straightening (Upto Waist)</label><span class="price-label">₹4999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Rebonding: Upto Shoulder|4499" data-price="4499"> Rebonding (Shoulder)</label><span class="price-label">₹4499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Rebonding: Below Shoulder|4999" data-price="4999"> Rebonding (Below Shoulder)</label><span class="price-label">₹4999</span></div>
              <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Rebonding: Upto Waist|5499" data-price="5499"> Rebonding (Upto Waist)</label><span class="price-label">₹5499</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>HAIR BOTOX</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox: Women Upto Shoulder|4599" data-price="4599"> Women-Upto Shoulder</label><span class="price-label">₹4599</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox: Women Below Shoulder|4699" data-price="4699"> Women-Below Shoulder</label><span class="price-label">₹4699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox: Women Upto Waist|5999" data-price="5999"> Women-Upto Waist</label><span class="price-label">₹5999</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>NANOPLASTIA</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Nanoplastia: Women Upto Shoulder|4999" data-price="4999"> Women-Upto Shoulder</label><span class="price-label">₹4999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Nanoplastia: Women Below Shoulder|5499" data-price="5499"> Women-Below Shoulder</label><span class="price-label">₹5499</span></div>
             <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Nanoplastia: Women Upto Waist|6499" data-price="6499"> Women-Upto Waist</label><span class="price-label">₹6499</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>KERATIN TREATMENT</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin: Women Upto Shoulder|5499" data-price="5499"> Women-Upto Shoulder</label><span class="price-label">₹5499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin: Women Below Shoulder|5999" data-price="5999"> Women-Below Shoulder</label><span class="price-label">₹5999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin: Women Upto Waist|6999" data-price="6999"> Women-Upto Waist</label><span class="price-label">₹6999</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>CYSTEINE TREATMENT</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Cysteine: Women Upto Shoulder|4999" data-price="4999"> Women-Upto Shoulder</label><span class="price-label">₹4999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Cysteine: Women Below Shoulder|5999" data-price="5999"> Women-Below Shoulder</label><span class="price-label">₹5999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Cysteine: Women Upto Waist|6999" data-price="6999"> Women-Upto Waist</label><span class="price-label">₹6999</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>HAIR PERMING</h3>
          <div class="item-list">
           <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Perming: Women Upto Shoulder|2499" data-price="2499"> Women-Upto Shoulder</label><span class="price-label">₹2499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Perming: Women Below Shoulder|3999" data-price="3999"> Women-Below Shoulder</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Perming: Women Upto Waist|4999" data-price="4999"> Women-Upto Waist</label><span class="price-label">₹4999</span></div>
          </div>
        </div>
          <div class="category-card">
          <h3>HAIR SPA</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Spa: Women Upto Shoulder|1199" data-price="1199"> Women-Upto Shoulder</label><span class="price-label">₹1199</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Spa: Women Below Shoulder|1499" data-price="1499"> Women-Below Shoulder</label><span class="price-label">₹1499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Spa: Women Upto Waist|1699" data-price="1699"> Women-Upto Waist</label><span class="price-label">₹1699</span></div>
          </div>
        </div>
          <div class="category-card">
          <h3>ANTI HAIR FALL</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anti Hair Fall: Women Upto Shoulder|1399" data-price="1399"> Women-Upto Shoulder</label><span class="price-label">₹1399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anti Hair Fall: Women Below Shoulder|1799" data-price="1799"> Women-Below Shoulder</label><span class="price-label">₹1799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anti Hair Fall: Women Upto Waist|1999" data-price="1999"> Women-Upto Waist</label><span class="price-label">₹1999</span></div>
          </div>
        </div>
          <div class="category-card">
          <h3>ANTI DANDRUFF & FLAKES</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anti Dandruff & Flakes: Women Upto Shoulder|1399" data-price="1399"> Women-Upto Shoulder</label><span class="price-label">₹1399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anti Dandruff & Flakes: Women Below Shoulder|1799" data-price="1799"> Women-Below Shoulder</label><span class="price-label">₹1799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anti Dandruff & Flakes: Women Upto Waist|1999" data-price="1999"> Women-Upto Waist</label><span class="price-label">₹1999</span></div>
          </div>
        </div>
          <div class="category-card">
          <h3>WELLA PLEX (SERVICE)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wella Plex (Service): Women Upto Shoulder|1399" data-price="1399"> Women-Upto Shoulder</label><span class="price-label">₹1399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wella Plex (Service): Women Below Shoulder|1799" data-price="1799"> Women-Below Shoulder</label><span class="price-label">₹1799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wella Plex (Service): Women Upto Waist|1999" data-price="1999"> Women-Upto Waist</label><span class="price-label">₹1999</span></div>
          </div>
        </div>
          <div class="category-card">
          <h3>WELLA ANTI-FRIZZ</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wella Anti-Friz: Women Upto Shoulder|1399" data-price="1399"> Women-Upto Shoulder</label><span class="price-label">₹1399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wella Anti-Friz: Women Below Shoulder|1799" data-price="1799"> Women-Below Shoulder</label><span class="price-label">₹1799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wella Anti-Friz: Women Upto Waist|1999" data-price="1999"> Women-Upto Waist</label><span class="price-label">₹1999</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>THREADING</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading: Eyebrows|39" data-price="39"> Eyebrows</label><span class="price-label">₹39</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading: Lowerlips|19" data-price="19"> Lowerlips</label><span class="price-label">₹19</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading: Upperlips|29" data-price="29"> Upperlips</label><span class="price-label">₹29</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading: Chin|29" data-price="29"> Chin</label><span class="price-label">₹29</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading: Chik|39" data-price="39"> Chik</label><span class="price-label">₹39</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading: Forehead|29" data-price="29"> Forehead</label><span class="price-label">₹29</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading: Full Face|149" data-price="149"> Full Face</label><span class="price-label">₹149</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>WAXING</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Lowerlips Premium|89" data-price="89"> Lowerlips (Premium)</label><span class="price-label">₹89</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Upperlips Premium|89" data-price="89"> Upperlips (Premium)</label><span class="price-label">₹89</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Chin Premium|159" data-price="159"> Chin (Premium)</label><span class="price-label">₹159</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Chik Premium|199" data-price="199"> Chik (Premium)</label><span class="price-label">₹199</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Forehead Premium|119" data-price="119"> Forehead (Premium)</label><span class="price-label">₹119</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Full face Premium|249" data-price="249"> Full face (Premium)</label><span class="price-label">₹249</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Stomach Normal|399" data-price="399"> Stomach (Normal)</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Stomach Premium|699" data-price="699"> Stomach (Premium)</label><span class="price-label">₹699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax: Bikini Premium|799" data-price="799"> Bikini (Premium)</label><span class="price-label">₹799</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>MASSAGES</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage: Leg|999" data-price="999"> Leg massage (Women only)</label><span class="price-label">₹999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage: Foot|499" data-price="499"> Foot massage (Women only)</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage: Head Classic|399" data-price="399"> Head massage-Classic</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage: Head Aroma|499" data-price="499"> Head massage-Aroma</label><span class="price-label">₹499</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>O3+ SERVICES - CLEAN UP</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ CleanUp: Instant D tan|399" data-price="399"> Instant D tan</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ CleanUp: Black mask|499" data-price="499"> Black mask</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ CleanUp: Classic|799" data-price="799"> Classic Clean Up</label><span class="price-label">₹799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ CleanUp: Advanced|1199" data-price="1199"> Advanced Clean Up</label><span class="price-label">₹1199</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>O3+ SERVICES - FACIALS</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ Facial: Anti Ageing|1799" data-price="1799"> Anti Ageing Facial</label><span class="price-label">₹1799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ Facial: Blackheads|1999" data-price="1999"> Blackheads Removal</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ Facial: Shine Glow|2199" data-price="2199"> Shine & Glow Facial</label><span class="price-label">₹2199</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>SIGNATURE FACIALS</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Advanced Whitening|1999" data-price="1999"> Advanced Whitening</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Seaweed Range|2499" data-price="2499"> Seaweed Range</label><span class="price-label">₹2499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Ultra Relaxing|2999" data-price="2999"> Ultra Relaxing</label><span class="price-label">₹2999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Vitamin C Facial|3299" data-price="3299"> Vitamin C Facial</label><span class="price-label">₹3299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Diamond Luxury|3899" data-price="3899"> Diamond Luxury</label><span class="price-label">₹3899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Bridal Facial|4099" data-price="4099"> Bridal Facial</label><span class="price-label">₹4099</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>LOTUS PROFESSIONAL (CLEAN UP)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Instant D Tan|399" data-price="399">Instant D Tan</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Basic CETOM|699" data-price="699">Basic CETOM</label><span class="price-label">₹699</span></div>
          </div>
        </div>
          <div class="category-card">
          <h3>LOTUS PROFESSIONAL (ADVANCED TREATEMENTS)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Dipigmentone|1499" data-price="1499">Dipigmentone</label><span class="price-label">₹1499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Acnex|1799" data-price="1799">Acnex</label><span class="price-label">₹1799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Instafair|1999" data-price="1999">Instafair</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Glowdermie|2099" data-price="2099">Glowdermie</label><span class="price-label">₹2099</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>LOTUS PROFESSIONAL (PREMIUM FACIALS)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="4-layers-advanced-whitening|2199" data-price="2199">4-layers-advanced-whitening</label><span class="price-label">₹2199</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="4-layers-anti-ageing|2399" data-price="2399">4-layers-anti-ageing</label><span class="price-label">₹2399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Advanced-papaya-marmalade|2899" data-price="2899">Advanced-papaya-marmalade</label><span class="price-label">₹2899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Advancd-kiwi-marmalade|3099" data-price="3099">Advancd-kiwi-marmalade</label><span class="price-label">₹3099</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>LOTUS PROFESSIONAL (LUXURY FACIALS)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Ultimo-Gold|3999" data-price="3999">Ultimo-Gold</label><span class="price-label">₹3999</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>NATURE'S PROFESSIONAL</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Advanced-fruit-facial-kit|1799" data-price="1799">Advanced-fruit-facial-kit</label><span class="price-label">₹1799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Advanced-pearl-facial-kit|1200" data-price="1200">Advanced-pearl-facial-kit</label><span class="price-label">₹1200</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Advanced-glowing-gold-facial-kit|2100" data-price="2100">Advanced-glowing-gold-facial-kit</label></label><span class="price-label">₹2100</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>LOTUS HERBALS</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Radiant-diamond-cellular-radiance-facial-kit|1899" data-price="1899">Radiant-diamond-cellular-radiance-facial-kit</label><span class="price-label">₹1899</span></div>
          </div>
        </div>
          <div class="category-card">
          <h3>VLCC</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Der/tan-facial-kit|1000" data-price="1000">Der/tan-facial-kit</label><span class="price-label">₹1000</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>POLISHING</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hand|249" data-price="249">Hand</label><span class="price-label">₹249</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Legs|349" data-price="349">Legs</label><span class="price-label">₹349</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Stomach|499" data-price="499">Stomach</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Back|899" data-price="899">Back</label><span class="price-label">₹899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Full-Body|1899" data-price="1899">Full-Body</label><span class="price-label">₹1899</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>KOREAN TREATMENTS</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Twacha Korean Glass Skin|3599" data-price="3599"> TWACHA - 10 Steps Korean Glass Skin</label><span class="price-label">₹3599</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Kanpeki Glass Glow|899" data-price="899"> KANPEKI - Glass Glow Skin Facial</label><span class="price-label">₹899</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>MANICURE</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Manicure: Herbal|399" data-price="399"> Herbal Manicure</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Manicure: French|499" data-price="499"> French Manicure</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Manicure: Spa|799" data-price="799"> Spa Manicure</label><span class="price-label">₹799</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>PEDICURE</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pedicure: Herbal|599" data-price="599"> Herbal Pedicure</label><span class="price-label">₹599</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pedicure: French|899" data-price="899"> French Pedicure</label><span class="price-label">₹899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pedicure: Spa|1099" data-price="1099"> Spa Pedicure</label><span class="price-label">₹1099</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pedicure: Heel-Peel|1499" data-price="1499"> Heel-Peel Pedicure</label><span class="price-label">₹1499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pedicure: Luxury|1799" data-price="1799"> Luxury Pedicure</label><span class="price-label">₹1799</span></div>
          </div>
        </div>
  <div class="category-card">
          <h3>NAIL-FILLING & PAINT</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Nail-filling-paint|129" data-price="129">Nail-filling-paint</label><span class="price-label">₹129</span></div>
          </div>
        </div>
          <div class="category-card">
          <h3>WEDDING/RECEPTION MAKE UP</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Classic|6499" data-price="6499">Classic</label><span class="price-label">₹6499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Premium|9999" data-price="9999">Premium</label><span class="price-label">₹9999</span></div>
          </div>
        </div>
            <div class="category-card">
          <h3>ADD ON'S</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Classic|2999" data-price="2999">Classic</label><span class="price-label">₹2999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Premium|3999" data-price="3999">Premium</label><span class="price-label">₹3999</span></div>
          </div>
        </div>
           <div class="category-card">
          <h3>PARTY MAKE-UP</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Classic|999" data-price="999">Classic</label><span class="price-label">₹999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Premium|1999" data-price="1999">Premium</label><span class="price-label">₹1999</span></div>
          </div>
        </div>
         
          <div class="category-card">
          <h3>GROOM MAKE-UP</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Groom-makeup|1499" data-price="1499">Groom-makeup</label><span class="price-label">₹1499</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>WAXING (BODY)</h3>
          <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Underarms Premium|99" data-price="99"> Underarms (Premium)</label><span class="price-label">₹99</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Half Arms Normal|199" data-price="199"> Half Arms (Normal)</label><span class="price-label">₹199</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Half Arms Premium|299" data-price="299"> Half Arms (Premium)</label><span class="price-label">₹299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Full Arms Normal|299" data-price="299"> Full Arms (Normal)</label><span class="price-label">₹299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Full Arms Premium|449" data-price="449"> Full Arms (Premium)</label><span class="price-label">₹449</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Half Legs Normal|249" data-price="249"> Half Legs (Normal)</label><span class="price-label">₹249</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Half Legs Premium|349" data-price="349"> Half Legs (Premium)</label><span class="price-label">₹349</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Full Legs Normal|399" data-price="399"> Full Legs (Normal)</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Full Legs Premium|599" data-price="599"> Full Legs (Premium)</label><span class="price-label">₹599</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Full Back Normal|399" data-price="399"> Full Back (Normal)</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Full Back Premium|699" data-price="699"> Full Back (Premium)</label><span class="price-label">₹699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Full Body Normal|1199" data-price="1199"> Full Body (Normal)</label><span class="price-label">₹1199</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing: Full Body Premium|1999" data-price="1999"> Full Body (Premium)</label><span class="price-label">₹1999</span></div>
          </div>
        </div>
        <div class="category-card">
          <h3>CLOTHING & STITCHING</h3>
          <div class="item-list">
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Salwar Suit|650" data-price="650"> Salwar Suit</label>
              <span class="price-label">₹650</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Pant Suit|700" data-price="700"> Pant Suit</label>
              <span class="price-label">₹700</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Half Astar Pant Suit|900" data-price="900"> Half Astar Pant Suit</label>
              <span class="price-label">₹900</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Full Astar Pant Suit|1100" data-price="1100"> Full Astar Pant Suit</label>
              <span class="price-label">₹1100</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Blouse Astar|600" data-price="600"> Blouse Astar</label>
              <span class="price-label">₹600</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Bina Blouse Astar Blouse|300" data-price="300"> Bina Astar Blouse</label>
              <span class="price-label">₹300</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Lehenga Top|3500" data-price="3500"> Lehenga Top</label>
              <span class="price-label">₹3500</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Frock Astra|1800" data-price="1800"> Frock Astra</label>
              <span class="price-label">₹1800</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Saree Suit|1300" data-price="1300"> Saree Suit</label>
              <span class="price-label">₹1300</span>
            </div>
            <div class="row">
              <label><input class="svc" type="checkbox" name="services[]" value="Pada Blouse|1200" data-price="1200"> Pada Blouse</label>
              <span class="price-label">₹1200</span>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-bar">
        <div class="pay-mode">
          <p style="margin:0 0 5px 0; font-size:12px; opacity:0.8;">PAYMENT MODE</p>
          <select name="payment">
            <option value="Cash">Cash</option>
            <option value="UPI">UPI / PhonePe</option>
            <option value="Card">Card</option>
          </select>
        </div>

        <div class="total-display">
          <p style="margin:0; font-size:14px; opacity:0.8;">GRAND TOTAL</p>
          <h2>₹ <span id="displayTotal">0.00</span></h2>
        </div>

        <button type="submit" class="btn-submit">GENERATE BILL</button>
      </div>

      <input type="hidden" name="total" id="hiddenTotal">
      <input type="hidden" name="subtotal" id="hiddenSubtotal">
    </form>
  </div>

  <script>
    const checkboxes = document.querySelectorAll('.svc');
    const displayTotal = document.getElementById('displayTotal');
    const hiddenTotal = document.getElementById('hiddenTotal');

    function calculate() {
      let total = 0;
      checkboxes.forEach(cb => {
        if (cb.checked) {
          total += parseFloat(cb.dataset.price);
        }
      });
      displayTotal.innerText = total.toLocaleString('en-IN', {
        minimumFractionDigits: 2
      });
      hiddenTotal.value = total;
      document.getElementById('hiddenSubtotal').value = total;
    }
    checkboxes.forEach(cb => cb.addEventListener('change', calculate));
  </script>
</body>

</html>