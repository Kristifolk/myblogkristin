let profileForm = document.querySelector("#profileForm");

profileForm.addEventListener('submit', e => {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.onloadend = function () {
        handleResponse(xhr);
    }
    xhr.open('POST', "/controllers/profile.php");
    let formData = new FormData(profileForm);
    xhr.send(formData);

});

function handleResponse(xhr) {
    let data = JSON.parse(xhr.response);
    if (data.status === "fail") {
        let toastEl = document.querySelector(".toast-body");
        toastEl.innerText = data.message;
        let toast = new bootstrap.Toast(document.querySelector('#liveToast'));
        toast.show();
    } else if (data.status === "successfully") {
        alert(data.message);
        window.location.href = "http://myblogkristin.test:82/index.php";//путь так?
    }
}