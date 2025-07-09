document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formAdd");

    if (!form) {
        console.log("⛔ Formulaire non trouvé !");
        return;
    }

    console.log("✅ Script JS chargé, prêt à intercepter le submit");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        console.log("📤 Envoi AJAX...");

        const formData = new FormData(form);

        try {
            const response = await fetch("add_handler.php", {
                method: "POST",
                body: formData
            });

            const result = await response.text();
            console.log("📦 Réponse :", result);

            if (result.trim() === "OK") {
                window.parent.location.reload(); // recharge l’index
            } else {
                alert("❌ Erreur : " + result);
            }
        } catch (error) {
            console.error("🚨 Erreur AJAX :", error);
            alert("Une erreur est survenue.");
        }
    });
});
