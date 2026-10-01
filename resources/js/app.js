import './bootstrap';

import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';


// ==========================================
// ALPINE JS
// ==========================================

window.Alpine = Alpine;

Alpine.start();


// ==========================================
// APPOINTMENT CALENDAR
// ==========================================

document.addEventListener('livewire:navigated', initAppointmentCalendar);
document.addEventListener('DOMContentLoaded', initAppointmentCalendar);

function initAppointmentCalendar() {

    const calendarEl = document.getElementById('appointment-calendar');

    // Calendar does not exist on this page
    if (!calendarEl) {
        return;
    }

    // Prevent calendar from loading twice
    if (calendarEl.dataset.loaded === 'true') {
        return;
    }

    calendarEl.dataset.loaded = 'true';

    const eventsUrl = calendarEl.dataset.eventsUrl;

    const calendar = new Calendar(calendarEl, {

        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin
        ],

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
