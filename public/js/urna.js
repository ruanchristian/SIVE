$(document).ready(() => {
    const endScreen = $("#fim");
    const key = $(".btn-number");
    const audioKey = $("#tecla");
    const confirmAudio = $("#confirma");
    const ten = $(".input-dezena");
    const unit = $(".input-unidade");
    const brancoBtn = $(".btn-branco");
    const corrigeBtn = $(".btn-corrige");
    const confirmarBtn = $(".btn-confirma");
    const chapaImg = $(".foto-chapa");
    const btnUrl = $("#rota");

    confirmarBtn.prop("disabled", true);

    if (ten.val() == "" && unit.val() == "") {
        key.click(function (e) {
            e.preventDefault();
            let valor = $(this).text();
            if (ten.val() == "") {
                ten.val(valor);
            } else if (ten.val() != "" && unit.val() == "") {
                unit.val(valor);
            }
        });
    }

    key.click((e) => {
        e.preventDefault();
        audioKey[0].play();

        if (ten.val() != "" && unit.val() != "") {
            key.prop("disabled", true);
            brancoBtn.prop("disabled", true);
            confirmarBtn.removeAttr("disabled");

            let num = ten.val() + unit.val();

            if(window.candidatosUrna && window.candidatosUrna[num]) {
                let chapa = window.candidatosUrna[num];
                chapaImg.attr("src", chapa.image);
                $(".nome-chapa").val(chapa.name);
            } else {
                chapaImg.attr("src", "{{ asset('img/default.png') }}");
                $(".nome-chapa").val("voto nulo");
            }
        }
    });

    corrigeBtn.click((e) => {
        e.preventDefault();
        audioKey[0].play();
        $("input").val("");
        brancoBtn.removeAttr("disabled");
        $(".btn").removeAttr("disabled");
        confirmarBtn.prop("disabled", true);
        chapaImg.attr("src", $(location)[0].origin + "/img/default.png");
    });

    brancoBtn.click((e) => {
        e.preventDefault();
        audioKey[0].play();
        ten.val("-");
        unit.val("-");
        $(".nome-chapa").val("voto em branco");
        key.prop("disabled", true);
        confirmarBtn.removeAttr("disabled");
    });

    confirmarBtn.click((e) => {
        e.preventDefault();

        let num = ten.val() + unit.val();
        $.ajax({
            url: btnUrl.data("urlsavevote"),
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                number: num,
                stdid: btnUrl.data("stdid"),
            },
        }).done(function () {
            $(".content").addClass("d-none");
            endScreen.show();
            $(".btn").prop("disabled", true);
            $(document).on("keydown", disableF5);

            setTimeout(() => {
                $(location)[0].href = $(location)[0].origin + "/sair";
            }, 5000);

            confirmAudio[0].play();
        }).fail(function (msg) {alert(msg);});
    });

    function disableF5(e) {
        if ((e.which || e.keyCode) == 116) e.preventDefault();
    }
});
