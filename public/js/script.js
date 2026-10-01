  const state = {
            currentStep: 1,
            selectedService: 'Routine Checkup',
            selectedPrice: 50,
            selectedDoctor: 'Dr. Sophia Carter',
            selectedDoctorRole: 'Cosmetic Specialist',
            selectedDate: null,
            selectedTime: null,
            bookedAppointments: [],
            testimonialIndex: 0
        };

        // Static List of mock-available days in June 2026 for selection (mon-fri only)
        const mockAvailableDays = [
            { day: 8, label: 'Mon' },
            { day: 9, label: 'Tue' },
            { day: 10, label: 'Wed' },
            { day: 11, label: 'Thu' },
            { day: 12, label: 'Fri' },
            { day: 15, label: 'Mon' },
            { day: 16, label: 'Tue' },
            { day: 17, label: 'Wed' },
            { day: 18, label: 'Thu' },
            { day: 19, label: 'Fri' },
            { day: 22, label: 'Mon' },
            { day: 23, label: 'Tue' },
            { day: 24, label: 'Wed' },
            { day: 25, label: 'Thu' },
            { day: 26, label: 'Fri' }
        ];

        // On Document Loaded Initialization
        window.onload = function() {
            // Render default calendar
            renderMockCalendar();
            // Load appointments from LocalStorage if they exist
            const cached = localStorage.getItem('shine_smile_appointments');
            if (cached) {
                state.bookedAppointments = JSON.parse(cached);
                updateAppointmentsUI();
            }
            // Run default Cost Calculator
            calculateCosts();
        };

        // Custom Interactive Toast Notifications helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `flex items-center space-x-3 px-5 py-3.5 rounded-2xl shadow-xl border text-xs font-bold pointer-events-auto transform translate-y-10 opacity-0 transition-all duration-300 ${
                type === 'success'
                    ? 'bg-emerald-50 text-emerald-800 border-emerald-100'
                    : 'bg-brand-50 text-brand-800 border-brand-100'
            }`;

            const icon = type === 'success' ? 'fa-circle-check' : 'fa-triangle-exclamation';
            toast.innerHTML = `<i class="fa-solid ${icon} text-sm"></i> <span>${message}</span>`;

            container.appendChild(toast);

            // Trigger animation frame delay for transition smoothness
            setTimeout(() => {
                toast.classList.remove('translate-y-10', 'opacity-0');
            }, 10);

            // Automatically dismiss toast
            setTimeout(() => {
                toast.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 4000);
        }

        // Drawer Panel Toggle UI
        function toggleAppointmentsPanel() {
            const drawer = document.getElementById('appointments-drawer');
            const overlay = document.getElementById('drawer-overlay');
            const isClosing = drawer.classList.contains('translate-x-0');

            if (isClosing) {
                drawer.classList.remove('translate-x-0');
                drawer.classList.add('translate-x-full');
                overlay.classList.add('hidden');
            } else {
                drawer.classList.remove('translate-x-full');
                drawer.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
            }
        }

        // Live Cost & Insurance Calculator Logic
        function calculateCosts() {
            let subtotal = 0;
            if (document.getElementById('calc-checkup').checked) subtotal += 50;
            if (document.getElementById('calc-whitening').checked) subtotal += 150;
            if (document.getElementById('calc-implants').checked) subtotal += 1200;
            if (document.getElementById('calc-braces').checked) subtotal += 2500;

            const insuranceVal = parseInt(document.getElementById('insurance-range').value);
            document.getElementById('insurance-display').innerText = `${insuranceVal}% Covered`;

            const offset = subtotal * (insuranceVal / 100);
            const net = subtotal - offset;

            document.getElementById('calc-subtotal').innerText = `$${subtotal.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
            document.getElementById('calc-offset').innerText = `-$${offset.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
            document.getElementById('calc-net').innerText = `$${net.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
        }

        // Mini Booking Quick Actions on Hero Section
        function quickSelectAppointment(time, doctor, service) {
            state.selectedTime = time;
            state.selectedDoctor = doctor;
            state.selectedService = service;
            state.selectedDate = "June 11, 2026";

            // Sync step controls for seamless wizard alignment
            document.getElementById('patient-fullname').focus();

            // Directly skip to Step 4 to complete patient details
            setWizardStep(4);

            // Alert user that details are prepared via smooth scrolling
            document.getElementById('booking-section').scrollIntoView();
            showToast(`Pre-filled booking with ${doctor} at ${time}! Please supply contact credentials.`, 'success');
        }

        // Step Service Radio Actions
        function selectStepService(name, price) {
            state.selectedService = name;
            state.selectedPrice = price;
            showToast(`Selected Treatment: ${name} ($${price})`, 'success');
        }

        // Step Doctor Radio Actions
        function selectStepDoctor(name, role) {
            state.selectedDoctor = name;
            state.selectedDoctorRole = role;
            showToast(`Selected Dentist Specialist: ${name}`, 'success');
        }

        // Render Days in the simulated interactive calendar grid
        function renderMockCalendar() {
            const grid = document.getElementById('calendar-days-grid');
            grid.innerHTML = '';

            mockAvailableDays.forEach(item => {
                const btn = document.createElement('button');
                btn.type = "button";
                btn.onclick = () => selectCalendarDay(item.day, btn);
                btn.className = `flex flex-col items-center justify-center p-2 rounded-xl border border-slate-200 bg-white hover:border-brand-500/50 transition-all font-bold text-slate-800 focus:outline-none ${state.selectedDate === `June ${item.day}, 2026` ? 'border-brand-500 bg-brand-50 text-brand-600' : ''}`;
                btn.innerHTML = `
                    <span class="text-[10px] font-normal text-slate-400 block">${item.label}</span>
                    <span class="text-xs text-slate-800">${item.day}</span>
                `;
                grid.appendChild(btn);
            });
        }

        function selectCalendarDay(day, element) {
            // Deselect all calendar days
            const buttons = document.getElementById('calendar-days-grid').children;
            for (let b of buttons) {
                b.classList.remove('border-brand-500', 'bg-brand-50', 'text-brand-600');
            }

            // Highlight selected
            element.classList.add('border-brand-500', 'bg-brand-50', 'text-brand-600');
            state.selectedDate = `June ${day}, 2026`;
            showToast(`Selected Date: June ${day}, 2026`, 'success');
        }

        function selectStepTime(time) {
            // Highlight active time button dynamically
            const buttons = document.getElementById('time-slots-grid').children;
            for (let b of buttons) {
                b.classList.remove('bg-brand-500', 'text-white', 'border-none', 'shadow-md', 'shadow-brand-500/20');
                b.classList.add('border-slate-200', 'text-slate-700');
            }

            // Find current event emitter
            const event = window.event;
            const target = event ? event.target : null;
            if (target) {
                target.classList.remove('border-slate-200', 'text-slate-700');
                target.classList.add('bg-brand-500', 'text-white', 'border-none', 'shadow-md', 'shadow-brand-500/20');
            }

            state.selectedTime = time;
            showToast(`Selected Appointment Time Slot: ${time}`, 'success');
        }

        // Main Navigation and Wizard State flow handler
        function setWizardStep(step) {
            state.currentStep = step;

            // Hide all contents
            document.getElementById('wizard-step-1-content').classList.add('hidden');
            document.getElementById('wizard-step-2-content').classList.add('hidden');
            document.getElementById('wizard-step-3-content').classList.add('hidden');
            document.getElementById('wizard-step-4-content').classList.add('hidden');

            // Reveal active step
            document.getElementById(`wizard-step-${step}-content`).classList.remove('hidden');

            // Update title & step counters
            const stepNumText = document.getElementById('step-number');
            const stepTitleText = document.getElementById('step-title');
            stepNumText.innerText = step;

            // Reset indicators
            for (let i = 1; i <= 4; i++) {
                const indicator = document.getElementById(`indicator-step-${i}`);
                if (i <= step) {
                    indicator.classList.remove('bg-slate-700');
                    indicator.classList.add('bg-brand-500');
                } else {
                    indicator.classList.remove('bg-brand-500');
                    indicator.classList.add('bg-slate-700');
                }
            }

            // Wizard step captions
            if (step === 1) {
                stepTitleText.innerText = "Select Treatment Service";
                document.getElementById('wizard-btn-prev').classList.add('invisible');
                document.getElementById('wizard-btn-next').innerHTML = `Next <i class="fa-solid fa-arrow-right ml-2"></i>`;
            } else if (step === 2) {
                stepTitleText.innerText = "Choose Clinical Specialist";
                document.getElementById('wizard-btn-prev').classList.remove('invisible');
                document.getElementById('wizard-btn-next').innerHTML = `Next <i class="fa-solid fa-arrow-right ml-2"></i>`;
            } else if (step === 3) {
                stepTitleText.innerText = "Schedule Slot Date & Time";
                document.getElementById('wizard-btn-prev').classList.remove('invisible');
                document.getElementById('wizard-btn-next').innerHTML = `Next <i class="fa-solid fa-arrow-right ml-2"></i>`;
            } else if (step === 4) {
                stepTitleText.innerText = "Complete Patient Details";
                document.getElementById('wizard-btn-prev').classList.remove('invisible');
                document.getElementById('wizard-btn-next').innerHTML = `Confirm Booking <i class="fa-solid fa-check-double ml-2"></i>`;
            }
        }

        // Stepping evaluation logic
        function advanceStep(offset) {
            const nextStep = state.currentStep + offset;

            // Prevent Out of bounds
            if (nextStep < 1) return;

            // Validate values during step transition
            if (offset === 1) {
                if (state.currentStep === 1 && !state.selectedService) {
                    showToast('Please select a specific dental service to proceed.', 'error');
                    return;
                }
                if (state.currentStep === 2 && !state.selectedDoctor) {
                    showToast('Please select your preferred dental practitioner to proceed.', 'error');
                    return;
                }
                if (state.currentStep === 3 && (!state.selectedDate || !state.selectedTime)) {
                    showToast('Please select both an appointment date and an active shift time.', 'error');
                    return;
                }
                if (state.currentStep === 4) {
                    // Final Submission validation
                    executeBookingSubmission();
                    return;
                }
            }

            setWizardStep(nextStep);
        }

        // Confirm final submission data and build structural ticket
        function executeBookingSubmission() {
            const fullname = document.getElementById('patient-fullname').value.trim();
            const phone = document.getElementById('patient-phone').value.trim();
            const email = document.getElementById('patient-email').value.trim();
            const termsChecked = document.getElementById('patient-terms').checked;

            if (!fullname || !phone || !email) {
                showToast('Please provide all patient registration details to book.', 'error');
                return;
            }

            if (!termsChecked) {
                showToast('Please accept the general patient guidelines to proceed.', 'error');
                return;
            }

            // Create new mock ticket entry structure
            const ticket = {
                id: 'S&S-' + Math.floor(Math.random() * 900000 + 100000),
                patient: fullname,
                phone: phone,
                email: email,
                service: state.selectedService,
                price: state.selectedPrice,
                doctor: state.selectedDoctor,
                date: state.selectedDate,
                time: state.selectedTime
            };

            // Save and render state persistence
            state.bookedAppointments.push(ticket);
            localStorage.setItem('shine_smile_appointments', JSON.stringify(state.bookedAppointments));

            updateAppointmentsUI();

            // Display confirmation modal toast alert
            showToast(`Appointment Scheduled Successfully! Welcome to Shine & Smile. Ticket: ${ticket.id}`, 'success');

            // Automatically open appointments drawer to let them review ticket details
            setTimeout(() => {
                toggleAppointmentsPanel();
            }, 800);

            // Reset booking steps
            document.getElementById('patient-fullname').value = '';
            document.getElementById('patient-phone').value = '';
            document.getElementById('patient-email').value = '';
            document.getElementById('patient-terms').checked = false;

            state.selectedDate = null;
            state.selectedTime = null;
            renderMockCalendar();

            // Reset wizard steps
            setWizardStep(1);
        }

        // Render dynamic reservation ticket items
        function updateAppointmentsUI() {
            const body = document.getElementById('appointments-drawer-body');
            const emptyState = document.getElementById('empty-state-tickets');
            const badge = document.getElementById('appointment-badge');

            // Count badge indicator
            if (state.bookedAppointments.length > 0) {
                badge.classList.remove('hidden');
                badge.innerText = state.bookedAppointments.length;
                emptyState.classList.add('hidden');
            } else {
                badge.classList.add('hidden');
                emptyState.classList.remove('hidden');
            }

            // Clear old ticket list
            const existingTickets = body.querySelectorAll('.ticket-card');
            existingTickets.forEach(t => t.remove());

            // Build fresh card markup recursively
            state.bookedAppointments.forEach((ticket, index) => {
                const card = document.createElement('div');
                card.className = "ticket-card bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-3 relative overflow-hidden";
                card.innerHTML = `
                    <div class="flex justify-between items-center pb-2.5 border-b border-slate-200/60">
                        <span class="text-[10px] font-mono bg-brand-500/10 text-brand-600 px-2 py-0.5 rounded-md font-bold">${ticket.id}</span>
                        <button onclick="cancelAppointment(${index})" class="text-xs text-red-500 hover:text-red-700 font-bold flex items-center space-x-1 transition-all">
                            <i class="fa-solid fa-trash-can"></i>
                            <span>Cancel</span>
                        </button>
                    </div>
                    <div class="space-y-1 text-xs">
                        <p class="text-slate-800"><span class="font-bold">Patient:</span> ${ticket.patient}</p>
                        <p class="text-slate-800"><span class="font-bold">Service:</span> ${ticket.service}</p>
                        <p class="text-slate-800"><span class="font-bold">Specialist:</span> ${ticket.doctor}</p>
                        <p class="text-slate-800"><span class="font-bold">Estimated Cost:</span> $${ticket.price}</p>
                    </div>
                    <div class="pt-2 flex justify-between items-center bg-white/40 -mx-5 -mb-5 px-5 py-3 border-t border-slate-200/60 text-[10px] text-slate-500">
                        <span><i class="fa-solid fa-calendar mr-1 text-brand-500"></i> ${ticket.date}</span>
                        <span><i class="fa-solid fa-clock mr-1 text-brand-500"></i> ${ticket.time}</span>
                    </div>
                `;
                body.appendChild(card);
            });
        }

        // Cancel existing scheduled slot
        function cancelAppointment(index) {
            const appointment = state.bookedAppointments[index];
            state.bookedAppointments.splice(index, 1);
            localStorage.setItem('shine_smile_appointments', JSON.stringify(state.bookedAppointments));

            updateAppointmentsUI();
            showToast(`Cancelled Appointment Session ${appointment ? appointment.id : ''} successfully!`, 'success');
        }

        // FAQ Toggle Logic
        function toggleFaq(id) {
            const content = document.getElementById(`faq-content-${id}`);
            const chevron = document.getElementById(`faq-chevron-${id}`);
            const isHidden = content.classList.contains('hidden');

            if (isHidden) {
                content.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }

        // Testimonial Carousel Control
        function updateTestimonialSlider() {
            const container = document.getElementById('testimonial-slider-container');
            const offset = state.testimonialIndex * -33.33; // 3 items inside 300% width
            container.style.transform = `translateX(${offset}%)`;
        }

        function nextTestimonial() {
            state.testimonialIndex = (state.testimonialIndex + 1) % 3;
            updateTestimonialSlider();
        }

        function prevTestimonial() {
            state.testimonialIndex = (state.testimonialIndex - 1 + 3) % 3;
            updateTestimonialSlider();
        }
