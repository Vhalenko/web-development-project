document.addEventListener("DOMContentLoaded", function () {
    const tasksCompleted = Number(document.getElementById("tasksChart").dataset.tasksCompleted);
    const tasksUncompleted = Number(document.getElementById("tasksChart").dataset.tasksUncompleted);
    const streakCount = Number(document.getElementById("streakChart").dataset.streakCount);

    new Chart(document.getElementById("tasksChart"), {
        type: "doughnut",
        data: {
            labels: ["Completed Tasks", "Remaining"],
            datasets: [{
                data: [tasksCompleted, tasksUncompleted],
                backgroundColor: ["#28a745", "#ddd"]
            }]
        }
    });

    new Chart(document.getElementById("streakChart"), {
        type: "bar",
        data: {
            labels: ["Current Streak"],
            datasets: [{
                data: [streakCount],
                backgroundColor: ["#007bff"]
            }]
        },
        options: { responsive: true }
    });
});
