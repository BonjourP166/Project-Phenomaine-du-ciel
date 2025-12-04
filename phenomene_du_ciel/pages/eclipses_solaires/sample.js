document.addEventListener("DOMContentLoaded", () => {
    const loading = document.getElementById("loading-solaire");
    const tableBody = document.querySelector("#table-solaire tbody");

    fetch("get_sample.php")
        .then(response => response.json())
        .then(result => {

            if (!result.success) {
                loading.innerHTML = "❌ Erreur lors du chargement des données";
                return;
            }

            loading.style.display = "none";

            result.data.forEach(row => {
                const tr = document.createElement("tr");

                tr.innerHTML = `
                    <td>${row.mois}/${row.annee}</td>
                    <td>${row.central_duration}</td>
                    <td>${row.pays}</td>
                    <td>${row.ville}</td>
                    <td>${row.path_width_km}</td>
                `;

                tableBody.appendChild(tr);
            });
        })
        .catch(() => {
            loading.innerHTML = "❌ Impossible de récupérer les données";
        });
});
