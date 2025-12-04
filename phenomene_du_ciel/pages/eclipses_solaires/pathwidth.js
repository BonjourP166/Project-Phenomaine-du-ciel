// ========================================
// GRAPH LARGEUR : Courbe brute + moyenne mobile
// ========================================

document.addEventListener("DOMContentLoaded", async () => {
    try {
        const res = await fetch("get_pathwidth.php");
        const json = await res.json();

        if (!json.success) {
            console.error("Erreur API largeur :", json.error);
            return;
        }

        // Extraction
        const labels = json.data.map(d => d.id);
        const values = json.data.map(d => d.largeur);

        // ============
        // MOYENNE MOBILE
        // ============
        function movingAverage(data, windowSize = 20) {
            let result = [];
            for (let i = 0; i < data.length; i++) {
                let start = Math.max(0, i - windowSize);
                let subset = data.slice(start, i + 1);
                let avg = subset.reduce((a, b) => a + b, 0) / subset.length;
                result.push(avg);
            }
            return result;
        }

        const smoothed = movingAverage(values, 25); // lisser plus ou moins

        // ============
        // GRAPH
        // ============
        const canvas = document.getElementById("pathWidthChart");
        const ctx = canvas.getContext("2d");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Largeur brute (km)",
                        data: values,
                        borderColor: "rgba(0,140,255,0.35)",
                        backgroundColor: "rgba(0,140,255,0.15)",
                        borderWidth: 1.2,
                        pointRadius: 0,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: "Tendance lissée",
                        data: smoothed,
                        borderColor: "rgba(255,185,80,0.9)",
                        backgroundColor: "rgba(255,185,80,0.12)",
                        borderWidth: 3,
                        pointRadius: 0,
                        tension: 0.4,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: "#ffffff",
                            font: { size: 13 }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: "#d0dcff", maxRotation: 0 },
                        grid: { color: "rgba(255,255,255,0.06)" }
                    },
                    y: {
                        ticks: { color: "#d0dcff" },
                        grid: { color: "rgba(255,255,255,0.07)" }
                    }
                }
            }
        });

    } catch (err) {
        console.error("Erreur graphique largeur :", err);
    }
});
