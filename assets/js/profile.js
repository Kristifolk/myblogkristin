let profileForm = document.querySelector("#profileForm");
if (profileForm) {
    profileForm.addEventListener('submit', e => {
        e.preventDefault();
        let xhr = new XMLHttpRequest();
        xhr.onloadend = function () {
            handleProfile(xhr);
        }
        xhr.open('POST', profileForm.action);
        let formData = new FormData(profileForm);
        xhr.send(formData);
    });
}

function handleProfile(xhr) {
    let data = JSON.parse(xhr.response);
    if (data.status === "fail") {
        let toastEl = document.querySelector(".toast-body");
        toastEl.innerText = data.message;
        let toast = new bootstrap.Toast(document.querySelector('#liveToast'));
        toast.show();
    } else if (data.status === "successfully") {
        alert(data.message);
        window.location.href = "/index.php";
    }
}
