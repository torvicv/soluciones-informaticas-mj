import Calendar from "js-year-calendar";

let element = null;

const calendar = new Calendar('.calendar', {
    language: 'es',
    dataSource: function ({ year }) {
        const currentYear = year;
        return fetch(`/dias-festivos/json`)
            .then(result => result.json())
            .then(result => {
                console.log(result);
                if (result.dias_festivos.length > 0) {
                    return result.dias_festivos.map((r) => {
                        if (r.recurrente) {
                            return ({
                                startDate: new Date(currentYear + '-' + r.mes + '-' + r.dia),
                                endDate: new Date(currentYear + '-' + r.mes + '-' + r.dia),
                                name: r.nombre,
                                color: r.color
                            })
                        } else {
                            return ({
                                startDate: new Date(r.anyo + '-' + r.mes + '-' + r.dia),
                                endDate: new Date(r.anyo + '-' + r.mes + '-' + r.dia),
                                name: r.nombre,
                                color: r.color
                            })
                        }
                    });
                }

                return [];
            });
    },
    mouseOnDay: function (e) {
        if (e.events.length > 0) {
            var content1 = '';

            for (var i in e.events) {
                content1 += '<div class="px-3 py-2 bg-white" style="width: 200px;border: 1px solid ' + e.events[i].color + ';color:' + e.events[i].color + '">' + e.events[i].name + '</div>';
            }

            element = new bootstrap.Popover($(e.element), {
                trigger: 'manual',
                html: true,
                template: content1,
                content: content1,
                allowList: {
                    div: ['style', 'class'],
                }
            });
            element.show();
        }
    },
    mouseOutDay: function (e) {
        if (e.events.length > 0) {
            element.hide();
        }
    }
});
