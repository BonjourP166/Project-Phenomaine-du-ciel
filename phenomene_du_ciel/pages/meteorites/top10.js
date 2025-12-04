fetch("get_top10.php")
    .then(r => r.json())
    .then(data => {

        if (!data.success) return;

        const top10 = data.top10;

        const podiumDiv = document.getElementById("podium");
        const list = document.getElementById("rankingList");

        // --- Podium (Top 3) ---
        const medals = ["🥇", "🥈", "🥉"];

        top10.slice(0,3).forEach((m,i) => {
            const card = document.createElement("div");
            card.className = "podium-card";

            const masse = m.masse >= 1000 
                ? (m.masse / 1000).toFixed(1) + " kg"
                : m.masse + " g";

            card.innerHTML = `
                <div class="podium-medal">${medals[i]}</div>
                <h4> ${m.nom}</h4>
                <p><strong> Masse :</strong> ${masse}</p>
                <p><strong> Classe :</strong> ${m.classe_meteo}</p>
                <p><strong></strong> ${m.latitude}, ${m.longitude}</p>
            `;

            podiumDiv.appendChild(card);
        });

        // --- Rang #4 à #10 (liste compacte) ---
        top10.slice(3).forEach((m,i) => {

            const li = document.createElement("li");

            const masse = m.masse >= 1000
                ? (m.masse / 1000).toFixed(1) + " kg"
                : m.masse + " g";

            li.innerHTML = `
                <span class="rank-num">#${i+4}</span>
                <span class="name"> ${m.nom}</span>
                <span class="mass">${masse}</span>
            `;

            list.appendChild(li);
        });

    });
