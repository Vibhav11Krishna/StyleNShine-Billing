// script.js
document.addEventListener('DOMContentLoaded', () => {
  const services = document.querySelectorAll('.svc');
  const subtotalEl = document.getElementById('subtotal');
  const gstEl = document.getElementById('gst');
  const totalEl = document.getElementById('total');
  const paySelect = document.getElementById('payMode');
  const qrBox = document.getElementById('qrBox');
  const qrImg = document.getElementById('qrImg');

  function calc() {
    let sum = 0;
    services.forEach(s => { if (s.checked) sum += parseFloat(s.dataset.price || s.value || 0); });
    const gst = +(sum * 0.18).toFixed(2);
    const total = +(sum + gst).toFixed(2);
    subtotalEl.value = sum.toFixed(2);
    gstEl.value = gst.toFixed(2);
    totalEl.value = total.toFixed(2);
  }

  services.forEach(s => s.addEventListener('change', calc));
  calc();

  paySelect.addEventListener('change', () => {
    const val = paySelect.value;
    if (val === 'Paytm') {
      qrImg.src = 'paytm-qr.png'; qrBox.style.display = 'block';
    } else if (val === 'PhonePe') {
      qrImg.src = 'phonepe-qr.png'; qrBox.style.display = 'block';
    } else {
      qrBox.style.display = 'none';
    }
  });
});
