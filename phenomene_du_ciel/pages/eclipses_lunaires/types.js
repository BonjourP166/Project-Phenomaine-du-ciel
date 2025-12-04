async function loadLunarTypes() {

    const res = await fetch("get_types.php");
    const json = await res.json();

    if (!json.success) return console.error(json.error);

    const entries = Object.entries(json.data);
    const labels = entries.map(e => e[0]);
    const values = entries.map(e => e[1]);

    new Chart(document.getElementById("lunarTypeChart"), {
        type: "pie",
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    "rgba(255,100,100,0.8)",
                    "rgba(100,255,100,0.8)",
                    "rgba(100,100,255,0.8)",
                    "rgba(255,200,0,0.8)",
                    "rgba(200,0,255,0.8)"
                ]
            }]
        }
    });
}

document.addEventListener("DOMContentLoaded", loadLunarTypes);
