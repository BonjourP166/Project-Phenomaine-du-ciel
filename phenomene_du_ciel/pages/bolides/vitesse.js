async function loadVitesse() {
    const res = await fetch("get_vitesse.php");
    const json = await res.json();

    if (!json.success) return;

    const speeds = json.data;

    const ctx = document.getElementById("vitesseChart");

    new Chart(ctx, {
        type: "boxplot",
        data: {
            labels: ["Distribution des vitesses"],
            datasets: [{
                label: "Vitesses (km/s)",
                data: [speeds],
                borderColor: "rgb(255,185,80)",
                backgroundColor: "rgba(255,185,80,0.25)",
                borderWidth: 2,
                outlierColor: "rgba(255,50,50,0.8)"
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: "#fff"
                    }
                }
            },
            scales: {
                y: {
                    ticks: { color: "#fff" },
                    title: {
                        display: true,
                        text: "Vitesse (km/s)",
                        color: "#fff"
                    }
                },
                x: {
                    ticks: { color: "#fff" }
                }
            }
        }
    });
}

document.addEventListener("DOMContentLoaded", loadVitesse);
