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
    <!-- Page 1 Items -->
    <div class="item-list">
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Cut|800" data-price="800"> Hair Cut</label><span class="price-label">₹800</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Wash + Dry|300" data-price="300"> Hair Wash + Dry</label><span class="price-label">₹300</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Child Hair Cut|300" data-price="300"> Child Hair Cut</label><span class="price-label">₹300</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Spa Treatment (Normal)|1200" data-price="1200"> Spa Treatment (Normal)</label><span class="price-label">₹1200</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anti Dandruff Treatment|2000" data-price="2000"> Anti Dandruff Treatment</label><span class="price-label">₹2000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Loss Treatment|200" data-price="200"> Hair Loss Treatment</label><span class="price-label">₹200</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Dry and Damage Treatment|1800" data-price="1800"> Dry and Damage Treatment</label><span class="price-label">₹1800</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Colour (Long)|5000" data-price="5000"> Global Colour (Long)</label><span class="price-label">₹5000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Colour (Medium)|3500" data-price="3500"> Global Colour (Medium)</label><span class="price-label">₹3500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Colour (Short)|3000" data-price="3000"> Global Colour (Short)</label><span class="price-label">₹3000</span></div>
    </div>
    
    <div class="item-list">
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlight Per Fail (Streak)|100" data-price="100"> Highlight Per Fail</label><span class="price-label">₹100</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Straightening (Long)|6000" data-price="6000"> Hair Straightening (Long)</label><span class="price-label">₹6000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Straightening (Short)|4000" data-price="4000"> Hair Straightening (Short)</label><span class="price-label">₹4000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Straightening (Medium)|5000" data-price="5000"> Hair Straightening (Medium)</label><span class="price-label">₹5000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Head Massage|500" data-price="500"> Head Massage</label><span class="price-label">₹500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin (Long)|5500" data-price="5500"> Keratin (Long)</label><span class="price-label">₹5500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin (Medium)|4000" data-price="4000"> Keratin (Medium)</label><span class="price-label">₹4000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin (Short)|3500" data-price="3500"> Keratin (Short)</label><span class="price-label">₹3500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox (Long)|6000" data-price="6000"> Botox (Long)</label><span class="price-label">₹6000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox (Medium)|5000" data-price="5000"> Botox (Medium)</label><span class="price-label">₹5000</span></div>
    </div>

    <div class="item-list">
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox (Short)|4000" data-price="4000"> Botox (Short)</label><span class="price-label">₹4000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Root Touchup|1000" data-price="1000"> Root Touchup</label><span class="price-label">₹1000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Bridal Makeup|7000" data-price="7000"> Bridal Makeup</label><span class="price-label">₹7000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Engagement Makeup|5000" data-price="5000"> Engagement Makeup</label><span class="price-label">₹5000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Reception Makeup|4000" data-price="4000"> Reception Makeup</label><span class="price-label">₹4000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Groom Makeup|3000" data-price="3000"> Groom Makeup</label><span class="price-label">₹3000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Light Makeup|2000" data-price="2000"> Light Makeup</label><span class="price-label">₹2000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Styling (Stylish Women)|1000" data-price="1000"> Hair Styling (Stylish Women)</label><span class="price-label">₹1000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Ironing|700" data-price="700"> Ironing</label><span class="price-label">₹700</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Tong|700" data-price="700"> Tong</label><span class="price-label">₹700</span></div>
    </div>

    <!-- Page 2 Items -->
    <div class="item-list">
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Do|800" data-price="800"> Hair Do</label><span class="price-label">₹800</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ Facial|3000" data-price="3000"> O3+ Facial</label><span class="price-label">₹3000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ D-tan|600" data-price="600"> O3+ D-tan</label><span class="price-label">₹600</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ Cleanup|1000" data-price="1000"> O3+ Cleanup</label><span class="price-label">₹1000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Lotus Facial|1500" data-price="1500"> Lotus Facial</label><span class="price-label">₹1500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Lotus Facial Cleanup|1000" data-price="1000"> Lotus Facial Cleanup</label><span class="price-label">₹1000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Raga D-tan|500" data-price="500"> Raga D-tan</label><span class="price-label">₹500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Shahnaz Facial|800" data-price="800"> Shahnaz Facial</label><span class="price-label">₹800</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Natures Facial|700" data-price="700"> Natures Facial</label><span class="price-label">₹700</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Shahnaz Cleanup|600" data-price="600"> Shahnaz Cleanup</label><span class="price-label">₹600</span></div>
    </div>

    <div class="item-list">
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Natures Cleanup|600" data-price="600"> Natures Cleanup</label><span class="price-label">₹600</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Oxy D-tan|500" data-price="500"> Oxy D-tan</label><span class="price-label">₹500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Face Bleach|500" data-price="500"> Face Bleach</label><span class="price-label">₹500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Under Arms|100" data-price="100"> Wax Under Arms</label><span class="price-label">₹100</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Half Leg|400" data-price="400"> Wax Half Leg</label><span class="price-label">₹400</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Full Leg|700" data-price="700"> Wax Full Leg</label><span class="price-label">₹700</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Full Body|2000" data-price="2000"> Wax Full Body</label><span class="price-label">₹2000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Full Hand|500" data-price="500"> Wax Full Hand</label><span class="price-label">₹500</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Half Hand|300" data-price="300"> Wax Half Hand</label><span class="price-label">₹300</span></div>
    </div>

    <div class="item-list">
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading Eyebrows|50" data-price="50"> Threading Eyebrows</label><span class="price-label">₹50</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading Forehead|50" data-price="50"> Threading Forehead</label><span class="price-label">₹50</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading Full Face|150" data-price="150"> Threading Full Face</label><span class="price-label">₹150</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pedicure|1200" data-price="1200"> Pedicure</label><span class="price-label">₹1200</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Manicure|800" data-price="800"> Manicure</label><span class="price-label">₹800</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Polish|100" data-price="100"> Hair Polish</label><span class="price-label">₹100</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Full Body Polish|3000" data-price="3000"> Full Body Polish</label><span class="price-label">₹3000</span></div>
        <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Full Body Bleach|2500" data-price="2500"> Full Body Bleach</label><span class="price-label">₹2500</span></div>
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