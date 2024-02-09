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
    let data = JSON.parse(xhr.response);
    if (data.status === "fail") {
        let toastEl = document.querySelector(".toast-body");
        toastEl.innerText = data.message;
        let toast = new bootstrap.Toast(document.querySelector('#liveToast'));
        toast.show();
    } else if (data.status === "successfully") {
        window.location.href = "/index.php";
    }
}
