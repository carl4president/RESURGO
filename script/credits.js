document.addEventListener("DOMContentLoaded", function() {
    // Function to setup tabs for each set
    function setupTabs(skillsTab, experienceTab, certificationTab, skillsBtn, experienceBtn, certificationBtn) {
        const tabContainer = skillsBtn.parentElement;

        // Create highlight bar
        const highlightBar = document.createElement("div");
        highlightBar.classList.add("absolute", "h-1", "w-10", "rounded-md", "mt-1", "bg-accent");
        tabContainer.appendChild(highlightBar);

        // Function to update highlight bar position
        function updateHighlightBar(tab) {
            const rect = tab.getBoundingClientRect();
            highlightBar.style.left = rect.left + "px";
            highlightBar.style.width = rect.width + "px";
            highlightBar.style.visibility = "visible";
        }

        // Function to highlight active tab
        function highlightTab(tab) {
            [skillsBtn, experienceBtn, certificationBtn].forEach(btn => {
                if (btn === tab) {
                    btn.classList.add("text-accent");
                } else {
                    btn.classList.remove("text-accent");
                }
            });
        }

        // Initial setup
        experienceTab.style.display = "none"; 
        certificationTab.style.display = "none";
        updateHighlightBar(skillsBtn);

        // Event listeners for each tab
        skillsBtn.addEventListener("click", function() {
            skillsTab.style.display = "block";
            experienceTab.style.display = "none";
            certificationTab.style.display = "none";
            updateHighlightBar(skillsBtn);
            highlightTab(skillsBtn);
        });

        experienceBtn.addEventListener("click", function() {
            skillsTab.style.display = "none";
            experienceTab.style.display = "block";
            certificationTab.style.display = "none";
            updateHighlightBar(experienceBtn);
            highlightTab(experienceBtn);
        });

        certificationBtn.addEventListener("click", function() {
            skillsTab.style.display = "none";
            experienceTab.style.display = "none";
            certificationTab.style.display = "block";
            updateHighlightBar(certificationBtn);
            highlightTab(certificationBtn);
        });
    }

    // Setup for each set of tabs
    setupTabs(
        document.getElementById("skillsContent"),
        document.getElementById("experienceContent"),
        document.getElementById("certificationContent"),
        document.getElementById("skillsTab"),
        document.getElementById("experienceTab"),
        document.getElementById("certificationTab")
    );

    setupTabs(
        document.getElementById("skillsContent-1"),
        document.getElementById("experienceContent-1"),
        document.getElementById("certificationContent-1"),
        document.getElementById("skillsTab-1"),
        document.getElementById("experienceTab-1"),
        document.getElementById("certificationTab-1")
    );

    setupTabs(
        document.getElementById("skillsContent-2"),
        document.getElementById("experienceContent-2"),
        document.getElementById("certificationContent-2"),
        document.getElementById("skillsTab-2"),
        document.getElementById("experienceTab-2"),
        document.getElementById("certificationTab-2")
    );

    setupTabs(
        document.getElementById("skillsContent-3"),
        document.getElementById("experienceContent-3"),
        document.getElementById("certificationContent-3"),
        document.getElementById("skillsTab-3"),
        document.getElementById("experienceTab-3"),
        document.getElementById("certificationTab-3")
    );

    setupTabs(
        document.getElementById("skillsContent-4"),
        document.getElementById("experienceContent-4"),
        document.getElementById("certificationContent-4"),
        document.getElementById("skillsTab-4"),
        document.getElementById("experienceTab-4"),
        document.getElementById("certificationTab-4")
    );

    setupTabs(
        document.getElementById("skillsContent-5"),
        document.getElementById("experienceContent-5"),
        document.getElementById("certificationContent-5"),
        document.getElementById("skillsTab-5"),
        document.getElementById("experienceTab-5"),
        document.getElementById("certificationTab-5")
    );

    
});