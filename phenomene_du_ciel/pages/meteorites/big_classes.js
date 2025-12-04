// === big_classes_mass.js : Masse moyenne par grandes familles ===
fetch("get_masses.php")
    .then(r => r.json())
    .then(data => {
        if (!data.success) return console.error(data.error);

        const meteors = data.meteorites;

        // Fonction de regroupement ludique en grandes familles
        function famille(classe) {
            if (!classe) return "Autres";
            const c = classe.toUpperCase().trim();

            if (c.startsWith("H")) return "H (chondrites)";
            if (c.startsWith("L") && !c.startsWith("LL")) return "L (chondrites)";
            if (c.startsWith("LL")) return "LL (chondrites)";
            if (c.includes("IRON") || c.includes("FE")) return "Iron (ferreuses)";
            if (c.includes("CARBON") || c.startsWith("C")) return "Carbonées";
            if (c.includes("ACHON") || c.includes("EUCR") || c.includes("DIOG")) return "Achondrites";

            return "Autres";
        }

        const groups = {};

        meteors.forEach(m => {
            const fam = famille(m.classe_meteo);
            const mass = parseFloat(m.masse);

            if (!isNaN(mass)) {
                if (!groups[fam]) groups[fam] = [];
                groups[fam].push(mass);
            }
        });

        const labels = Object.keys(groups);
        const moy = labels.map(l => {
            const arr = groups[l];
            return Math.round(arr.reduce((a, b) => a + b, 0) / arr.length);
        });

        new Chart(document.getElementById("bigClassesMassChart"), {
            type: "bar",
            data: {
                labels,
                datasets: [{
                    label: "Masse moyenne (g)",
                    data: moy,

                    // 🎨 STYLE PREMIUM NASA
                    borderWidth: 2,
                    borderColor: "rgba(0, 150, 255, 0.9)",
                    backgroundColor: "rgba(0, 150, 255, 0.45)",
                    borderRadius: 12
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: { color: "#fff" }
                    }
                },

                // 🎯 AXE LOGARITHMIQUE (hyper important)
                scales: {
                    x: {
                        ticks: { color: "#fff" },
                        grid: { color: "rgba(255,255,255,0.08)" }
                    },
                    y: {
                        type: "logarithmic",
                        ticks: {
                            color: "#fff",
                            callback: function (value) {
                                return value.toLocaleString(); // Format propre
                            }
                        },
                        grid: { color: "rgba(255,255,255,0.08)" }
                    }
                }
            }
        });
    })
    .catch(err => console.error(err));
