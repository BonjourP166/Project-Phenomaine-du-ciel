document.addEventListener("DOMContentLoaded", () => {
  fetch("get_sample.php")
    .then(r => r.json())
    .then(res => {

      if (!res.success) {
        console.error(res.error);
        return;
      }

      const tbody = document.querySelector("#table-meteorites tbody");
      document.getElementById("loading-sample").style.display = "none";

      res.data.forEach(item => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${item.nom}</td>
          <td>${item.masse ?? "—"}</td>
          <td>${item.classe_meteo ?? "—"}</td>
          <td>${item.type_meteorite ?? "—"}</td>
          <td>${item.pays}</td>
          <td>${item.annee ?? "—"}</td>
        `;
        tbody.appendChild(tr);
      });

    })
    .catch(err => console.error("Erreur sample:", err));
});
