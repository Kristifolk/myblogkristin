let addArticleForm = document.querySelector("#addArticleForm");
if (addArticleForm) {
    addArticleForm.addEventListener('submit', e => {
        e.preventDefault();
        let xhr = new XMLHttpRequest();
        xhr.onloadend = function () {
            handleArticle(xhr);
        }
        xhr.open('POST', addArticleForm.action);
        let formData = new FormData(addArticleForm);
        xhr.send(formData);
    });
}

function handleArticle(xhr) {
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
