let currentMonthIndex = 1;
const monthImages = [
    "Actual vs Predicted Values Month 1.png",
    "Actual vs Predicted Values Month 2.png",
    "Actual vs Predicted Values Month 3.png",
    "Actual vs Predicted Values Month 4.png",
    "Actual vs Predicted Values Month 5.png",
    "Actual vs Predicted Values Month 6.png",
    "Actual vs Predicted Values Month 7.png",
    "Actual vs Predicted Values Month 8.png",
    "Actual vs Predicted Values Month 9.png",
    "Actual vs Predicted Values Month 10.png",
    "Actual vs Predicted Values Month 11.png",
    "Actual vs Predicted Values Month 12.png"
];

const monthImage = document.getElementById("month-image");
const trendImage = document.getElementById("trend-image");
const anomalyImage = document.getElementById("anomaly-image");
const predictedImage = document.getElementById("predicted-image");

function prevMonth() {
    currentMonthIndex = (currentMonthIndex - 1 + monthImages.length) % monthImages.length;
    monthImage.src = monthImages[currentMonthIndex];
}

function nextMonth() {
    currentMonthIndex = (currentMonthIndex + 1) % monthImages.length;
    monthImage.src = monthImages[currentMonthIndex];
}

function changeTrend(trend) {
    let imageSrc;
    switch (trend) {
        case "rainfall":
            imageSrc = "Average Monthly Rainfall Trend.png";
            break;
        case "temperature":
            imageSrc = "Average Monthly Temperature Trend.png";
            break;
        case "humidity":
            imageSrc = "Average Monthly Relative Humidity Trend.png";
            break;
        case "wind":
            imageSrc = "Average Monthly Wind Speed Trend.png";
            break;
        default:
            imageSrc = "Average Monthly Rainfall Trend.png";
    }
    trendImage.src = imageSrc;
}

function changeAnomalyPlot(plotType) {
    let imageSrc;
    switch (plotType) {
        case "rainfall":
            imageSrc = "Rainfall Anomaly Plot.png";
            break;
        case "temperature":
            imageSrc = "Temperature Anomaly Plot.png";
            break;
        case "humidity":
            imageSrc = "Relative Humidity Anomaly Plot.png";
            break;
        case "wind":
            imageSrc = "Wind Speed Trend Plot.png";
            break;
        default:
            imageSrc = "Rainfall Anomaly Plot.png";
    }
    anomalyImage.src = imageSrc;
}

function changeScatterPlot(plotType) {
    const scatterImages = document.querySelectorAll("#scatter-plot-image");
    let imageSrc;
    switch (plotType) {
        case "rainfall-humidity":
            imageSrc = "Scatter-Rainfall-Relative Humidity.png";
            break;
        case "rainfall-temperature":
            imageSrc = "Scatter-Rainfall-Temperature.png";
            break;
        case "temperature-humidity":
            imageSrc = "Scatter-Temperature-Relative Humidity.png";
            break;
        default:
            imageSrc = "Scatter-Rainfall-Relative Humidity.png";
    }
    scatterImages.forEach(img => img.src = imageSrc);
}

function changePredictedImage(predictionType) {
    let imageSrc;
    switch (predictionType) {
        case "rainfall":
            imageSrc = "Predicted Values for Rainfall 2024.png";
            break;
        case "temperature":
            imageSrc = "Predicted Values for Temperature 2024.png";
            break;
        case "humidity":
            imageSrc = "Predicted Values for Relative Humidity 2024.png";
            break;
        case "wind":
            imageSrc = "Predicted Values for Wind Speed 2024.png";
            break;
        default:
            imageSrc = "Predicted Values for Rainfall 2024.png";
    }
    predictedImage.src = imageSrc;
}
