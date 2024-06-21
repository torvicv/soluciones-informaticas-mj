import Calendar from "js-year-calendar";

/*let calendar = null;

function editEvent(event) {
    $('#event-modal input[name="event-index"]').val(event ? event.id : '');
    $('#event-modal input[name="event-name"]').val(event ? event.name : '');
    $('#event-modal input[name="event-location"]').val(event ? event.location : '');
    $('#event-modal input[name="event-start-date"]').datepicker('update', event ? event.startDate : '');
    $('#event-modal input[name="event-end-date"]').datepicker('update', event ? event.endDate : '');
    $('#event-modal').modal();
}

function deleteEvent(event) {
    var dataSource = calendar.getDataSource();

    calendar.setDataSource(dataSource.filter(item => item.id !== event.id));
}

function saveEvent() {
    var event = {
        id: $('#event-modal input[name="event-index"]').val(),
        name: $('#event-modal input[name="event-name"]').val(),
        location: $('#event-modal input[name="event-location"]').val(),
        startDate: $('#event-modal input[name="event-start-date"]').datepicker('getDate'),
        endDate: $('#event-modal input[name="event-end-date"]').datepicker('getDate')
    }

    var dataSource = calendar.getDataSource();

    if (event.id) {
        for (var i in dataSource) {
            if (dataSource[i].id == event.id) {
                dataSource[i].name = event.name;
                dataSource[i].location = event.location;
                dataSource[i].startDate = event.startDate;
                dataSource[i].endDate = event.endDate;
            }
        }
    }
    else
    {
        var newId = 0;
        for(var i in dataSource) {
            if(dataSource[i].id > newId) {
                newId = dataSource[i].id;
            }
        }

        newId++;
        event.id = newId;

        dataSource.push(event);
    }

    calendar.setDataSource(dataSource);
    $('#event-modal').modal('hide');
}

$(function() {
    var currentYear = new Date().getFullYear();

    let element = null;

    calendar = new Calendar('.calendar', {
        enableContextMenu: true,
        enableRangeSelection: true,
        contextMenuItems:[
            {
                text: 'Update',
                click: editEvent
            },
            {
                text: 'Delete',
                click: deleteEvent
            }
        ],
        selectRange: function(e) {
            editEvent({ startDate: e.startDate, endDate: e.endDate });
        },
        mouseOnDay: function(e) {
            console.log(e);
            if(e.events.length > 0) {
                var content = '';

                for(var i in e.events) {
                    content += '<div class="event-tooltip-content">'
                                    + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
                                    + '<div class="event-location">' + e.events[i].location + '</div>'
                                + '</div>';
                }

                element = new bootstrap.Popover($(e.element), {
                    trigger: 'manual',
                    container: 'body',
                    html:true,
                    content: content
                });
                element.show();
                // new bootstrap.Popover($(e.element), 'show');
            }
        },
        mouseOutDay: function(e) {
            if(e.events.length > 0) {
                element.hide();
                new bootstrap.Popover($(e.element)).hide();
            }
        },
        dayContextMenu: function(e) {
            $(e.element).popover('hide');
        },
        dataSource: [
            {
                id: 0,
                name: 'Google I/O',
                location: 'San Francisco, CA',
                startDate: new Date(currentYear, 4, 28),
                endDate: new Date(currentYear, 4, 29)
            },
            {
                id: 1,
                name: 'Microsoft Convergence',
                location: 'New Orleans, LA',
                startDate: new Date(currentYear, 2, 16),
                endDate: new Date(currentYear, 2, 19)
            },
            {
                id: 2,
                name: 'Microsoft Build Developer Conference',
                location: 'San Francisco, CA',
                startDate: new Date(currentYear, 3, 29),
                endDate: new Date(currentYear, 4, 1)
            },
            {
                id: 3,
                name: 'Apple Special Event',
                location: 'San Francisco, CA',
                startDate: new Date(currentYear, 8, 1),
                endDate: new Date(currentYear, 8, 1)
            },
            {
                id: 4,
                name: 'Apple Keynote',
                location: 'San Francisco, CA',
                startDate: new Date(currentYear, 8, 9),
                endDate: new Date(currentYear, 8, 9)
            },
            {
                id: 5,
                name: 'Chrome Developer Summit',
                location: 'Mountain View, CA',
                startDate: new Date(currentYear, 10, 17),
                endDate: new Date(currentYear, 10, 18)
            },
            {
                id: 6,
                name: 'F8 2015',
                location: 'San Francisco, CA',
                startDate: new Date(currentYear, 2, 25),
                endDate: new Date(currentYear, 2, 26)
            },
            {
                id: 7,
                name: 'Yahoo Mobile Developer Conference',
                location: 'New York',
                startDate: new Date(currentYear, 7, 25),
                endDate: new Date(currentYear, 7, 26)
            },
            {
                id: 8,
                name: 'Android Developer Conference',
                location: 'Santa Clara, CA',
                startDate: new Date(currentYear, 11, 1),
                endDate: new Date(currentYear, 11, 4)
            },
            {
                id: 9,
                name: 'LA Tech Summit',
                location: 'Los Angeles, CA',
                startDate: new Date(currentYear, 10, 17),
                endDate: new Date(currentYear, 10, 17)
            }
        ]
    });

    $('#save-event').click(function() {
        saveEvent();
    });
});
*/
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
                content1 += '<div class="px-3 py-2 bg-white" style="border: 1px solid ' + e.events[i].color + ';color:' + e.events[i].color + '">' + e.events[i].name + '</div>';
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
            console.log('hello');
        }
    },
    mouseOutDay: function (e) {
        if (e.events.length > 0) {
            element.hide();
        }
    }
});

function generateRecurringEvents(startDate, recurrenceRule, endDate) {
    const events = [];
    let currentDate = new Date(startDate);

    while (currentDate <= endDate) {
        events.push({
            startDate: new Date(currentDate),
            endDate: new Date(currentDate),
            name: 'Recurring Event'
        });

        // Apply recurrence rule (e.g., daily)
        currentDate.setDate(currentDate.getDate() + recurrenceRule);
    }

    return events;
}
