async function loadEnergie() {
    const res = await fetch("get_energie.php");
    const json = await res.json();

    if (!json.success) return;

    const energies = json.data;

    // Définition de bins logarithmiques
    const logBins = [
        1e9, 3e9,
        1e10, 3e10,
        1e11, 3e11
    ];

    // Comptage par bin (6 bins)
    let histogram = Array(logBins.length - 1).fill(0);

    energies.forEach(E => {
        for (let i = 0; i < logBins.length - 1; i++) {
            if (E >= logBins[i] && E < logBins[i+1]) {
                histogram[i]++;
                break;
            }
        }
    });

    // Labels jolis
    const labels = [
        "1–3 ×10⁹ J",
        "3–10 ×10⁹ J",
        "10–30 ×10⁹ J",
        "30–100 ×10⁹ J",
        "100–300 ×10⁹ J"
    ];

    new Chart(document.getElementById("energieChart"), {
        type: "bar",
        data: {
            labels,
            datasets: [{
                label: "Nombre de bolides",
                data: histogram,
                backgroundColor: "rgba(0,180,255,0.35)",
                borderColor: "rgb(0,180,255)",
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    type: "logarithmic",
                    ticks: { color: "#fff" },
                    title: {
                        display: true,
                        text: "Nombre (échelle logarithmique)",
                        color: "#fff"
                    }
                },
                x: {
                    ticks: { color: "#fff" }
                }
            },
            plugins: {
                legend: {
                    labels: { color: "#fff" }
                }
            }
        }
    });
}

document.addEventListener("DOMContentLoaded", loadEnergie);
