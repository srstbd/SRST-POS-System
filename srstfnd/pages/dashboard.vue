<script setup lang="ts">
import { ref, onMounted, watch } from "vue";
import { Line, Pie } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  ArcElement,
} from "chart.js";
import Datepicker from "vue3-datepicker";
import "vue3-datepicker/dist/main.css";
import Echo from "laravel-echo";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  ArcElement
);

const dashboard = ref({
  total_sales: 0,
  total_orders: 0,
  top_products: [],
});

const lineChartData = ref({
  labels: [],
  datasets: [
    {
      label: "Sales (in $)",
      data: [],
      fill: true,
      borderColor: "#4c51bf",
      tension: 0.4,
    },
  ],
});

const pieChartData = ref({
  labels: [],
  datasets: [
    {
      label: "Top-Selling Products",
      data: [],
      backgroundColor: ["#4c51bf", "#38b2ac", "#ed64a6", "#f6ad55", "#68d391"],
    },
  ],
});

const loadDashboard = async () => {
  try {
    const res = await $fetch("/api/dashboard");
    dashboard.value = res;
    loadChartData(res.top_products);
    loadLineChartData();
  } catch (err) {
    console.error("Dashboard fetch error", err);
  }
};

const loadLineChartData = async () => {
  const res = await $fetch(`/api/sales-trend`);
  lineChartData.value.labels = res.labels;
  lineChartData.value.datasets[0].data = res.salesData;
};

const loadChartData = (topProducts) => {
  pieChartData.value.labels = topProducts.map(
    (product) => `Product #${product.product_id}`
  );
  pieChartData.value.datasets[0].data = topProducts.map(
    (product) => product.total_quantity
  );
};

// Listen for Sales Updates
onMounted(() => {
  loadDashboard();

  window.Echo.channel("sales-channel").listen("SalesUpdated", (event) => {
    dashboard.value = event.salesData;
    loadChartData(event.salesData.top_products); // Update top products
    loadLineChartData(); // Refresh the line chart with the latest data
  });
});
</script>
