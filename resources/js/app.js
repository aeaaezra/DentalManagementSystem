import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
import './bootstrap';
import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('livewire:navigated', initAppointmentCalendar);
document.addEventListener('DOMContentLoaded', initAppointmentCalendar);

function initAppointmentCalendar() {
    const calendarEl = document.getElementById('appointment-calendar');

    if (!calendarEl || calendarEl.dataset.loaded === 'true') {
        return;
    }

    calendarEl.dataset.loaded = 'true';

    const eventsUrl = calendarEl.dataset.eventsUrl;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        events: eventsUrl,
        editable: false,
        selectable: false,
        height: 'auto',
    });

    calendar.render();
}

import './bootstrap';
import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('appointment-calendar');

    if (!calendarEl) return;

    const eventsUrl = calendarEl.dataset.eventsUrl;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        events: eventsUrl,
        height: 'auto',
    });

    calendar.render();
});
