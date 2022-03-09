/**
 * Fills the login form for tests
 */
const fillLogin = () => {
    setValue("login-email", "james.bond@test.com");
    setValue("login-password", "James007");
};

/**
 * Fills the register form for tests
 */
const fillRegister = () => {
    setValue("fullName", "James Bond");
    setValue("email", "james.bond@test.com");
    setValue("password", "James007");
    setValue("confirm-password", "James007");
};

//fillLogin();
//fillRegister();
