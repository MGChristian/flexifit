const ctx = document.getElementById("myChart");

new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["Yoga", "Strength", "Cardio", "Body", "Bike", "Box"],
    datasets: [
      {
        label: "# of Votes",
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const revenuectx = document.getElementById("revenueChart");

new Chart(revenuectx, {
  type: "doughnut",
  data: {
    labels: ["Attended", "Refunded", "No Show"],
    datasets: [
      {
        label: "# of Votes",
        data: [12, 19, 3],
        borderWidth: 1,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
