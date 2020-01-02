$(document).change(function () {
    var totalPlat = $('#commande_plat');
    $.ajax({
        method: "POST",
        url: glgobalUrl,
        data: {id: totalPlat},
        success: function () {
            console.log(Response);
        }
    })
});


/*
// TODO
// à appeler à chaque fois que plat change
$("#input_plat").change(function() {
    // $.ajax('/calcul?plat='+commande.plat).success(

    // mettre à jour total



$(document).ready(function() {
    var idMagasin = $('#choixMagasin option:selected').attr('id');
    $.ajax({
        method: "POST",
        url: "{{ path('magasin_id') }}",
        data: {id: idMagasin},
        success: function(reponse){
            // $('#magasinDatas').html(data);
            console.log(reponse);
        }
    });
});*/
