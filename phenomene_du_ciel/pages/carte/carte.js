// =====================================
// 🌍 INITIALISATION DE LA CARTE LEAFLET
// =====================================
let geoLayer = null;
let countryStats = {};  // stats renvoyées par la BDD
let statsLoaded = false;

const map = L.map("map", {
    minZoom: 2,
    maxZoom: 7, /* tu peux ajuster si tu veux zoomer plus */
    zoomSnap: 0.25,
    zoomControl: true
}).setView([20, 0], 2);

// Fond sombre premium
L.tileLayer('https://cartodb-basemaps-a.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {
    maxZoom: 18
}).addTo(map);



// =====================================
// 📡 Chargement des statistiques depuis PHP
// =====================================
async function loadStats() {
    try {
        const res = await fetch("get_map_data.php");
        const data = await res.json();

        countryStats = {};
        data.forEach(row => {
            countryStats[row.iso3] = row;
        });

        statsLoaded = true;
        applyFilters();

    } catch (e) {
        console.error("Erreur chargement des stats:", e);
    }
}



// =====================================
// 🗺️ Chargement du GeoJSON (fond de carte)
// =====================================
fetch("data/countries.geojson")
    .then(r => r.json())
    .then(geojson => {

        geoLayer = L.geoJSON(geojson, {

            // Style initial de chaque pays
            style: {
                color: "#00aaff",
                weight: 1,
                fillColor: "#000",
                fillOpacity: 0.5
            },

            onEachFeature: (feature, layer) => {
                const iso = feature.properties.adm0_a3;

                // État du pays : normal / active / inactive
                layer.currentStatus = "normal";

                // 🔵 SURVOL
                layer.on("mouseover", () => {
                    layer.setStyle({
                        weight: 2,
                        fillOpacity: 0.9
                    });
                    layer.bringToFront();
                });

                // 🔵 SORTIE SURVOL
                layer.on("mouseout", () => {
                    if (layer.currentStatus === "active") {
                        layer.setStyle({
                            fillColor: "#008cff",
                            fillOpacity: 0.85,
                            weight: 1
                        });
                    } else if (layer.currentStatus === "inactive") {
                        layer.setStyle({
                            fillColor: "#2a2a2a",
                            fillOpacity: 0.15,
                            weight: 1
                        });
                    } else {
                        layer.setStyle({
                            fillColor: "#000",
                            fillOpacity: 0.5,
                            weight: 1
                        });
                    }
                });

                // 🔵 CLIC SUR UN PAYS → redirection vers pays.php
                layer.on("click", () => {
                    const url = new URL("pays.php", window.location.href);

                    url.searchParams.set("code", iso);
                    url.searchParams.set("phenomenon", document.getElementById("phenomenon-filter")?.value || "all");
                    url.searchParams.set("activity",   document.getElementById("activity-filter")?.value || "all");
                    url.searchParams.set("rarity",     document.getElementById("rarity-filter")?.value || "all");
                    url.searchParams.set("multi",      document.getElementById("multi-filter")?.value || "all");
                    url.searchParams.set("period",     document.getElementById("period-filter")?.value || "all");

                    window.location.href = url.toString();
                });
            }

        });

        geoLayer.addTo(map);
        applyFilters();

    })
    .catch(err => console.error("Erreur GeoJSON:", err));



// =====================================
// 📌 Lecture des filtres DOM
// =====================================
function getFilterValues() {
    return {
        phenomenon: document.getElementById("phenomenon-filter")?.value || "all",
        activity:   document.getElementById("activity-filter")?.value || "all",
        rarity:     document.getElementById("rarity-filter")?.value || "all",
        multi:      document.getElementById("multi-filter")?.value || "all",
        period:     document.getElementById("period-filter")?.value || "all"
    };
}



// =====================================
// 🎛️ APPLICATION DES FILTRES COMBINÉS
// =====================================
function applyFilters() {
    if (!geoLayer || !statsLoaded) return;

    const { phenomenon, activity, rarity, multi, period } = getFilterValues();

    geoLayer.eachLayer(layer => {
        const iso = layer.feature.properties.adm0_a3;
        const stat = countryStats[iso];
        let isActive = true;

        // 1️⃣ PHÉNOMÈNE
        if (phenomenon !== "all") {
            if (!stat || !stat.phenomena || !stat.phenomena[phenomenon] || stat.phenomena[phenomenon] <= 0) {
                isActive = false;
            }
        }

        // 2️⃣ ACTIVITÉ
        if (isActive && activity !== "all") {
            if (!stat || stat.activity_level !== activity) {
                isActive = false;
            }
        }

        // 3️⃣ RARETÉ
        if (isActive && rarity !== "all") {
            if (rarity === "rare" && (!stat || !stat.has_rare)) {
                isActive = false;
            }
            if (rarity === "no_rare" && stat && stat.has_rare) {
                isActive = false;
            }
        }

        // 4️⃣ MULTI-PHÉNOMÈNES
        if (isActive && multi !== "all") {
            if (multi === "multi" && (!stat || !stat.is_multi)) {
                isActive = false;
            }
            if (multi === "mono" && stat && stat.is_multi) {
                isActive = false;
            }
        }

        // 5️⃣ PÉRIODE (récents / historiques)
        if (isActive && period !== "all") {
            if (!stat) isActive = false;
            else if (period === "recent" && stat.recent_events <= 0) isActive = false;
            else if (period === "historic" && stat.historic_events <= 0) isActive = false;
        }

        // 🎨 APPLICATION DES COULEURS
        if (isActive) {
            layer.currentStatus = "active";
            layer.setStyle({
                fillColor: "#008cff",
                fillOpacity: 0.85,
                weight: 1
            });
            layer.bringToFront();
        } else {
            const filtersActive = (
                phenomenon !== "all" ||
                activity   !== "all" ||
                rarity     !== "all" ||
                multi      !== "all" ||
                period     !== "all"
            );

            if (!stat && !filtersActive) {
                layer.currentStatus = "normal";
                layer.setStyle({
                    fillColor: "#000",
                    fillOpacity: 0.5,
                    weight: 1
                });
            } else {
                layer.currentStatus = "inactive";
                layer.setStyle({
                    fillColor: "#2a2a2a",
                    fillOpacity: 0.15,
                    weight: 1
                });
            }
        }
    });
}



// =====================================
// 🎚️ ÉCOUTEURS SUR LES FILTRES
// =====================================
["phenomenon-filter", "activity-filter", "rarity-filter", "multi-filter", "period-filter"]
    .forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener("change", applyFilters);
    });


// Charger les stats au chargement
loadStats();

document.getElementById("reset-filters")?.addEventListener("click", () => {
    const ids = [
        "phenomenon-filter",
        "activity-filter",
        "rarity-filter",
        "multi-filter",
        "period-filter"
    ];

    ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = "all";
    });

    applyFilters();
});