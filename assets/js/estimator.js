/**
 * ZIPPY ENTERPRISES PRIVATE LIMITED
 * Interactive Construction Cost Estimator & Live PDF Generator
 */

document.addEventListener('DOMContentLoaded', function () {
  const areaInput = document.getElementById('calc-builtup-area');
  const floorsSelect = document.getElementById('calc-floors');
  const categorySelect = document.getElementById('calc-category');
  const packageCards = document.querySelectorAll('.calc-package-card');
  const addonCheckboxes = document.querySelectorAll('.calc-addon-check');

  let selectedPackageRate = 2150; // default Premium package
  let selectedPackageName = 'Premium Specification';

  // Package Card Selection
  packageCards.forEach(card => {
    card.addEventListener('click', function () {
      packageCards.forEach(c => c.classList.remove('selected'));
      this.classList.add('selected');
      selectedPackageRate = parseInt(this.getAttribute('data-rate'), 10);
      selectedPackageName = this.getAttribute('data-name');
      calculateEstimate();
    });
  });

  // Input listeners
  if (areaInput) areaInput.addEventListener('input', calculateEstimate);
  if (floorsSelect) floorsSelect.addEventListener('change', calculateEstimate);
  if (categorySelect) categorySelect.addEventListener('change', calculateEstimate);
  addonCheckboxes.forEach(cb => cb.addEventListener('change', calculateEstimate));

  function calculateEstimate() {
    const area = parseFloat(areaInput?.value) || 2500;
    const floors = parseInt(floorsSelect?.value, 10) || 2;
    const categoryMultiplier = parseFloat(categorySelect?.selectedOptions[0]?.getAttribute('data-multiplier')) || 1.0;

    let baseRatePerSqft = selectedPackageRate * categoryMultiplier;
    let baseConstructionCost = area * baseRatePerSqft;

    // Calculate addons
    let addonTotal = 0;
    addonCheckboxes.forEach(cb => {
      if (cb.checked) {
        const type = cb.getAttribute('data-type');
        const val = parseFloat(cb.getAttribute('data-val'));
        if (type === 'sqft') {
          addonTotal += area * val;
        } else if (type === 'flat') {
          addonTotal += val;
        }
      }
    });

    const totalProjectCost = baseConstructionCost + addonTotal;

    // Component Cost Breakdown
    const structureCost = Math.round(totalProjectCost * 0.46);
    const finishingCost = Math.round(totalProjectCost * 0.24);
    const mepCost = Math.round(totalProjectCost * 0.15);
    const labourSiteCost = Math.round(totalProjectCost * 0.15);

    // Update DOM Elements
    const totalEl = document.getElementById('calc-total-cost');
    const rateEl = document.getElementById('calc-effective-rate');
    const structureEl = document.getElementById('calc-structure-cost');
    const finishingEl = document.getElementById('calc-finishing-cost');
    const mepEl = document.getElementById('calc-mep-cost');
    const labourEl = document.getElementById('calc-labour-cost');
    const floorBreakdownTbody = document.getElementById('calc-floor-breakdown-body');

    if (totalEl) totalEl.innerText = formatINR(totalProjectCost);
    if (rateEl) rateEl.innerText = '₹' + Math.round(totalProjectCost / area).toLocaleString('en-IN') + ' / sq.ft';
    if (structureEl) structureEl.innerText = formatINR(structureCost);
    if (finishingEl) finishingEl.innerText = formatINR(finishingCost);
    if (mepEl) mepEl.innerText = formatINR(mepCost);
    if (labourEl) labourEl.innerText = formatINR(labourSiteCost);

    // Populate Floor-wise Table
    if (floorBreakdownTbody) {
      floorBreakdownTbody.innerHTML = '';
      const areaPerFloor = Math.round(area / floors);
      const costPerFloor = Math.round(totalProjectCost / floors);

      for (let i = 1; i <= floors; i++) {
        const floorName = i === 1 ? 'Ground Floor' : `Floor ${i - 1} / Level ${i}`;
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><strong>${floorName}</strong></td>
          <td>${areaPerFloor.toLocaleString('en-IN')} sq.ft</td>
          <td>₹${Math.round(costPerFloor / areaPerFloor).toLocaleString('en-IN')}</td>
          <td class="text-end fw-bold text-navy">${formatINR(costPerFloor)}</td>
        `;
        floorBreakdownTbody.appendChild(tr);
      }
    }
  }

  function formatINR(number) {
    if (number >= 10000000) {
      return '₹' + (number / 10000000).toFixed(2) + ' Crores';
    } else if (number >= 100000) {
      return '₹' + (number / 100000).toFixed(2) + ' Lakhs';
    }
    return '₹' + Math.round(number).toLocaleString('en-IN');
  }

  // Initial run
  calculateEstimate();

  // Print/Download PDF Quotation Trigger
  const downloadPdfBtn = document.getElementById('btn-download-estimate-pdf');
  if (downloadPdfBtn) {
    downloadPdfBtn.addEventListener('click', function () {
      window.print();
    });
  }
});
