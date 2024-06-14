document.addEventListener("DOMContentLoaded", function() {
    // Function to logout
    function logout() {
        // Make an AJAX request to your server to logout the user
        fetch('php/logout.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Reload the page after logout
                window.location.reload();
            })
            .catch(error => console.error('Error:', error));
    }
    // Function to check session state
    function checkSession() {
        // Make an AJAX request to your server to check the session state
        fetch('php/check_session.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.loggedIn) {
                    // If logged in, update the profile link
                    document.getElementById("profileLink").innerHTML = '<a href="#" onclick="loadSection(\'profile\')">Profile</a>';
                    // Show the logout option
                    document.getElementById("logoutLink").style.display = "block";
                    // Hide the sign in and sign up options
                    document.getElementById("signInLink").style.display = "none";
                    document.getElementById("signUpLink").style.display = "none";
                    // Add event listener to logout link
                    document.getElementById("logoutLink").addEventListener("click", function() {
                        logout();
                    });
                } else {
                    // If not logged in, show sign in and sign up options
                    document.getElementById("profileLink").innerHTML = '<a href="#">Profile</a> (Login required)';
                    document.getElementById("logoutLink").style.display = "none";
                    document.getElementById("signInLink").style.display = "block";
                    document.getElementById("signUpLink").style.display = "block";
                }
            })
            .catch(error => console.error('Error:', error));
    }

    

    // Call checkSession when the page loads
    checkSession();
});
