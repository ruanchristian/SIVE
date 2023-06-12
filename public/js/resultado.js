function atualizar() {
    const elecId = $('#elecId').data('value');

    $.ajax({
        url: $(location)[0].origin + '/acompanhar-votacao/' + elecId + '/' + true,
        method: "GET",
        success: function (response) {
            const rankingList = $('#ranking-list');
            const newRankingList = $('<ul>');

            response.sort((x, y) => y.votos - x.votos);
            rankingList.children().each(function (index, listItem) {
            const newIndex = response.findIndex(item => item.chapa === $(listItem).text().split(":")[0].trim());

            if (newIndex !== -1) {
                gsap.to(listItem, { y: (newIndex - index) * $(listItem).outerHeight() });
            } else {
                gsap.to(listItem, {
                    opacity: 0,
                    height: 0,
                    marginBottom: 0,
                    paddingTop: 0,
                    paddingBottom: 0,
                    marginTop: -10,
                    onComplete: function () {$(listItem).remove();}
                });
            }
        });

        response.forEach((item, index) => {
            let existingItem = rankingList.find(`li:contains("${item.chapa}:")`);

            if (existingItem.length === 0) {            
                let listItem = $('<li>').html(`<b>${item.chapa}</b>: ${item.votos} votos`).css({ opacity: 0 });
                newRankingList.append(listItem);
                gsap.to(listItem, { opacity: 1, duration: 0.5, delay: index * 0.1 });
            } else 
                existingItem.html(`<b>${item.chapa}</b>: ${item.votos} votos`);
        });
        rankingList.append(newRankingList.children());
        atualizarGraficos(response);
    },
        error: function () {alert('Erro ao atualizar o ranking');}
    });
}

function atualizarGraficos(resp) {
    window.barChart.data.labels = resp.map(r => r.chapa);
    window.barChart.data.datasets[0].data = resp.map(r => r.votos);
    window.donutChart.data.labels = resp.map(r => r.chapa);
    window.donutChart.data.datasets[0].data = resp.map(r => r.votos);

    window.barChart.update();
    window.donutChart.update();
}
atualizar();
if ($('#elecId').data('isactive') == 1) setInterval(atualizar, 5000);