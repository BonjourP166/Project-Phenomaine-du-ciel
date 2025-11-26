// === classes.js : Top classes + Autres ===
fetch("get_classes.php")
    .then(r => r.json())
    .then(data => {
        if (!data.success) return console.error(data.error);

        const rows = data.classes;

        // Top 8 classes, le reste en "Autres"
        const topN = 8;
        const top = rows.slice(0, topN);
        const others = rows.slice(topN);

        const labels = top.map(x => x.classe_meteo);
        const values = top.map(x => Number(x.nb));

        const sumOthers = others.reduce((s, x) => s + Number(x.nb), 0);
        if (sumOthers > 0) {
            labels.push("Autres");
            values.push(sumOthers);
        }

        new Chart(document.getElementById("classesChart"), {
            type: "doughnut",
            data: {
                labels,
                datasets: [{ data: values, borderWidth: 1 }]
            },
            options: {
                plugins: {
                    legend: { labels: { color: "#fff" } }
                }
            }
        });
    })
    .catch(err => console.error(err));
