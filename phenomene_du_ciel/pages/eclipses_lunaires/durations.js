// === durations.js ===

fetch("get_durations.php")
    .then(res => res.json())
    .then(result => {

        if (!result.success) {
            console.error("Erreur données durées moyennes");
            return;
        }

        const data = result.data;

        const ctx = document.getElementById('lunarDurationChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Pénombrale", "Partielle", "Totale"],
                datasets: [{
                    label: "Durée moyenne (min)",
                    data: [
                        data.penombre,
                        data.partielle,
                        data.totale
                    ],
                    backgroundColor: [
                        "rgba(173, 129, 255, 0.6)",
                        "rgba(129, 165, 255, 0.6)",
                        "rgba(88, 111, 255, 0.6)"
                    ],
                    borderColor: [
                        "rgba(173, 129, 255, 1)",
                        "rgba(129, 165, 255, 1)",
                        "rgba(88, 111, 255, 1)"
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Minutes"
                        }
                    }
                }
            }
        });

    })
    .catch(() => {
        console.error("Impossible de récupérer les durées moyennes");
    });
