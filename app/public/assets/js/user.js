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

    const xValues = [];
    const yValues = [];
    generateData("x", 0, streakCount, 0.5);

    new Chart(document.getElementById("streakChart"), {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                pointRadius: 1,
                borderColor: "rgba(255,0,0,0.5)",
                data: yValues
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Your Streak Progress"
                }
            }
        }
    });
    

    function generateData(value, i1, i2, step = 1) {
        for (let x = i1; x <= i2; x += step) {
            yValues.push(eval(value));
            xValues.push(x);
        }
    }
});

document.getElementById('profilePicture').addEventListener('change', function() {
    const selectedPicture = this.value;
    document.getElementById('profilePreview').src = `../../assets/img/profiles/${selectedPicture}`;
});
