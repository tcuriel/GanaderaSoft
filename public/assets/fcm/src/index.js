import { Chart } from "../node_modules/frappe-charts/dist/frappe-charts.esm.js";
//          frappe-charts/dist/frappe-charts.min.css
//import "../frappe-charts/dist/frappe-charts.min.css";

const schoolNames = [
  "_Cloud",
  "DLA Excellence School",
  "DLA-685",
  "East West School",
  "easy tech only",
  "expired",
  "Inquiry Only School",
  "Sophie School",
  "wwwschool",
  "xxxschool",
  "yyyschool",
  "zzzschool"
];

const compliantBySchool = [0, 57, 1, 12, 0, 1, 0, 0, 0, 0, 0, 1];
const nonCompliantBySchool = [7, 178, 3, 3, 1, 0, 1, 1, 2, 1, 1, 4];

const totalCompliant = compliantBySchool.reduce((a, c) => a + c);
const totalNonCompliant = nonCompliantBySchool.reduce((a, c) => a + c);

new Chart("#totals", {
  data: {
    labels: ["Machos", "Hembras"],
    datasets: [
      {
        chartType: "bar",
        values: [totalCompliant, totalNonCompliant]
      }
    ]
  },
  title: "Animales",
  type: "donut"
});

new Chart("#by-school", {
  // or DOM element
  data: {
    labels: schoolNames,

    datasets: [
      {
        name: "Machos",
        values: compliantBySchool
      },
      {
        name: "Hembras",
        values: nonCompliantBySchool
      }
    ]
  },

  title: "Animales por rebaño",
  type: "bar", // or 'bar', 'line', 'pie', 'percentage'
  height: 300,
  colors: ["purple", "#ffa3ef", "light-blue"],
  axisOptions: {
    xAxisMode: "tick",
    xIsSeries: false
  },
  barOptions: {
    stacked: true,
    spaceRatio: 0.2
  },
  tooltipOptions: {
    formatTooltipX: (d) => (d + "").toUpperCase(),
    formatTooltipY: (d) => d
  },
  valuesOverPoints: false
});
