let addArticleForm = document.querySelector("#addArticleForm");
if (addArticleForm) {
    addArticleForm.addEventListener('submit', e => {
        e.preventDefault();
        let xhr = new XMLHttpRequest();
        xhr.onloadend = function () {
            checkStatusWithAlert(xhr);
        }
        xhr.open('POST', addArticleForm.action);
        let formData = new FormData(addArticleForm);
        xhr.send(formData);
    });
}
