let connexionForm = document.getElementById("connexion");

let idUser = document.getElementById("iduser");
let mdp = document.getElementById("mdp");

let errorDiv = document.getElementById("errorDiv");

let errorList = document.getElementById("errorList");


connexionForm.addEventListener('submit', (e) => {
    if (idUser.value === "") {
        e.preventDefault();
        idUser.classList.add('is-invalid');
        alert('Le champ id est vide');
        // errorDiv.classList.remove('d-none');
        // errorList.textContent = "Champ id vide";
        return false;
    }

    if (mdp.value === "") {
        e.preventDefault();
        // mdpError.textContent = "Champ vide";
        mdp.classList.add('is-invalid');
        //  errorDiv.classList.remove('d-none');
        // errorList.textContent = "Champ mot de passe vide";
        alert('Le champ mot de passe est vide');
        return false;
    }

    return true;
});

