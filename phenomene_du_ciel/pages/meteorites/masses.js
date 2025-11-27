// === masses.js : Masses moyennes par classe ===


// Charger les données depuis data_meteorites.php (ou ton API)
fetch("get_masses.php")
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error("Erreur API :", data.error);
            return;
        }

        const meteors = data.meteorites;

        // Regrouper les masses par classe
        const groups = {};

        meteors.forEach(m => {
            const classe = m.classe_meteo || "Inconnue";
            const masse = parseFloat(m.masse);

            if (!isNaN(masse)) {
                if (!groups[classe]) groups[classe] = [];
                groups[classe].push(masse);
            }
        });

        // Construire labels + moyennes
        const labels = [];
        const moyennes = [];

        for (let classe in groups) {
            labels.push(classe);

            const arr = groups[classe];
            const moyenne = arr.reduce((a, b) => a + b, 0) / arr.length;

            moyennes.push(Math.round(moyenne));
        }

        // === AFFICHAGE CHART.JS ===
        const ctx = document.getElementById("massesChart").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Masse moyenne (g)",
                    data: moyennes,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: { color: "#fff" }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: "#fff" }
                    },
                    y: {
                        ticks: { color: "#fff" }
                    }
                }
            }
        });

    })
    .catch(error => {
        console.error("Erreur fetch :", error);
    });
