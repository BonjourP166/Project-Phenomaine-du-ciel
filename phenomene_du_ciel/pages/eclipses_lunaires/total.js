// === scatter.js ===

fetch("get_total.php")
    .then(res => res.json())
    .then(result => {

        if (!result.success) {
            console.error("Erreur chargement scatter lunaire");
            return;
        }

        const data = result.data;

        // Regroupement par type
        const penombrale = [];
        const partielle = [];
        const totale = [];

        data.forEach(e => {
            if (e.type === "Pénombrale") penombrale.push({ x: "Pénombrale", y: e.duree });
            if (e.type === "Partielle") partielle.push({ x: "Partielle", y: e.duree });
            if (e.type === "Totale") totale.push({ x: "Totale", y: e.duree });
        });

        const ctx = document.getElementById("scatterLuneChart").getContext("2d");

        new Chart(ctx, {
            type: "scatter",
            data: {
                datasets: [
                    {
                        label: "Pénombrales",
                        data: penombrale,
                        backgroundColor: "rgba(255, 200, 120, 0.8)"
                    },
                    {
                        label: "Partielles",
                        data: partielle,
                        backgroundColor: "rgba(140, 120, 255, 0.8)"
                    },
                    {
                        label: "Totales",
                        data: totale,
                        backgroundColor: "rgba(255, 90, 80, 0.9)"
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        type: "category",
                        labels: ["Pénombrale", "Partielle", "Totale"],
                        title: {
                            display: true,
                            text: "Type d’éclipse"
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Durée totale (min)"
                        }
                    }
                }
            }
        });

    })
    .catch(() => console.error("Erreur scatter lunaire"));
