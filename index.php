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

    .section-title-main {
      font-size: 20px;
      font-weight: 700;
      color: var(--primary);
      margin: 25px 0 15px 0;
      padding-bottom: 8px;
      border-bottom: 2px solid var(--primary);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .billing-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-bottom: 20px;
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
      background: #fdfdfd;
      border: 1px solid #e0e6ed;
      border-radius: 8px;
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

  .section-title-main {
    font-size: 16px;
    margin: 20px 0 10px 0;
  }

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

  .billing-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .item-list {
    max-height: 320px;
    padding: 10px;
  }

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

@media (max-width: 400px) {
  .header h1 {
    font-size: 16px;
  }
  .row label, .price-label {
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

      <!-- PARLOUR SERVICES -->
      <div class="section-title-main">Parlour Services</div>
      <div class="billing-grid">
        <!-- Parlour Page 1 Items -->
        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Cut (Stylish)|499" data-price="499"> Hair Cut (Stylish)</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Cut (Normal)|399" data-price="399"> Hair Cut (Normal)</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Cut (Child)|299" data-price="299"> Hair Cut (Child)</label><span class="price-label">₹299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Wash + Dry|299" data-price="299"> Hair Wash + Dry</label><span class="price-label">₹299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Child Hair Cut|299" data-price="299"> Child Hair Cut</label><span class="price-label">₹299</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Spa Treatment (Normal)|1199" data-price="1199"> Spa Treatment (Normal)</label><span class="price-label">₹1199</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anti Dandruff Treatment|1999" data-price="1999"> Anti Dandruff Treatment</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Loss Treatment|1999" data-price="1999"> Hair Loss Treatment</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Dry and Damage Treatment|1799" data-price="1799"> Dry and Damage Treatment</label><span class="price-label">₹1799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Colour (Long)|4999" data-price="4999"> Global Colour (Long)</label><span class="price-label">₹4999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Colour (Medium)|3499" data-price="3499"> Global Colour (Medium)</label><span class="price-label">₹3499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Global Colour (Short)|2999" data-price="2999"> Global Colour (Short)</label><span class="price-label">₹2999</span></div>
        </div>
        
        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Highlight Per Fail (Streak)|99" data-price="99"> Highlight Per Fail</label><span class="price-label">₹99</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Straightening (Long)|5999" data-price="5999"> Hair Straightening (Long)</label><span class="price-label">₹5999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Straightening (Short)|3999" data-price="3999"> Hair Straightening (Short)</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Straightening (Medium)|4999" data-price="4999"> Hair Straightening (Medium)</label><span class="price-label">₹4999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Head Massage|500" data-price="499"> Head Massage</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin (Long)|5499" data-price="5499"> Keratin (Long)</label><span class="price-label">₹5499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin (Medium)|3999" data-price="3999"> Keratin (Medium)</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Keratin (Short)|3499" data-price="3999"> Keratin (Short)</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox (Long)|5999" data-price="6000"> Botox (Long)</label><span class="price-label">₹5999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox (Medium)|4999" data-price="4999"> Botox (Medium)</label><span class="price-label">₹4999</span></div>
        </div>

        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Botox (Short)|3999" data-price="3999"> Botox (Short)</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Root Touchup|999" data-price="999"> Root Touchup</label><span class="price-label">₹999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Bridal Makeup|6999" data-price="6999"> Bridal Makeup</label><span class="price-label">₹6999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Engagement Makeup|4999" data-price="4999"> Engagement Makeup</label><span class="price-label">₹4999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Reception Makeup|3999" data-price="3999"> Reception Makeup</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Groom Makeup|2999" data-price="2999"> Groom Makeup</label><span class="price-label">₹2999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Light Makeup|1999" data-price="1999"> Light Makeup</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Styling (Stylish Women)|999" data-price="999"> Hair Styling (Stylish Women)</label><span class="price-label">₹999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Ironing|699" data-price="699"> Ironing</label><span class="price-label">₹699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Tong|699" data-price="699"> Tong</label><span class="price-label">₹699</span></div>
        </div>

        <!-- Parlour Page 2 Items -->
        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Hair Do|799" data-price="799"> Hair Do</label><span class="price-label">₹799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ Facial|2999" data-price="2999"> O3+ Facial</label><span class="price-label">₹2999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ D-tan|499" data-price="499"> O3+ D-tan</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="O3+ Cleanup|999" data-price="999"> O3+ Cleanup</label><span class="price-label">₹999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Lotus Facial|1499" data-price="1499"> Lotus Facial</label><span class="price-label">₹1499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Lotus Facial Cleanup|999" data-price="999"> Lotus Facial Cleanup</label><span class="price-label">₹999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Raga D-tan|499" data-price="499"> Raga D-tan</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Shahnaz Facial|799" data-price="799"> Shahnaz Facial</label><span class="price-label">₹799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Natures Facial|699" data-price="699"> Natures Facial</label><span class="price-label">₹699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Shahnaz Cleanup|599" data-price="599"> Shahnaz Cleanup</label><span class="price-label">₹599</span></div>
        </div>

        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Natures Cleanup|599" data-price="599"> Natures Cleanup</label><span class="price-label">₹599</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Oxy D-tan|499" data-price="499"> Oxy D-tan</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Face Bleach|499" data-price="499"> Face Bleach</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Under Arms|99" data-price="99"> Wax Under Arms</label><span class="price-label">₹99</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Half Leg|399" data-price="399"> Wax Half Leg</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Full Leg|699" data-price="699"> Wax Full Leg</label><span class="price-label">₹699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Full Body|1999" data-price="1999"> Wax Full Body</label><span class="price-label">₹1999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Full Hand|499" data-price="499"> Wax Full Hand</label><span class="price-label">₹499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Wax Half Hand|299" data-price="299"> Wax Half Hand</label><span class="price-label">₹299</span></div>
        </div>

        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading Eyebrows|49" data-price="49"> Threading Eyebrows</label><span class="price-label">₹49</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading Forehead|49" data-price="49"> Threading Forehead</label><span class="price-label">₹49</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading Full Face|149" data-price="149"> Threading Full Face</label><span class="price-label">₹149</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pedicure|1199" data-price="1199"> Pedicure</label><span class="price-label">₹1199</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Manicure|799" data-price="799"> Manicure</label><span class="price-label">₹799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Full Body Polish|2999" data-price="2999"> Full Body Polish</label><span class="price-label">₹2999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Full Body Bleach|2499" data-price="2499"> Full Body Bleach</label><span class="price-label">₹2499</span></div>
        </div>
        
       <div class="item-list">
    <!-- WAXING -->
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Lowerlips)|89" data-price="89"> Waxing (Lowerlips)</label><span class="price-label">₹89</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Upperlips)|89" data-price="89"> Waxing (Upperlips)</label><span class="price-label">₹89</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Chin)|159" data-price="159"> Waxing (Chin)</label><span class="price-label">₹159</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Chik)|199" data-price="199"> Waxing (Chik)</label><span class="price-label">₹199</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Forehead)|119" data-price="119"> Waxing (Forehead)</label><span class="price-label">₹119</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full face)|249" data-price="249"> Waxing (Full face)</label><span class="price-label">₹249</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Stomach Normal)|399" data-price="399"> Waxing (Stomach Normal)</label><span class="price-label">₹399</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Stomach Premium)|699" data-price="699"> Waxing (Stomach Premium)</label><span class="price-label">₹699</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Bikini Premium)|799" data-price="799"> Waxing (Bikini Premium)</label><span class="price-label">₹799</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Half Back Premium)|599" data-price="599"> Waxing (Half Back Premium)</label><span class="price-label">₹599</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full Back Normal)|499" data-price="499"> Waxing (Full Back Normal)</label><span class="price-label">₹499</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full Back Premium)|899" data-price="899"> Waxing (Full Back Premium)</label><span class="price-label">₹899</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Underarms Normal)|99" data-price="99"> Waxing (Underarms Normal)</label><span class="price-label">₹99</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Underarms Premium)|199" data-price="199"> Waxing (Underarms Premium)</label><span class="price-label">₹199</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Half arms Normal)|249" data-price="249"> Waxing (Half arms Normal)</label><span class="price-label">₹249</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Half arms Premium)|499" data-price="499"> Waxing (Half arms Premium)</label><span class="price-label">₹499</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full arms Normal)|399" data-price="399"> Waxing (Full arms Normal)</label><span class="price-label">₹399</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full arms Premium)|799" data-price="799"> Waxing (Full arms Premium)</label><span class="price-label">₹799</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Half legs Normal)|399" data-price="399"> Waxing (Half legs Normal)</label><span class="price-label">₹399</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Half Leg Premium)|699" data-price="699"> Waxing (Half Leg Premium)</label><span class="price-label">₹699</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full legs Normal)|599" data-price="599"> Waxing (Full legs Normal)</label><span class="price-label">₹599</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full Legs Premium)|899" data-price="899"> Waxing (Full Legs Premium)</label><span class="price-label">₹899</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full body Normal)|1999" data-price="1999"> Waxing (Full body Normal)</label><span class="price-label">₹1999</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Waxing (Full body Premium)|2899" data-price="2899"> Waxing (Full body Premium)</label><span class="price-label">₹2899</span></div>
</div>

<div class="item-list">
    <!-- MANICURE -->
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Manicure (Herbal)|399" data-price="399"> Manicure (Herbal)</label><span class="price-label">₹399</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Manicure (French)|499" data-price="499"> Manicure (French)</label><span class="price-label">₹499</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Manicure (Spa)|799" data-price="799"> Manicure (Spa)</label><span class="price-label">₹799</span></div>
</div>

<div class="item-list">
    <!-- THREADING -->
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading (Eyebrows)|39" data-price="39"> Threading (Eyebrows)</label><span class="price-label">₹39</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading (Lowerlips)|19" data-price="19"> Threading (Lowerlips)</label><span class="price-label">₹19</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading (Upperlips)|29" data-price="29"> Threading (Upperlips)</label><span class="price-label">₹29</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading (Chin)|29" data-price="29"> Threading (Chin)</label><span class="price-label">₹29</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading (Chik)|39" data-price="39"> Threading (Chik)</label><span class="price-label">₹39</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading (Forehead)|29" data-price="29"> Threading (Forehead)</label><span class="price-label">₹29</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Threading (Ful face)|149" data-price="149"> Threading (Ful face)</label><span class="price-label">₹149</span></div>
</div>

<div class="item-list">
    <!-- POLISHING -->
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Polishing (Hand)|249" data-price="249"> Polishing (Hand)</label><span class="price-label">₹249</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Polishing (Legs)|349" data-price="349"> Polishing (Legs)</label><span class="price-label">₹349</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Polishing (Stomach)|499" data-price="499"> Polishing (Stomach)</label><span class="price-label">₹499</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Polishing (Back)|899" data-price="899"> Polishing (Back)</label><span class="price-label">₹899</span></div>
</div>

<div class="item-list">
    <!-- FACIAL -->
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Facial (10 Steps Korean Glass Skin Hyper Pigmentation)|3599" data-price="3599"> Facial (10 Steps Korean Glass Skin Hyper Pigmentation)</label><span class="price-label">₹3599</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Facial (Glass Glow Skin Korean Skin Care Rituals)|899" data-price="899"> Facial (Glass Glow Skin Korean Skin Care Rituals)</label><span class="price-label">₹899</span></div>
</div>

<div class="item-list">
    <!-- MASSAGE -->
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage (Full body)|1899" data-price="1899"> Massage (Full body)</label><span class="price-label">₹1899</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage (Leg - Only for women)|999" data-price="999"> Massage (Leg <small>Only for women</small>)</label><span class="price-label">₹999</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage (Foot - Only for women)|499" data-price="499"> Massage (Foot <small>Only for women</small>)</label><span class="price-label">₹499</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage (Head Classic)|399" data-price="399"> Massage (Head Classic)</label><span class="price-label">₹399</span></div>
    <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Massage (Head Aroma)|499" data-price="499"> Massage (Head Aroma)</label><span class="price-label">₹499</span></div>
</div>


      </div>

      <!-- BOUTIQUE SERVICES -->
      <div class="section-title-main">Boutique Services</div>
      <div class="billing-grid">
        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Kurti Astar|599" data-price="599"> Kurti Astar</label><span class="price-label">₹599</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Suit Salwar|699" data-price="699"> Suit Salwar</label><span class="price-label">₹699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pant Suit|749" data-price="749"> Pant Suit</label><span class="price-label">₹749</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pant|399" data-price="399"> Pant</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Plazo|399" data-price="399"> Plazo</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Normal Blouse Astar|699" data-price="699"> Normal Blouse Astar</label><span class="price-label">₹699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Rubiya Blouse|349" data-price="349"> Rubiya Blouse</label><span class="price-label">₹349</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Padded Blouse (Normal)|1399" data-price="1399"> Padded Blouse (Normal)</label><span class="price-label">₹1399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Bridal Blouse|2499" data-price="2499"> Bridal Blouse</label><span class="price-label">₹2499</span></div>
        </div>

        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Half Astar Suit|899" data-price="899"> Half Astar Suit</label><span class="price-label">₹899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Full Astar Suit|1399" data-price="1399"> Full Astar Suit</label><span class="price-label">₹1399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="One Salwar|399" data-price="399"> One Salwar</label><span class="price-label">₹399</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Frock Umbrella|1199" data-price="1199"> Frock Umbrella</label><span class="price-label">₹1199</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Frock Umbrella with Anar|1599" data-price="1599"> Frock Umbrella with Anar</label><span class="price-label">₹1599</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Anarkali|3499" data-price="3499"> Anarkali</label><span class="price-label">₹3499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Kali Frock|2499" data-price="2499"> Kali Frock</label><span class="price-label">₹2499</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Astar Kali Frock|3499" data-price="3499"> Astar Kali Frock</label><span class="price-label">₹3499</span></div>
        </div>

        <div class="item-list">
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Tulip Salwar|899" data-price="899"> Tulip Salwar</label><span class="price-label">₹899</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Lehenga Normal|3999" data-price="3999"> Lehenga Normal</label><span class="price-label">₹3999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Bridal Lehenga with Blouse|8999" data-price="8999"> Bridal Lehenga with Blouse</label><span class="price-label">₹8999</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Ladies Shirt|799" data-price="799"> Ladies Shirt</label><span class="price-label">₹799</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Top|699" data-price="699"> Top</label><span class="price-label">₹699</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Fall|119" data-price="119"> Fall</label><span class="price-label">₹119</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Pico|19" data-price="19"> Pico</label><span class="price-label">₹19</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Polish|79" data-price="79"> Polish</label><span class="price-label">₹79</span></div>
            <div class="row"><label><input class="svc" type="checkbox" name="services[]" value="Alteration|49" data-price="49"> Alteration</label><span class="price-label">₹49</span></div>
            
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

        <!-- Separate Submit Buttons for Parlour & Boutique -->
        <div class="submit-buttons" style="display: flex; gap: 10px;">
          <button type="submit" name="action_type" value="parlour" class="btn-submit" style="background-color: #0284c7;">Bill Parlour</button>
          <button type="submit" name="action_type" value="boutique" class="btn-submit" style="background-color: #003366;">Bill Boutique</button>
        </div>
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

</html>x