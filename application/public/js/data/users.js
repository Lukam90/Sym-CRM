/**
 * Opens the modal window to delete a user
 * 
 * @param {HTMLButtonElement} button 
 */
const _delete = (button) => {
    setToken(button, "delete");

    let user = getData(button);

    $("#delete-title").textContent = "Suppression d'un utilisateur";
    $("#delete-form").action = `/users/delete/${user.id}`;
    $("#delete-name").textContent = user.fullName;
}

/**
 * Opens the modal window to edit a user
 * 
 * @param {HTMLButtonElement} button 
 */
const _edit = (button) => {
    setToken(button, "modal");

    let user = getData(button);

    $("#modal-title").textContent = "Edition d'un utilisateur";
    $("#modal-form").action = `/users/edit/${user.id}`;
    $("#modal-name").textContent = user.fullName;

    setOptions("role", user.role);
}

/**
 * Validates the registration form
 * 
 * @param {HTMLButtonElement} button 
 */
const validate = (button) => {
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

/**
 * Fill the registration form for a testing purpose
 * 
 * @param {HTMLButtonElement} button 
 */
const testRegister = () => {
    setValue("fullName", "James Bond");
    setValue("email", "james.bond@test.com");
    setValue("password", "James007");
    setValue("confirm-password", "James007");
}

/**
 * Opens the registration form's modal
 * 
 * @param {HTMLLinkElement} link 
 */
const register = (link) => {
    setToken(link, "register");

    testRegister();

    $("#register-button").addEventListener("click", validate);
}

/**
 * Opens the password reset form's modal
 * 
 * @param {HTMLLinkElement} link 
 */
 const reset = (link) => {
    setToken(link, "reset");
}