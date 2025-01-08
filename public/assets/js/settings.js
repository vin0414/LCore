function openTab(tabId) {
    // Hide all content
    const allTabs = document.querySelectorAll(".tab");
    const allPanes = document.querySelectorAll(".tab-pane");

    allTabs.forEach((tab) => tab.classList.remove("active"));
    allPanes.forEach((pane) => pane.classList.remove("active"));

    // Show the clicked tab and its corresponding content
    const activeTab = document.getElementById(tabId);
    const activePane = document.getElementById(`content-${tabId}`);

    activeTab.classList.add("active");
    activePane.classList.add("active");
}

// Set default tab to be open
document.addEventListener("DOMContentLoaded", () => {
    openTab("tab1");
});

$(document).on("click", ".department", function () {
    $("#departmentModal").css("display", "flex");
    $("body").addClass("no-scroll");
});

function closeEditModal() {
    $("#edit_departmentModal").css("display", "none");
    $("body").removeClass("no-scroll");
}

function closeModal() {
    $("#departmentModal").css("display", "none");
    $("body").removeClass("no-scroll");
}

$(document).on("click", ".credit", function () {
    $("#creditModal").css("display", "flex");
    $("body").addClass("no-scroll");
});

function closeCreditModal() {
    $("#creditModal").css("display", "none");
    $("body").removeClass("no-scroll");
}

function closeEditCreditModal() {
    $("#edit_creditModal").css("display", "none");
    $("body").removeClass("no-scroll");
}

$(document).on("click", ".schedule", function () {
    $("#scheduleModal").css("display", "flex");
    $("body").addClass("no-scroll");
});

function closeScheduleModal() {
    $("#scheduleModal").css("display", "none");
    $("body").removeClass("no-scroll");
}

function closeEditScheduleModal() {
    $("#edit_scheduleModal").css("display", "none");
    $("body").removeClass("no-scroll");
}

// New designation modal
$(document).on("click", ".designation", function () {
    $("#jobCreateModal").css("display", "flex");
    $("body").addClass("no-scroll");
});

function closeDesignationModal() {
    $("#jobCreateModal").css("display", "none");
    $("body").removeClass("no-scroll");
}

function closeEditDesignationModal() {
    $("#edit_jobCreateModal").css("display", "none");
    $("body").removeClass("no-scroll");
}
