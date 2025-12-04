document.addEventListener("DOMContentLoaded", () => {

    const loading = document.getElementById("loading-bolides");
    const tableBody = document.querySelector("#table-bolides tbody");

    fetch("get_sample.php")
        .then(res => res.json())
        .then(data => {

            // Erreur côté PHP
            if (!data.success) {
                loading.textContent = "❌ Impossible de charger les données.";
                console.error(data.error);
                return;
            }

            loading.style.display = "none";

            data.bolides.forEach(b => {
                const tr = document.createElement("tr");

                tr.innerHTML = `
                    <td>${b.date}</td>
                    <td>${b.ville}</td>
                    <td>${b.pays}</td>
                    <td>${b.vitesse_kms}</td>
                    <td>${b.energie_totale_rayonne_j}</td>
                `;

                tableBody.appendChild(tr);
            });
        })
        .catch(err => {
            loading.textContent = "❌ Erreur lors du chargement.";
            console.error(err);
        });

});