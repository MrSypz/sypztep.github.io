function loadPatch(section) {
    const mainContent = document.getElementById('main-content');
    fetch(`patch/${section}.html`)
        .then(response => response.text())
        .then(data => {
            mainContent.innerHTML = data;
        })
        .catch(error => {
            console.error('Error loading patch:', error);
        });
}
function goToIndex() {
    window.location.href = 'index.html';
}

document.addEventListener('DOMContentLoaded', function() {
    loadPatch('patch020');
});
