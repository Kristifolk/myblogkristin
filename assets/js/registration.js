let registrationForm = document.querySelector("#registrationForm");
if (registrationForm) {
    registrationForm.addEventListener('submit', e => {
        e.preventDefault();
        let xhr = new XMLHttpRequest();
        xhr.onloadend = function () {
            handleRegistration(xhr);
        }
        xhr.open('POST', registrationForm.action);
        let formData = new FormData(registrationForm);
        xhr.send(formData);
    });
}

function handleRegistration(xhr) {
    checkStatusWithoutAlert(xhr);
}
