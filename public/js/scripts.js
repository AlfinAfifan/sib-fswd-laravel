// const card = document.querySelector(".card-hover");

// // console.log(card);

// // card.classList.add("shadow");
// card.addEventListener("mouseenter", function () {
//     // Menambahkan kelas 'shadow' saat mouse masuk (hover)
//     card.classList.add("shadow");
// });

// card.addEventListener("mouseleave", function () {
//     // Menghapus kelas 'shadow' saat mouse meninggalkan elemen
//     card.classList.remove("shadow");
// });

const passwordShow = document.querySelector(".show");
const inputPwd = document.querySelector(".password");

passwordShow.addEventListener("change", function () {
    if (passwordShow.checked) {
        inputPwd.type = "text";
    } else {
        inputPwd.type = "password";
    }
});
