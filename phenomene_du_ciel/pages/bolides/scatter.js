async function loadScatter() {
    const res = await fetch("get_scatter.php");
    const json = await res.json();

    if (!json.success) return;

    const data = json.data;

    new Chart(document.getElementById("scatterChart"), {
        type: "scatter",
        data: {
            datasets: [{
                label: "Vitesse vs Énergie",
                data: data.map(b => ({
                    x: b.vitesse,
                    y: b.energie
                })),
                backgroundColor: "rgba(255,80,80,0.9)"
            }]
        },
        options: {
            scales: {
                x: { title: { display: true, text: "Vitesse (km/s)" } },
                y: { 
                    title: { display: true, text: "Énergie (J)" },
                    type: "logarithmic"
                }
            }
        }
    });
}

document.addEventListener("DOMContentLoaded", loadScatter);
