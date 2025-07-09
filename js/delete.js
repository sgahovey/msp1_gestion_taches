document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formDelete");

    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("delete_handler.php", {
                method: "POST",
                body: formData
            });

            const result = await response.text();
            if (result.trim() === "OK") {
                window.parent.location.reload();
            } else {
                alert("❌ Erreur : " + result);
            }
        } catch (error) {
            console.error("Erreur AJAX :", error);
            alert("Une erreur s'est produite.");
        }
    });
});
