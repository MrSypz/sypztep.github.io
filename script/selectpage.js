function loadSection(url) {
    const content = document.getElementById('content');
    fetch(`pages/${url}.html`)
        .then(response => response.text())
        .then(html => {
            content.innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading the section:', error);
        });
}

function goToPatch() {
    window.location.href = 'patchnotes.html';
}

document.addEventListener('DOMContentLoaded', function() {
    loadSection('home');
});
