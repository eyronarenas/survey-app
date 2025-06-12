document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("surveyForm");
    const toast = document.getElementById("toast");

   
    document.querySelectorAll('.option').forEach(button => {
        button.addEventListener('click', () => {
            const group = button.closest('.options');
            const input = group.nextElementSibling;
            group.querySelectorAll('.option').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            input.value = button.dataset.value;
        });
    });

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const missing = [...form.querySelectorAll('input[type="hidden"]')].some(i => !i.value);
        if (missing) return alert("Please answer all questions.");

        fetch("submit.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                form.reset();
                document.querySelectorAll(".option.selected").forEach(el => el.classList.remove("selected"));
                showToast();
            } else {
                alert(data.message || "Submission failed.");
            }
        })
        .catch(() => alert("Network error."));
    });

    function showToast() {
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 3000);
    }
});
