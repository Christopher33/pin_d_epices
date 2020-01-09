function mentionL() {
    let blur = document.querySelector('.blur');
    blur.classList.toggle('active');
    let mention = document.querySelector('.mention');
    mention.classList.toggle('active');
}

function travaux() {
    let blur = document.querySelector('.blur');
    blur.classList.toggle('active');
    let travaux = document.querySelector('.travaux');
    travaux.classList.toggle('active');
}

// window.onclick = function(event) {
//     if (event.target === blur()) {
//         travaux.style.display = "none";
//     }
// };


// $(document).change(function () {
//     var totalPlat = $('#commande_plat');
//     $.ajax({
//         method: "POST",
//         url: glgobalUrl,
//         data: {id: totalPlat},
//         success: function () {
//             console.log(Response);
//         }
//     })
// });