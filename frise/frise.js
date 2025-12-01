document.addEventListener('DOMContentLoaded', () => {

    const popup = document.getElementById('timelinePopup');
    const closeBtn = popup.querySelector('.closePopup');
    const popupDate = document.getElementById('popupDate');

    // ============================
    // 1. POPUP CLICK BEHAVIOR
    // ============================

    popup.addEventListener('click', e => e.stopPropagation());

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (popup.style.display === 'block' && !popup.contains(e.target) && !e.target.closest('.event-block')) {
            popup.style.display = 'none';
        }
    });

    // ============================
    // 2. POPUP TAB SYSTEM
    // ============================

    const popupTabs = popup.querySelectorAll('.tab-btn');

    popupTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            popupTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            popup.querySelectorAll('.tab-table').forEach(tbl => tbl.style.display = 'none');

            const table = document.getElementById(tab.dataset.type + 'Table');
            if (table) table.style.display = 'table';
        });
    });

    // ============================
    // 3. EVENT-BLOCK CLICK (OPEN POPUP)
    // ============================

    document.querySelectorAll('.event-block').forEach(block => {
    block.addEventListener('click', e => {
        e.stopPropagation();

        const year = block.dataset.year;
        const type = block.dataset.type;
        const info = block.dataset.info;

        popupDate.textContent = 'Année: ' + year;

        // Clear all tables
        ['meteorite', 'bolide', 'solaire', 'lunaire'].forEach(t => {
            const tbody = document.getElementById(t + 'Table').querySelector('tbody');
            tbody.innerHTML = '';
        });

        // Fill the correct table
        const tbody = document.getElementById(type + 'Table').querySelector('tbody');
        const parts = info.split(' | '); // Split each item

        parts.forEach(p => {
            const tr = document.createElement('tr');

            // NEW: clean parsing using comma
            const values = p.split(',');  // split name/type and numeric value
            tr.innerHTML = `<td>${values[0] || ''}</td><td>${values[1] || ''}</td>`;

            tbody.appendChild(tr);
        });

        // Show popup
        popup.style.display = 'block';

        // Activate the correct tab
        popupTabs.forEach(t => t.classList.remove('active'));
        const activeTab = popup.querySelector(`.tab-btn[data-type="${type}"]`);
        if (activeTab) activeTab.classList.add('active');

        // Show the corresponding table
        popup.querySelectorAll('.tab-table').forEach(tbl => tbl.style.display = 'none');
        document.getElementById(type + 'Table').style.display = 'table';
    });
});


    // ============================
    // 4. FILTER BUTTONS (OUTSIDE POPUP)
    // ============================

    const filterButtons = document.querySelectorAll(".popup-tabs .tab-btn");
    const timelineDates = document.querySelectorAll(".timeline-date");

    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            filterButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const selectedType = btn.dataset.type;

            timelineDates.forEach(dateDiv => {
                const eventBlocks = dateDiv.querySelectorAll(".event-block");
                let hasVisible = false;

                eventBlocks.forEach(block => {
                    if (selectedType === "all" || block.dataset.type === selectedType) {
                        block.style.display = "block";
                        hasVisible = true;
                    } else {
                        block.style.display = "none";
                    }
                });

                dateDiv.style.display = hasVisible ? "flex" : "none";
            });
        });
    });

});
