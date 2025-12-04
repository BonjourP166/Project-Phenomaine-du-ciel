async function loadScatter() {
    const res = await fetch("get_scatter.php");
    const json = await res.json();

    if (!json.success) return console.error(json.error);

    const data = json.data;

    new Chart(document.getElementById("scatterEclipseChart"), {
        type: "scatter",
        data: {
            datasets: [{
                label: "Magnitude vs Durée (s)",
                data: data.map(e => ({
                    x: e.magnitude,
                    y: e.duration
                })),
                backgroundColor: "rgba(255,80,80,0.9)"
            }]
        },
        options: {
            scales: {
                x: { title: { display: true, text: "Magnitude" } },
                y: { title: { display: true, text: "Durée (secondes)" } }
            }
        }
    });
}

document.addEventListener("DOMContentLoaded", loadScatter);
