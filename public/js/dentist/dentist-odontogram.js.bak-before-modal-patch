document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const config = window.ODONTOGRAM_CONFIG || {};

    const csrf =
        document.querySelector(
            'meta[name="csrf-token"]'
        )?.content || "";

    const $ = (selector, root = document) =>
        root.querySelector(selector);

    const $$ = (selector, root = document) =>
        [...root.querySelectorAll(selector)];

    const state = {
        patientId: "",
        selectedTooth: null,
        condition: "healthy",
        notes: "",
        data: {},
        history: []
    };

    const conditionNames = {
        healthy: "Healthy",
        caries: "Caries",
        filled: "Filled",
        crown: "Crown",
        missing: "Missing",
        "root-canal": "Root Canal",
        extraction: "Extraction",
        implant: "Implant",
        fracture: "Fracture",
        other: "Other"
    };

    const sidebar =
        $("#sidebar");

    const mobileMenuButton =
        $("#mobileMenuButton");

    const sidebarClose =
        $("#sidebarClose");

    const notificationButton =
        $("#notificationButton");

    const patientSelect =
        $("#patientSelect");

    const patientName =
        $("#patientName");

    const patientId =
        $("#patientId");

    const patientAge =
        $("#patientAge");

    const patientGender =
        $("#patientGender");

    const teeth =
        $$(".tooth");

    const conditionButtons =
        $$(".condition-button");

    const selectedToothNumber =
        $("#selectedToothNumber");

    const currentConditionDisplay =
        $("#currentConditionDisplay");

    const toothNotes =
        $("#toothNotes");

    const historyList =
        $("#historyList");

    const toastContainer =
        $("#toastContainer");

    const toothConditionModal =
        $("#toothConditionModal");

    const toothConditionOverlay =
        $(".tooth-condition-modal-overlay");

    const closeToothConditionModal =
        $("#closeToothConditionModal");

    const cancelToothCondition =
        $("#cancelToothCondition");

    const confirmToothCondition =
        $("#confirmToothCondition");

    const toothConfirmedModal =
        $("#toothConfirmedModal");

    const toothConfirmedOverlay =
        $(".tooth-confirmed-overlay");

    const toothConfirmedMessage =
        $("#toothConfirmedMessage");

    const closeToothConfirmedModal =
        $("#closeToothConfirmedModal");

    const conditionInputs =
        $$('input[name="tooth_condition"]');

    const applyToothButton =
        $("#applyToothButton");

    const clearToothButton =
        $("#clearToothButton");

    const clearToothConfirmationModal =
        $("#clearToothConfirmationModal");

    const clearToothModalOverlay =
        $("#clearToothModalOverlay");

    const clearToothMessage =
        $("#clearToothMessage");

    const cancelClearTooth =
        $("#cancelClearTooth");

    const confirmClearTooth =
        $("#confirmClearTooth");

    const saveChartButton =
        $("#saveChartButton");

    const saveChartConfirmationModal =
        $("#saveChartConfirmationModal");

    const saveChartModalOverlay =
        $("#saveChartModalOverlay");

    const cancelSaveChart =
        $("#cancelSaveChart");

    const confirmSaveChart =
        $("#confirmSaveChart");

    const clearHistoryButton =
        $("#clearHistoryButton");

    const clearHistoryConfirmationModal =
        $("#clearHistoryConfirmationModal");

    const clearHistoryModalOverlay =
        $("#clearHistoryModalOverlay");

    const cancelClearHistory =
        $("#cancelClearHistory");

    const confirmClearHistory =
        $("#confirmClearHistory");

    const logoutButton =
        $("#logoutButton");

    const logoutModal =
        $("#logoutModal");

    const logoutOverlay =
        $(".logout-modal-overlay");

    const cancelLogout =
        $("#cancelLogout");

    const confirmLogout =
        $("#confirmLogout");

    const successModal =
        $("#successModal");

    const successModalOverlay =
        $("#successModalOverlay");

    const successModalMessage =
        $("#successModalMessage");

    const closeSuccessModal =
        $("#closeSuccessModal");

    function toast(
        message,
        type = "success"
    ) {
        if (!toastContainer) {
            console.log(message);
            return;
        }

        const item =
            document.createElement("div");

        item.className =
            `toast ${type}`;

        item.textContent =
            message;

        toastContainer.appendChild(
            item
        );

        setTimeout(() => {
            item.remove();
        }, 3000);
    }

    function escapeHtml(value) {
        return String(value ?? "")
            .replaceAll("&", "&amp;")
            .replaceAll("<", "&lt;")
            .replaceAll(">", "&gt;")
            .replaceAll('"', "&quot;")
            .replaceAll("'", "&#039;");
    }

    function conditionClass(condition) {
        return String(
            condition || "healthy"
        )
            .toLowerCase()
            .replaceAll("_", "-")
            .replace(
                /[^a-z0-9-]/g,
                ""
            );
    }

    function hasPatient() {
        return Boolean(
            state.patientId
        );
    }

    function requirePatient() {
        if (hasPatient()) {
            return true;
        }

        toast(
            "Please select a patient first.",
            "error"
        );

        patientSelect?.focus();

        return false;
    }

    function openModal(modal) {
        if (!modal) {
            return;
        }

        modal.classList.remove(
            "hidden"
        );

        modal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.style.overflow =
            "hidden";
    }

    function closeModal(modal) {
        if (!modal) {
            return;
        }

        modal.classList.add(
            "hidden"
        );

        modal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.style.overflow =
            "";
    }

    function openSuccessModal(message) {
        if (!successModal) {
            toast(message);
            return;
        }

        if (successModalMessage) {
            successModalMessage.textContent =
                message;
        }

        openModal(successModal);
    }

    function closeSuccessModalFunction() {
        closeModal(successModal);
    }

    function openSidebar() {
        if (!sidebar) {
            return;
        }

        sidebar.classList.add(
            "open"
        );

        document.body.classList.add(
            "sidebar-open"
        );
    }

    function closeSidebar() {
        if (!sidebar) {
            return;
        }

        sidebar.classList.remove(
            "open"
        );

        document.body.classList.remove(
            "sidebar-open"
        );
    }

    function updatePatientInformation(option) {
        if (!option || !option.value) {
            if (patientName) {
                patientName.textContent =
                    "—";
            }

            if (patientId) {
                patientId.textContent =
                    "—";
            }

            if (patientAge) {
                patientAge.textContent =
                    "—";
            }

            if (patientGender) {
                patientGender.textContent =
                    "—";
            }

            return;
        }

        if (patientName) {
            patientName.textContent =
                option.dataset.name ||
                option.textContent.trim() ||
                "—";
        }

        if (patientId) {
            patientId.textContent =
                option.dataset.patientId ||
                option.value ||
                "—";
        }

        if (patientAge) {
            patientAge.textContent =
                option.dataset.age
                    ? `${option.dataset.age} years`
                    : "—";
        }

        if (patientGender) {
            patientGender.textContent =
                option.dataset.gender ||
                option.dataset.sex ||
                "—";
        }
    }

    function updateOdontogramAvailability() {
        const enabled =
            hasPatient();

        teeth.forEach(tooth => {
            tooth.classList.toggle(
                "disabled-tooth",
                !enabled
            );

            tooth.setAttribute(
                "aria-disabled",
                enabled
                    ? "false"
                    : "true"
            );
        });

        conditionButtons.forEach(button => {
            button.disabled =
                !enabled;
        });

        if (applyToothButton) {
            applyToothButton.disabled =
                !enabled;
        }

        if (clearToothButton) {
            clearToothButton.disabled =
                !enabled;
        }

        if (saveChartButton) {
            saveChartButton.disabled =
                !enabled;
        }

        if (clearHistoryButton) {
            clearHistoryButton.disabled =
                !enabled;
        }
    }

    async function request(
        url,
        options = {}
    ) {
        if (!url) {
            throw new Error(
                "Odontogram API URL is not configured."
            );
        }

        const response =
            await fetch(
                url,
                {
                    credentials:
                        "same-origin",

                    headers: {
                        Accept:
                            "application/json",

                        "Content-Type":
                            "application/json",

                        "X-CSRF-TOKEN":
                            csrf,

                        "X-Requested-With":
                            "XMLHttpRequest",

                        ...(options.headers || {})
                    },

                    ...options
                }
            );

        let payload = {};

        try {
            payload =
                await response.json();
        } catch (error) {
            payload = {};
        }

        if (!response.ok) {
            throw new Error(
                payload.message ||
                payload.error ||
                `Request failed (${response.status})`
            );
        }

        return payload;
    }

    function clearToothVisual(tooth) {
        if (!tooth) {
            return;
        }

        tooth.classList.remove(
            "selected",
            "condition-healthy",
            "condition-caries",
            "condition-filled",
            "condition-crown",
            "condition-missing",
            "condition-root-canal",
            "condition-extraction",
            "condition-implant",
            "condition-fracture",
            "condition-other"
        );

        tooth.setAttribute(
            "aria-pressed",
            "false"
        );
    }

    function paintTooth(
        toothNumber,
        condition
    ) {
        const tooth =
            $(
                `.tooth[data-tooth="${CSS.escape(
                    String(toothNumber)
                )}"]`
            );

        if (!tooth) {
            return;
        }

        clearToothVisual(tooth);

        tooth.classList.add(
            "selected",
            `condition-${conditionClass(
                condition
            )}`
        );

        tooth.setAttribute(
            "aria-pressed",
            "true"
        );
    }

    function clearAllToothVisuals() {
        teeth.forEach(tooth => {
            clearToothVisual(tooth);
        });
    }
    function updateSelectedToothPanel() {
    if (!state.selectedTooth) {
        if (selectedToothNumber) {
            selectedToothNumber.textContent =
                "No Tooth Selected";
        }

        if (currentConditionDisplay) {
            currentConditionDisplay.textContent =
                "Healthy";

            currentConditionDisplay.className =
                "condition-display healthy";
        }

        if (toothNotes) {
            toothNotes.value = "";
        }

        conditionButtons.forEach(button => {
            button.classList.remove("active");
        });

        return;
    }

    if (selectedToothNumber) {
        selectedToothNumber.textContent =
            `Tooth ${state.selectedTooth}`;
    }

    if (currentConditionDisplay) {
        currentConditionDisplay.textContent =
            conditionNames[state.condition] ||
            "Healthy";

        currentConditionDisplay.className =
            `condition-display ${conditionClass(
                state.condition
            )}`;
    }

    if (toothNotes) {
        toothNotes.value =
            state.notes || "";
    }

    conditionButtons.forEach(button => {
        button.classList.toggle(
            "active",
            button.dataset.condition ===
            state.condition
        );
    });
}
    function updateSummary() {
        teeth.forEach(tooth => {
            const number =
                tooth.dataset.tooth;

            const record =
                state.data[number];

            if (record) {
                paintTooth(
                    number,
                    record.condition
                );
            } else {
                clearToothVisual(
                    tooth
                );
            }
        });
    }

    function updateHistory() {
        if (!historyList) {
            return;
        }

        if (!state.history.length) {
            historyList.innerHTML = `
                <div class="history-empty">
                    <span>
                        No changes recorded yet.
                    </span>
                </div>
            `;

            return;
        }

        historyList.innerHTML =
            state.history
                .slice()
                .reverse()
                .map(item => {
                    return `
                        <div class="history-item">
                            <span class="history-dot"></span>

                            <div>
                                <strong>
                                    Tooth ${escapeHtml(
                                        item.tooth
                                    )}
                                </strong>

                                <p>
                                    ${escapeHtml(
                                        conditionNames[
                                            item.condition
                                        ] ||
                                        item.condition ||
                                        "Healthy"
                                    )}

                                    ${
                                        item.remarks
                                            ? ` — ${escapeHtml(
                                                item.remarks
                                            )}`
                                            : ""
                                    }
                                </p>

                                <time>
                                    ${escapeHtml(
                                        item.time || ""
                                    )}
                                </time>
                            </div>
                        </div>
                    `;
                })
                .join("");
    }

    function addHistory(
        tooth,
        condition,
        remarks
    ) {
        state.history.push({
            tooth:
                String(tooth),

            condition:
                condition,

            remarks:
                remarks || "",

            time:
                new Date()
                    .toLocaleString()
        });

        updateHistory();
    }

    function resetChartState() {
        state.data = {};
        state.history = [];
        state.selectedTooth = null;
        state.condition = "healthy";
        state.notes = "";

        clearAllToothVisuals();
        updateSelectedToothPanel();
        updateHistory();
    }

    async function loadPatientChart(id) {
        if (!id) {
            resetChartState();
            return;
        }

        if (!config.loadUrl) {
            toast(
                "Patient chart URL is not configured.",
                "error"
            );

            return;
        }

        try {
            const url =
                config.loadUrl.replace(
                    "__PATIENT_ID__",
                    encodeURIComponent(id)
                );

            const result =
                await request(
                    url,
                    {
                        method:
                            "GET"
                    }
                );

            if (!result.success) {
                throw new Error(
                    result.message ||
                    "Unable to load patient odontogram."
                );
            }

            state.data = {};
            state.history = [];

            const odontogramData =
                result.data &&
                typeof result.data ===
                "object"
                    ? result.data
                    : {};

            Object.entries(
                odontogramData
            ).forEach(
                (
                    [
                        toothNumber,
                        record
                    ]
                ) => {
                    if (!record) {
                        return;
                    }

                    state.data[
                        String(
                            toothNumber
                        )
                    ] = {
                        condition:
                            record.condition ||
                            "healthy",

                        remarks:
                            record.remarks ||
                            ""
                    };
                }
            );

            if (
                Array.isArray(
                    result.history
                )
            ) {
                state.history =
                    result.history;
            } else {
                Object.entries(
                    state.data
                ).forEach(
                    (
                        [
                            toothNumber,
                            record
                        ]
                    ) => {
                        state.history.push({
                            tooth:
                                toothNumber,

                            condition:
                                record.condition,

                            remarks:
                                record.remarks,

                            time:
                                ""
                        });
                    }
                );
            }

            state.selectedTooth =
                null;

            state.condition =
                "healthy";

            state.notes =
                "";

            updateSummary();
            updateSelectedToothPanel();
            updateHistory();

        } catch (error) {
            console.error(
                "Unable to load patient chart:",
                error
            );

            resetChartState();

            toast(
                error.message ||
                "Unable to load patient chart.",
                "error"
            );
        }
    }

    function openToothConditionModal(
        toothNumber
    ) {
        if (!requirePatient()) {
            return;
        }

        state.selectedTooth =
            String(toothNumber);

        const record =
            state.data[
                state.selectedTooth
            ];

        const currentCondition =
            record?.condition ||
            "healthy";

        conditionInputs.forEach(
            input => {
                input.checked =
                    input.value ===
                    currentCondition;
            }
        );

        updateSelectedToothPanel();

        if (!toothConditionModal) {
            return;
        }

        openModal(
            toothConditionModal
        );
    }

    function closeToothConditionModalFunction() {
        closeModal(
            toothConditionModal
        );
    }

    function showToothConfirmedModal(
        toothNumber,
        condition
    ) {
        const message =
            `Tooth ${toothNumber} has been updated to ${
                conditionNames[
                    condition
                ] ||
                condition
            }.`;

        if (!toothConfirmedModal) {
            openSuccessModal(
                message
            );

            return;
        }

        if (toothConfirmedMessage) {
            toothConfirmedMessage.textContent =
                message;
        }

        openModal(
            toothConfirmedModal
        );
    }

    function closeToothConfirmedModalFunction() {
        closeModal(
            toothConfirmedModal
        );
    }

    function openClearToothModal() {
        if (!requirePatient()) {
            return;
        }

        if (!state.selectedTooth) {
            toast(
                "Please select a tooth first.",
                "error"
            );

            return;
        }

        if (!clearToothConfirmationModal) {
            clearSelectedTooth();
            return;
        }

        if (clearToothMessage) {
            clearToothMessage.textContent =
                `Are you sure you want to clear Tooth ${state.selectedTooth}?`;
        }

        openModal(
            clearToothConfirmationModal
        );
    }

    function closeClearToothModal() {
        closeModal(
            clearToothConfirmationModal
        );
    }

    function clearSelectedTooth() {
        if (!requirePatient()) {
            return;
        }

        if (!state.selectedTooth) {
            toast(
                "Please select a tooth first.",
                "error"
            );

            return;
        }

        const toothNumber =
            state.selectedTooth;

        delete state.data[
            toothNumber
        ];

        const tooth =
            $(
                `.tooth[data-tooth="${CSS.escape(
                    String(toothNumber)
                )}"]`
            );

        clearToothVisual(
            tooth
        );

        state.selectedTooth =
            null;

        state.condition =
            "healthy";

        state.notes =
            "";

        updateSelectedToothPanel();
        updateSummary();

        closeClearToothModal();

        openSuccessModal(
            `Tooth ${toothNumber} has been cleared successfully.`
        );
    }

    function openSaveChartModal() {
        if (!requirePatient()) {
            return;
        }

        if (!saveChartConfirmationModal) {
            saveChart();
            return;
        }

        openModal(
            saveChartConfirmationModal
        );
    }

    function closeSaveChartModal() {
        closeModal(
            saveChartConfirmationModal
        );
    }

    async function saveChart() {
        if (!requirePatient()) {
            return;
        }

        if (!config.saveUrl) {
            toast(
                "Save URL is not configured.",
                "error"
            );

            return;
        }

        const originalText =
            saveChartButton?.textContent
                .trim() ||
            "Save Chart";

        if (saveChartButton) {
            saveChartButton.disabled =
                true;

            saveChartButton.textContent =
                "Saving...";
        }

        try {
            const result =
                await request(
                    config.saveUrl,
                    {
                        method:
                            "POST",

                        body:
                            JSON.stringify({
                                patient_id:
                                    state.patientId,

                                odontogram:
                                    state.data
                            })
                    }
                );

            if (
                result.data &&
                typeof result.data ===
                "object"
            ) {
                state.data =
                    result.data;
            }

            if (
                Array.isArray(
                    result.history
                )
            ) {
                state.history =
                    result.history;
            }

            updateSummary();
            updateHistory();
            updateSelectedToothPanel();

            openSuccessModal(
                result.message ||
                "Dental chart saved successfully."
            );

        } catch (error) {
            console.error(
                "Save error:",
                error
            );

            toast(
                error.message ||
                "Unable to save dental chart.",
                "error"
            );

        } finally {
            if (saveChartButton) {
                saveChartButton.disabled =
                    false;

                saveChartButton.textContent =
                    originalText;
            }
        }
    }

    function openClearHistoryModal() {
        if (!requirePatient()) {
            return;
        }

        if (!clearHistoryConfirmationModal) {
            clearSavedChart();
            return;
        }

        openModal(
            clearHistoryConfirmationModal
        );
    }

    function closeClearHistoryModal() {
        closeModal(
            clearHistoryConfirmationModal
        );
    }

    async function clearSavedChart() {
        if (!requirePatient()) {
            return;
        }

        if (!config.clearUrl) {
            toast(
                "Clear URL is not configured.",
                "error"
            );

            return;
        }

        if (confirmClearHistory) {
            confirmClearHistory.disabled =
                true;
        }

        try {
            const result =
                await request(
                    config.clearUrl,
                    {
                        method:
                            "POST",

                        body:
                            JSON.stringify({
                                patient_id:
                                    state.patientId
                            })
                    }
                );

            state.data = {};

            state.history =
                Array.isArray(
                    result.history
                )
                    ? result.history
                    : [];

            state.selectedTooth =
                null;

            state.condition =
                "healthy";

            state.notes =
                "";

            updateSummary();
            updateSelectedToothPanel();
            updateHistory();

            closeClearHistoryModal();

            openSuccessModal(
                result.message ||
                "Dental chart history has been cleared successfully."
            );

        } catch (error) {
            console.error(
                "Clear error:",
                error
            );

            toast(
                error.message ||
                "Unable to clear dental chart.",
                "error"
            );

        } finally {
            if (confirmClearHistory) {
                confirmClearHistory.disabled =
                    false;
            }
        }
    }

    function openLogoutModal() {
        openModal(
            logoutModal
        );
    }

    function closeLogoutModal() {
        closeModal(
            logoutModal
        );
    }

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener(
            "click",
            openSidebar
        );
    }

    if (sidebarClose) {
        sidebarClose.addEventListener(
            "click",
            closeSidebar
        );
    }

    document.addEventListener(
        "click",
        event => {
            if (
                window.innerWidth <= 850 &&
                sidebar &&
                sidebar.classList.contains(
                    "open"
                ) &&
                !sidebar.contains(
                    event.target
                ) &&
                !mobileMenuButton?.contains(
                    event.target
                )
            ) {
                closeSidebar();
            }
        }
    );

    if (notificationButton) {
        notificationButton.addEventListener(
            "click",
            () => {
                toast(
                    "No new notifications."
                );
            }
        );
    }

    if (patientSelect) {
        patientSelect.addEventListener(
            "change",
            async event => {
                state.patientId =
                    event.target.value;

                const option =
                    event.target
                        .selectedOptions[0];

                resetChartState();

                updatePatientInformation(
                    option
                );

                updateOdontogramAvailability();

                if (!state.patientId) {
                    return;
                }

                await loadPatientChart(
                    state.patientId
                );
            }
        );
    }

    teeth.forEach(tooth => {
        tooth.addEventListener(
            "click",
            event => {
                event.preventDefault();

                if (!requirePatient()) {
                    return;
                }

                const number =
                    tooth.dataset.tooth;

                if (!number) {
                    return;
                }

                openToothConditionModal(
                    number
                );
            }
        );
    });

conditionButtons.forEach(button => {
    button.addEventListener(
        "click",
        event => {
            event.preventDefault();

            if (!requirePatient()) {
                return;
            }

            if (!state.selectedTooth) {
                toast(
                    "Please select a tooth first.",
                    "error"
                );

                return;
            }

            const selectedCondition =
                button.dataset.condition;

            if (!selectedCondition) {
                return;
            }

            state.condition =
                selectedCondition;

            conditionButtons.forEach(item => {
                item.classList.toggle(
                    "active",
                    item === button
                );
            });

            if (currentConditionDisplay) {
                currentConditionDisplay.textContent =
                    conditionNames[selectedCondition] ||
                    selectedCondition;

                currentConditionDisplay.className =
                    `condition-display ${conditionClass(
                        selectedCondition
                    )}`;
            }
        }
    );
});

    if (confirmToothCondition) {
        confirmToothCondition.addEventListener(
            "click",
            () => {
                if (!requirePatient()) {
                    return;
                }

                if (!state.selectedTooth) {
                    toast(
                        "Please select a tooth first.",
                        "error"
                    );

                    return;
                }

                const selectedInput =
                    $(
                        'input[name="tooth_condition"]:checked'
                    );

                if (!selectedInput) {
                    toast(
                        "Please select a tooth condition.",
                        "error"
                    );

                    return;
                }

                const toothNumber =
                    state.selectedTooth;

                const condition =
                    selectedInput.value ||
                    "healthy";

                const existingRecord =
                    state.data[
                        toothNumber
                    ] || {};

                const remarks =
                    existingRecord.remarks ||
                    "";

                state.data[
                    toothNumber
                ] = {
                    condition:
                        condition,

                    remarks:
                        remarks
                };

                state.condition =
                    condition;

                paintTooth(
                    toothNumber,
                    condition
                );

                addHistory(
                    toothNumber,
                    condition,
                    remarks
                );

                updateSelectedToothPanel();

                closeToothConditionModalFunction();

                showToothConfirmedModal(
                    toothNumber,
                    condition
                );
            }
        );
    }

    if (closeToothConditionModal) {
        closeToothConditionModal.addEventListener(
            "click",
            closeToothConditionModalFunction
        );
    }

    if (cancelToothCondition) {
        cancelToothCondition.addEventListener(
            "click",
            closeToothConditionModalFunction
        );
    }

    if (toothConditionOverlay) {
        toothConditionOverlay.addEventListener(
            "click",
            closeToothConditionModalFunction
        );
    }

    if (closeToothConfirmedModal) {
        closeToothConfirmedModal.addEventListener(
            "click",
            closeToothConfirmedModalFunction
        );
    }

    if (toothConfirmedOverlay) {
        toothConfirmedOverlay.addEventListener(
            "click",
            closeToothConfirmedModalFunction
        );
    }

    if (toothNotes) {
        toothNotes.addEventListener(
            "input",
            event => {
                state.notes =
                    event.target.value;
            }
        );
    }

    if (applyToothButton) {
        applyToothButton.addEventListener(
            "click",
            () => {
                if (!requirePatient()) {
                    return;
                }

                if (!state.selectedTooth) {
                    toast(
                        "Select a tooth first.",
                        "error"
                    );

                    return;
                }

                const toothNumber =
                    state.selectedTooth;

                const condition =
                    state.condition ||
                    "healthy";

                const remarks =
                    toothNotes?.value ||
                    "";

                state.data[
                    toothNumber
                ] = {
                    condition:
                        condition,

                    remarks:
                        remarks
                };

                paintTooth(
                    toothNumber,
                    condition
                );

                addHistory(
                    toothNumber,
                    condition,
                    remarks
                );

                updateSelectedToothPanel();

                showToothConfirmedModal(
                    toothNumber,
                    condition
                );
            }
        );
    }

    if (clearToothButton) {
        clearToothButton.addEventListener(
            "click",
            openClearToothModal
        );
    }

    if (cancelClearTooth) {
        cancelClearTooth.addEventListener(
            "click",
            closeClearToothModal
        );
    }

    if (clearToothModalOverlay) {
        clearToothModalOverlay.addEventListener(
            "click",
            closeClearToothModal
        );
    }

    if (confirmClearTooth) {
        confirmClearTooth.addEventListener(
            "click",
            clearSelectedTooth
        );
    }

    if (saveChartButton) {
        saveChartButton.addEventListener(
            "click",
            openSaveChartModal
        );
    }

    if (cancelSaveChart) {
        cancelSaveChart.addEventListener(
            "click",
            closeSaveChartModal
        );
    }

    if (saveChartModalOverlay) {
        saveChartModalOverlay.addEventListener(
            "click",
            closeSaveChartModal
        );
    }

    if (confirmSaveChart) {
        confirmSaveChart.addEventListener(
            "click",
            async () => {
                closeSaveChartModal();

                await saveChart();
            }
        );
    }

    if (clearHistoryButton) {
        clearHistoryButton.addEventListener(
            "click",
            openClearHistoryModal
        );
    }

    if (cancelClearHistory) {
        cancelClearHistory.addEventListener(
            "click",
            closeClearHistoryModal
        );
    }

    if (clearHistoryModalOverlay) {
        clearHistoryModalOverlay.addEventListener(
            "click",
            closeClearHistoryModal
        );
    }

    if (confirmClearHistory) {
        confirmClearHistory.addEventListener(
            "click",
            clearSavedChart
        );
    }

    if (logoutButton) {
        logoutButton.addEventListener(
            "click",
            event => {
                event.preventDefault();

                openLogoutModal();
            }
        );
    }

    if (cancelLogout) {
        cancelLogout.addEventListener(
            "click",
            closeLogoutModal
        );
    }

    if (logoutOverlay) {
        logoutOverlay.addEventListener(
            "click",
            closeLogoutModal
        );
    }

    if (confirmLogout) {
        confirmLogout.addEventListener(
            "click",
            () => {
                const logoutForm =
                    logoutButton?.closest(
                        "form"
                    );

                if (logoutForm) {
                    logoutForm.submit();
                }
            }
        );
    }

    if (closeSuccessModal) {
        closeSuccessModal.addEventListener(
            "click",
            closeSuccessModalFunction
        );
    }

    if (successModalOverlay) {
        successModalOverlay.addEventListener(
            "click",
            closeSuccessModalFunction
        );
    }

    document.addEventListener(
        "keydown",
        event => {
            if (
                event.key !== "Escape"
            ) {
                return;
            }

            closeToothConditionModalFunction();
            closeToothConfirmedModalFunction();
            closeClearToothModal();
            closeSaveChartModal();
            closeClearHistoryModal();
            closeLogoutModal();
            closeSuccessModalFunction();
        }
    );

    const initialOption =
        patientSelect
            ?.selectedOptions?.[0];

    if (
        initialOption &&
        initialOption.value
    ) {
        state.patientId =
            initialOption.value;

        updatePatientInformation(
            initialOption
        );

        loadPatientChart(
            state.patientId
        );
    } else {
        state.patientId =
            "";

        updatePatientInformation(
            null
        );
    }

    updateOdontogramAvailability();
    updateSelectedToothPanel();
    updateHistory();
    updateSummary();

    console.log(
        `Dentist Odontogram initialized. ${teeth.length} teeth detected.`
    );
});


