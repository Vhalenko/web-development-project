// const tasksCompleted = <?php echo count($completedTasks) ?>;
//     const tasksUncompleted = <?php echo count($uncumpletedTasks) ?>;
//     const streakCount = <?php echo $user->getStreakCount(); ?>;
//     const totalPoints = <?php echo $user->getTotalPoints(); ?>;

//     new Chart(document.getElementById('tasksChart'), {
//         type: 'doughnut',
//         data: {
//             labels: ['Completed Tasks', 'Remaining'],
//             datasets: [{
//                 data: [tasksCompleted, tasksUncompleted],
//                 backgroundColor: ['#28a745', '#ddd']
//             }]
//         }
//     });

//     new Chart(document.getElementById('streakChart'), {
//         type: 'bar',
//         data: {
//             labels: ['Current Streak'],
//             datasets: [{
//                 data: [streakCount],
//                 backgroundColor: ['#007bff']
//             }]
//         },
//         options: { responsive: true }
//     });