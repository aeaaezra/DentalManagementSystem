<x-filament-widgets::widget>
    <x-filament::section>
        <style>
            :root {
                --pink: #ec4899;
                --pink-dark: #be185d;
                --pink-soft: #fce7f3;
                --pink-light: #fdf2f8;
                --white: #ffffff;
                --border: #e5e7eb;
                --text: #111827;
                --muted: #6b7280;
                --green: #16a34a;
                --yellow: #ca8a04;
                --red: #dc2626;
            }

            .pro-calendar {
                display: grid;
                grid-template-columns: 360px 1fr;
                gap: 24px;
                width: 100%;
            }

            .pro-card {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 22px;
                box-shadow: 0 20px 40px rgba(236, 72, 153, .10);
                overflow: hidden;
            }

            .pro-sidebar {
                padding: 20px;
                max-height: 760px;
            }

            .pro-calendar-main {
                padding: 20px;
            }

            .pro-title {
                font-size: 22px;
                font-weight: 900;
                color: var(--text);
            }

            .pro-subtitle {
                font-size: 13px;
                color: var(--muted);
                margin-top: 4px;
            }

            .search-box {
                width: 100%;
                margin: 16px 0;
                border: 1px solid var(--border);
                border-radius: 14px;
                padding: 11px 14px;
                outline: none;
            }

            .search-box:focus {
                border-color: var(--pink);
                box-shadow: 0 0 0 3px var(--pink-soft);
            }

            .appointment-scroll {
                max-height: 610px;
                overflow-y: auto;
                padding-right: 8px;
            }

            .appointment-item {
                background: linear-gradient(135deg, #fff, var(--pink-light));
                border: 1px solid #fbcfe8;
                border-left: 6px solid var(--pink);
                border-radius: 16px;
                padding: 14px;
                margin-bottom: 12px;
            }

            .appointment-time {
                color: var(--pink-dark);
                font-weight: 900;
                font-size: 15px;
            }

            .appointment-name {
                font-weight: 800;
                color: var(--text);
                margin-top: 4px;
            }

            .appointment-reason {
                font-size: 13px;
                color: var(--muted);
                margin-top: 4px;
            }

            .status-pill {
                display: inline-block;
                margin-top: 10px;
                padding: 4px 10px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 800;
                background: var(--pink-soft);
                color: var(--pink-dark);
                text-transform: uppercase;
            }

            .calendar-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 20px;
                gap: 12px;
            }

            .month-title {
                text-align: center;
                font-size: 28px;
                font-weight: 1000;
                color: var(--pink-dark);
            }

            .calendar-btn {
                border: 1px solid #f9a8d4;
                background: var(--white);
                color: var(--pink-dark);
                padding: 10px 16px;
                border-radius: 14px;
                cursor: pointer;
                font-weight: 900;
            }

            .calendar-btn:hover {
                background: var(--pink);
                color: white;
            }

            .weekdays,
            .calendar-grid {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                gap: 10px;
            }

            .weekday {
                text-align: center;
                font-weight: 900;
                color: var(--muted);
                padding: 10px 0;
            }

            .day-cell {
                min-height: 125px;
                background: white;
                border: 1px solid var(--border);
                border-radius: 18px;
                padding: 10px;
                cursor: pointer;
                transition: .2s ease;
            }

            .day-cell:hover {
                transform: translateY(-2px);
                border-color: var(--pink);
                background: var(--pink-light);
            }

            .day-cell.selected {
                border: 2px solid var(--pink);
                background: var(--pink-soft);
            }

            .day-cell.today {
                box-shadow: inset 0 0 0 2px var(--pink);
            }

            .day-number {
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                font-weight: 900;
                color: var(--text);
                margin-bottom: 8px;
            }

            .today .day-number {
                background: var(--pink);
                color: white;
            }

            .patient-badge {
                display: block;
                background: var(--pink);
                color: white;
                border-radius: 8px;
                padding: 5px 7px;
                font-size: 11px;
                font-weight: 800;
                margin-bottom: 5px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .more-badge {
                font-size: 11px;
                font-weight: 800;
                color: var(--pink-dark);
            }

            .empty-state {
                color: var(--muted);
                font-size: 14px;
                padding: 20px;
                text-align: center;
                border: 1px dashed #f9a8d4;
                border-radius: 16px;
                background: var(--pink-light);
            }

            @media (max-width: 1000px) {
                .pro-calendar {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <div
            x-data="{
                appointments: @js($this->appointments),
                currentDate: new Date(),
                selectedDate: new Date().toLocaleDateString('en-CA'),
                search: '',

                months: [
                    'January','February','March','April','May','June',
                    'July','August','September','October','November','December'
                ],

                get year() {
                    return this.currentDate.getFullYear();
                },

                get month() {
                    return this.currentDate.getMonth();
                },

                get monthTitle() {
                    return this.months[this.month] + ' ' + this.year;
                },

                get today() {
                    return new Date().toLocaleDateString('en-CA');
                },

                formatDate(day) {
                    let m = String(this.month + 1).padStart(2, '0');
                    let d = String(day).padStart(2, '0');
                    return `${this.year}-${m}-${d}`;
                },

                get firstDay() {
                    return new Date(this.year, this.month, 1).getDay();
                },

                get daysInMonth() {
                    return new Date(this.year, this.month + 1, 0).getDate();
                },

                get calendarDays() {
                    let days = [];

                    for (let i = 0; i < this.firstDay; i++) {
                        days.push(null);
                    }

                    for (let day = 1; day <= this.daysInMonth; day++) {
                        let date = this.formatDate(day);

                        days.push({
                            day: day,
                            date: date,
                            isToday: date === this.today,
                            appointments: this.appointments.filter(a => a.date === date),
                        });
                    }

                    return days;
                },

                get selectedAppointments() {
                    return this.appointments
                        .filter(a => a.date === this.selectedDate)
                        .filter(a => {
                            let keyword = this.search.toLowerCase();

                            return !keyword ||
                                a.patient_name.toLowerCase().includes(keyword) ||
                                a.time.toLowerCase().includes(keyword) ||
                                a.status.toLowerCase().includes(keyword) ||
                                a.reason.toLowerCase().includes(keyword);
                        })
                        .sort((a, b) => a.time.localeCompare(b.time));
                },

                previousMonth() {
                    this.currentDate = new Date(this.year, this.month - 1, 1);
                },

                nextMonth() {
                    this.currentDate = new Date(this.year, this.month + 1, 1);
                },

                goToday() {
                    this.currentDate = new Date();
                    this.selectedDate = this.today;
                }
            }"
            class="pro-calendar"
        >
            <div class="pro-card pro-sidebar">
                <div class="pro-title">Appointments</div>
                <div class="pro-subtitle" x-text="'Selected date: ' + selectedDate"></div>

                <input
                    type="text"
                    x-model="search"
                    class="search-box"
                    placeholder="Search patient, time, status..."
                >

                <div class="appointment-scroll">
                    <template x-if="selectedAppointments.length === 0">
                        <div class="empty-state">
                            No appointments for this date.
                        </div>
                    </template>

                    <template x-for="appointment in selectedAppointments" :key="appointment.id">
                        <div class="appointment-item">
                            <div class="appointment-time" x-text="appointment.time"></div>
                            <div class="appointment-name" x-text="appointment.patient_name"></div>
                            <div class="appointment-reason" x-text="appointment.reason || 'No reason provided'"></div>
                            <span class="status-pill" x-text="appointment.status"></span>
                        </div>
                    </template>
                </div>
            </div>

            <div class="pro-card pro-calendar-main">
                <div class="calendar-top">
                    <button type="button" class="calendar-btn" x-on:click="previousMonth()">
                        ← Previous
                    </button>

                    <div>
                        <div class="month-title" x-text="monthTitle"></div>
                        <div class="pro-subtitle" style="text-align:center;">
                            Clinic Appointment Calendar
                        </div>
                    </div>

                    <button type="button" class="calendar-btn" x-on:click="nextMonth()">
                        Next →
                    </button>
                </div>

                <div style="text-align:center; margin-bottom: 18px;">
                    <button type="button" class="calendar-btn" x-on:click="goToday()">
                        Today
                    </button>
                </div>

                <div class="weekdays">
                    <div class="weekday">Sun</div>
                    <div class="weekday">Mon</div>
                    <div class="weekday">Tue</div>
                    <div class="weekday">Wed</div>
                    <div class="weekday">Thu</div>
                    <div class="weekday">Fri</div>
                    <div class="weekday">Sat</div>
                </div>

                <div class="calendar-grid">
                    <template x-for="day in calendarDays">
                        <div>
                            <template x-if="day === null">
                                <div></div>
                            </template>

                            <template x-if="day !== null">
                                <div
                                    class="day-cell"
                                    x-on:click="selectedDate = day.date"
                                    :class="{
                                        'selected': selectedDate === day.date,
                                        'today': day.isToday
                                    }"
                                >
                                    <div class="day-number" x-text="day.day"></div>

                                    <template x-for="appointment in day.appointments.slice(0, 3)" :key="appointment.id">
                                        <span class="patient-badge" x-text="appointment.patient_name"></span>
                                    </template>

                                    <template x-if="day.appointments.length > 3">
                                        <span class="more-badge" x-text="'+ ' + (day.appointments.length - 3) + ' more'"></span>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>


