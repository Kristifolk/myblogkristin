let loginForm = document.querySelector("#loginForm");
if (loginForm) {
    loginForm.addEventListener('submit', e => {
        e.preventDefault();
        let xhr = new XMLHttpRequest();
        xhr.onloadend = function () {
            handleLogin(xhr);
        }
        xhr.open('POST', loginForm.action);
        let formData = new FormData(loginForm);
        xhr.send(formData);
    });
}

function handleLogin(xhr) {
    checkStatusWithoutAlert(xhr);
}
