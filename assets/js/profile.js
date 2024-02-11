let profileForm = document.querySelector("#profileForm");
if (profileForm) {
    profileForm.addEventListener('submit', e => {
        e.preventDefault();
        let xhr = new XMLHttpRequest();
        xhr.onloadend = function () {
            checkStatusWithAlert(xhr);
        }
        xhr.open('POST', profileForm.action);
        let formData = new FormData(profileForm);
        xhr.send(formData);
    });
}
