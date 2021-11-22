let editBtns = document.querySelectorAll(".editBtn");
editBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        btn.closest(".post-box").querySelector(".post-mainbox > textarea").disabled = false;
        btn.closest(".post-box").querySelector(".post-mainbox > .updateBtn").style.display =
            "block";
        btn.closest(".post-box").querySelector(".post-btns-div").style.display = "none";
        btn.closest(".post-box").querySelector(".post-footer > div:first-child").textContent = "";
        btn.remove();
    })
});

let editCommentBtns = document.querySelectorAll(".editCommentBtn");
editCommentBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        btn.closest(".comment-box").querySelector(".comment > textarea").disabled = false;
        btn.closest(".comment-box").querySelector(".comment > .updCommentBtn").style.display =
            "block";
        btn.closest(".comment-box").querySelector(".del-comment-form > button").style.display =
            "none";
        btn.closest(".comment-box").querySelector(".like-comment-form > button").style.display =
            "none";
        btn.remove();
    })
})
