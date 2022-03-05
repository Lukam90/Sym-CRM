function _delete(button) {
    setToken(button, "delete");

    let user = getData(button);

    $("#delete-title").textContent = "Suppression d'un utilisateur";
    $("#delete-form").action = `/users/delete/${user.id}`;
    $("#delete-name").textContent = user.fullName;
}

function _edit(button) {
    setToken(button, "modal");

    let user = getData(button);

    $("#modal-title").textContent = "Edition d'un utilisateur";
    $("#modal-form").action = `/users/edit/${user.id}`;
    $("#modal-name").textContent = user.fullName;

    setOptions("role", user.role);
}

function validate(button) {
    const minMessage = "Le mot de passe doit contenir au moins ";

    const password = $("#password").value;

    // Password validation

    const hasLowerAlpha = /[a-z]+/.test(password);

    $("#password-error").innerHTML = "";

    if (! hasLowerAlpha) {
        $("#password-error").innerHTML += `${minMessage} une minuscule.<br />`;
    }

    const hasUpperAlpha = /[A-Z]+/.test(password);

    if (! hasUpperAlpha) {
        $("#password-error").innerHTML += `${minMessage} une majuscule.<br />`;
    }

    const hasDigit = /[0-9]+/.test(password);

    if (! hasDigit) {
        $("#password-error").innerHTML += `${minMessage} un chiffre.<br />`;
    }

    // Password confirmation

    const confirm = $("#confirm-password").value;

    if (password === confirm) {
        $("#confirm-error").textContent = "";
    } else {
        $("#confirm-error").textContent = "Les mots de passe doivent correspondre.";

        button.preventDefault();
    }
}

function testRegister() {
    setValue();
}

function register(link) {
    setToken(link, "register");

    $("#register-form input[type=submit]").addEventListener("click", validate);
}