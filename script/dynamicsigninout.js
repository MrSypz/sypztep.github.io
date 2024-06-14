function toggleAccountDropdown(show, authenticated) {
    const accountDropdown = document.getElementById("accountDropdown");
    const signOutLink = document.getElementById("signOutLink");

    if (show) {
        accountDropdown.style.display = "block";
        if (authenticated) {
            signOutLink.style.display = "block";
        } else {
            signOutLink.style.display = "none";
        }
    } else {
        accountDropdown.style.display = "none";
    }
}



// Call this function when the user logs in
function login() {
    // Perform login operations...
    // After successful login, call toggleAccountDropdown(true);
    toggleAccountDropdown(true);
}

// Call this function when the user logs out
function logout() {
    // Perform logout operations...
    // After successful logout, call toggleAccountDropdown(false);
    toggleAccountDropdown(false);
}


