// donut.js – donut eclipses solaires

fetch("get_types.php")
  .then(res => res.json())
  .then(data => {
    if (!data.success) {
      console.error("Erreur Donut :", data.error);
      return;
    }

    const labels = data.data.map(d => d.label);
    const values = data.data.map(d => d.total);

    const ctx = document.getElementById("donutEclipse");

    new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: [
            "rgba(255,185,80,0.75)",   // OR
            "rgba(0,140,255,0.55)",    // BLEU
            "rgba(255,220,130,0.80)",  // OR CLAIR
            "rgba(120,170,255,0.65)"   // BLEU CLAIR
          ],
          borderColor: "rgba(255,255,255,0.35)",
          borderWidth: 2,
          hoverOffset: 18
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: {
              color: "#fff",
              font: { size: 14 }
            }
          }
        }
      }
    });
  });
