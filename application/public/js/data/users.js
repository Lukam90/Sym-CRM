function _delete(button) {
    setToken(button, "delete");

    let user = getData(button);

    $("#delete-title").textContent = "Suppression d'un utilisateur";
    $("#delete-form").action = `/users/delete/${user.id}`;
    $("#deleteName").textContent = user.fullName;
}

function _edit(button) {
    setToken(button, "modal");

    let user = getData(button);

    $("#modal-title").textContent = "Edition d'un utilisateur";
    $("#modal-form").action = `/users/edit/${user.id}`;
    $("#modalName").textContent = user.fullName;

    setOptions("role", user.role);
}

function validate(button) {
    const minMessage = "Le mot de passe doit contenir au moins ";

    const password = $("#password").value;

    // Password validation

    const hasLowerAlpha = /[a-z]+/.test(password);

    $("#password_error").innerHTML = "";

    if (! hasLowerAlpha) {
        $("#password_error").innerHTML += `${minMessage} une minuscule.<br />`;
    }

    const hasUpperAlpha = /[A-Z]+/.test(password);

    if (! hasUpperAlpha) {
        $("#password_error").innerHTML += `${minMessage} une majuscule.<br />`;
    }

    const hasDigit = /[0-9]+/.test(password);

    if (! hasDigit) {
        $("#password_error").innerHTML += `${minMessage} un chiffre.<br />`;
    }

    // Password confirmation

    const confirm = $("#confirm_password").value;

    if (password === confirm) {
        $("#confirm_error").textContent = "";
    } else {
        $("#confirm_error").textContent = "Les mots de passe doivent correspondre.";

        button.preventDefault();
    }
}

function register(link) {
    setToken(link, "modal");

    $("#modal-title").textContent = "Inscription";
    $("#modal-form").action = "/register";
    $("#modalSubmit").addEventListener("click", validate);
}