function toggle() {
    var blur = document.getElementById('blur');
    blur.classList.toggle('active');
    var popup = document.getElementById('popup');
    popup.classList.toggle('active');
}

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