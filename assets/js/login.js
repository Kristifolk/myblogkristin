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
