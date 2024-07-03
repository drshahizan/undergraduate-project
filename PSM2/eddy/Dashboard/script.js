document.addEventListener('DOMContentLoaded', () => {
    updateDateTime();
    fetchWeatherData();
    setupImagePopups();
});

function updateDateTime() {
    const dateTimeElement = document.getElementById('current-date-time');
    const now = new Date();
    const options = { weekday: 'short', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    dateTimeElement.textContent = now.toLocaleDateString('en-US', options);
}

function fetchWeatherData() {
    const apiKey = 'bf39cf85c610ee98cbadd5d84ac42ca8';
    const dashboardId = getDashboardId();
    const city = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            document.getElementById('weather-description').textContent = `Weather: ${data.weather[0].description}`;
            document.getElementById('temperature').innerHTML = `Temperature: ${data.main.temp}°C`;
			document.getElementById('humidity').innerHTML = `Humidity: ${data.main.humidity}%`;
			document.getElementById('wind-speed').innerHTML = `Wind Speed: ${data.wind.speed} m/s`;
        })
        .catch(error => console.error('Error fetching weather data:', error));
}

function getDashboardId() {
    return document.body.id;
}

let currentHeatmapType = 'rainfall';
let currentHeatmapYear = 2023;

function changeAllGraphs(type) {
    currentHeatmapType = type;
    changePredictedImage(type);
    changeTrend(type);
    changeAnomalyPlot(type);
    changeLast5YearsTrend(type);
    changeScatterPlot(type);
    changePredictionComparison(type);
    updateHeatmapButton(type);
}

function changePredictedImage(type) {
    const predictedImage = document.getElementById('predicted-image');
    const dashboardId = getDashboardId();

    const imageMappings = {
        rainfall: 'Predicted%20Values%20for%20Rainfall%202024',
        temperature: 'Predicted%20Values%20for%20Temperature%202024',
        humidity: 'Predicted Values for Relative Humidity 2024',
        wind: 'Predicted%20Values%20for%20Wind%20Speed%202024'
    };

    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';
    predictedImage.src = `${imageMappings[type]}%20${location}.png`;
    predictedImage.alt = `Predicted Values for ${type.charAt(0).toUpperCase() + type.slice(1)} 2024`;
}

function changeTrend(type) {
    const trendImage = document.getElementById('trend-image');
    const dashboardId = getDashboardId();

    const imageMappings = {
        rainfall: 'Average%20Monthly%20Rainfall%20Trend',
        temperature: 'Average%20Monthly%20Temperature%20Trend',
        humidity: 'Average%20Monthly%20Relative%20Humidity%20Trend',
        wind: 'Average%20Monthly%20Wind%20Speed%20Trend'
    };

    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';
    trendImage.src = `${imageMappings[type]}%20${location}.png`;
    trendImage.alt = `Average Monthly ${type.charAt(0).toUpperCase() + type.slice(1)} Trend`;
}

function changeAnomalyPlot(type) {
    const anomalyImage = document.getElementById('anomaly-image');
    const dashboardId = getDashboardId();

    const imageMappings = {
        rainfall: 'Rainfall_Anomaly',
        temperature: 'Temperature_Anomaly',
        humidity: 'Relative_Humidity_Anomaly',
        wind: 'Wind_Speed_Anomaly'
    };

    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';
    
    // Construct the file path
    const filePath = `C:/Users/MSI/Documents/PSM/TRAINING/TRAINING/Dashboard/${location}/Anomaly Plot/${imageMappings[type]}_${location}.png`;
    
    // Update the image source
    anomalyImage.src = filePath;
    anomalyImage.alt = `${type.charAt(0).toUpperCase() + type.slice(1)} Anomaly Plot for ${location}`;

    // Log the file path for debugging
    console.log('Anomaly Plot file path:', filePath);
}

function changeLast5YearsTrend(type) {
    const last5YearsImage = document.getElementById('last-5-years-trend-image');
    const dashboardId = getDashboardId();
    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';

    const imageMappings = {
        rainfall: 'Rainfall',
        temperature: 'Temperature',
        humidity: 'Relative_Humidity',
        wind: 'Wind_Speed'
    };

    last5YearsImage.src = `${location}/${location}_${imageMappings[type]}_Bar_Graph.png`;
    last5YearsImage.alt = `Last 5 Years ${type.charAt(0).toUpperCase() + type.slice(1)} Trend`;
}

function changeScatterPlot(type) {
    const scatterPlotImage = document.getElementById('scatter-plot-image');
    const dashboardId = getDashboardId();
    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';
	

    scatterPlotImage.src = `${location}/Scatter Plot/${type}_vs_${type}_${location}.png`;
    scatterPlotImage.alt = `${type.charAt(0).toUpperCase() + type.slice(1)} vs Relative Humidity`;
}

function changeScatterPlot(type) {
    const scatterPlotImage = document.getElementById('scatter-plot-image');
    const dashboardId = getDashboardId();
    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';
    
    // Map the type to the correct file name prefix
    const typeMap = {
        'rainfall': 'Rainfall',
        'temperature': 'Temperature',
        'humidity': 'Relative Humidity',
        'wind': 'Wind Speed'
    };

    const currentType = typeMap[type];
    
    // Define all possible combinations
    const parameters = ['Rainfall', 'Temperature', 'Relative Humidity', 'Wind Speed'];
    let fileName = '';

    // Find the correct file name
    for (let param of parameters) {
        if (param !== currentType) {
            fileName = `${currentType}_vs_${param}_${location}.png`;
            break;
        }
    }

    if (fileName === '') {
        console.error('No matching scatter plot found for', type);
        return;
    }

    // Encode the file path to handle spaces
    const encodedFileName = encodeURIComponent(fileName);
    const filePath = `${location}/Scatter Plot/${encodedFileName}`;
    
    scatterPlotImage.src = filePath;
    scatterPlotImage.alt = `${fileName.replace('.png', '')} Scatter Plot`;

    console.log('Scatter Plot file path:', filePath);
}

function updateHeatmapButton(type) {
    const heatmapButton = document.querySelector('.heatmap button');
    heatmapButton.onclick = () => showHeatmapPopup(type);
}

function showHeatmapPopup(type) {
    currentHeatmapType = type;
    const popup = document.getElementById('heatmap-popup');
    popup.style.display = 'block';
    updateHeatmapTitle();
    changeHeatmapYear(currentHeatmapYear);
}

function closeHeatmapPopup() {
    const popup = document.getElementById('heatmap-popup');
    popup.style.display = 'none';
}

function updateHeatmapTitle() {
    const title = document.getElementById('heatmap-title');
    let titleText = currentHeatmapType.charAt(0).toUpperCase() + currentHeatmapType.slice(1);
    if (currentHeatmapType === 'wind') {
        titleText = 'Wind Speed';
    }
    title.textContent = `${titleText} Heatmap - ${currentHeatmapYear}`;
}

function changeHeatmapYear(year) {
    currentHeatmapYear = year;
    updateHeatmapTitle();
    const heatmapGrid = document.querySelector('.heatmap-grid');
    heatmapGrid.innerHTML = '';
    
    const months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    
    months.forEach(month => {
        const img = document.createElement('img');
        let imageName = currentHeatmapType;
        if (currentHeatmapType === 'wind') {
            imageName = 'Wind Speed';
        }
        img.src = `Heatmap/${imageName} ${currentHeatmapYear}${month}.png`;
        img.alt = `${imageName} heatmap for ${month}/${currentHeatmapYear}`;
        img.className = 'heatmap-image';
        heatmapGrid.appendChild(img);
    });
}

function setupImagePopups() {
    const images = document.querySelectorAll('.image-container img');
    images.forEach(img => {
        img.addEventListener('click', () => {
            const sectionClass = img.closest('section').className;
            if (sectionClass === 'scatter-plots') {
                const type = currentHeatmapType.charAt(0).toUpperCase() + currentHeatmapType.slice(1);
                showScatterPlotPopup(type);
            } else if (sectionClass === 'prediction-comparison') {
                const type = currentHeatmapType.charAt(0).toUpperCase() + currentHeatmapType.slice(1);
                showPredictionComparisonPopup(type);
            } else if (sectionClass === 'heatmap') {
                showHeatmapPopup(currentHeatmapType);
            } else {
                showImagePopup(img.src, img.alt);
            }
        });
    });
}

function showImagePopup(src, alt) {
    const popup = document.createElement('div');
    popup.className = 'popup';
    popup.style.display = 'block';
    popup.innerHTML = `
        <div class="popup-content">
            <span class="close" onclick="closeImagePopup(this)">&times;</span>
            <img src="${src}" alt="${alt}" style="width:100%">
        </div>
    `;
    document.body.appendChild(popup);
}

function closeImagePopup(closeButton) {
    closeButton.closest('.popup').remove();
}

function showScatterPlotPopup(type) {
    const dashboardId = getDashboardId();
    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';
    const popup = document.createElement('div');
    popup.className = 'popup';
    popup.style.display = 'block';
    
    const typeMap = {
        'rainfall': 'Rainfall',
        'temperature': 'Temperature',
        'humidity': 'Relative Humidity',
        'wind': 'Wind Speed'
    };

    const currentType = typeMap[type.toLowerCase()];
    
    const buttons = [
        'Rainfall',
        'Temperature',
        'Relative Humidity',
        'Wind Speed'
    ].filter(param => param !== currentType);

    const initialFileName = `${currentType}_vs_${buttons[0]}_${location}.png`;
    const encodedInitialFileName = encodeURIComponent(initialFileName);

    popup.innerHTML = `
        <div class="popup-content">
            <span class="close" onclick="closeImagePopup(this)">&times;</span>
            <img id="popup-scatter-image" src="${location}/Scatter Plot/${encodedInitialFileName}" alt="${currentType} Scatter Plot">
            <div class="popup-buttons">
                ${buttons.map(button => `<button onclick="changeScatterPlotImage('${currentType}', '${button}', '${location}')">${currentType} vs ${button}</button>`).join('')}
            </div>
        </div>
    `;
    document.body.appendChild(popup);
}

function changeScatterPlotImage(type1, type2, location) {
    const fileName = `${type1}_vs_${type2}_${location}.png`;
    const encodedFileName = encodeURIComponent(fileName);
    const imageSrc = `${location}/Scatter Plot/${encodedFileName}`;
    document.getElementById('popup-scatter-image').src = imageSrc;
}

//function changeScatterPlotImage(comparison, location) {
   // const [type1, _, type2] = comparison.split(' ');
   // const imageSrc = `${location}/Scatter Plot/${type1}_vs_${type2}_${location}.png`;
   // document.getElementById('popup-scatter-image').src = imageSrc;
//

function changePredictionComparison(type) {
    const predictionImage = document.getElementById('default-prediction-image');
    const dashboardId = getDashboardId();
    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';

    // Handle the "Wind Speed" case
    const typeForFileName = type === 'wind' ? 'Wind Speed' : type.charAt(0).toUpperCase() + type.slice(1);

    const filePath = `${location}/${typeForFileName}_${location}_XGBoost.png`;
    
    predictionImage.src = filePath;
    predictionImage.alt = `${typeForFileName} Prediction Comparison for ${location}`;

    console.log('Prediction Comparison file path:', filePath);
}

function showPredictionComparisonPopup(type) {
    const dashboardId = getDashboardId();
    const location = dashboardId === 'sultan-ibrahim-dashboard' ? 'Johor Bahru' : 'Melaka';
    const popup = document.createElement('div');
    popup.className = 'popup';
    popup.style.display = 'block';
    
    const models = ['XGBoost', 'Random Forest'];

    // Handle the "Wind Speed" case
    const typeForFileName = type.toLowerCase() === 'wind' ? 'Wind Speed' : type;

    popup.innerHTML = `
        <div class="popup-content">
            <span class="close" onclick="closeImagePopup(this)">&times;</span>
            <img id="popup-prediction-image" src="${location}/${typeForFileName}_${location}_XGBoost.png" alt="${typeForFileName} Prediction Comparison">
            <div class="popup-buttons">
                ${models.map(model => `<button onclick="changePredictionComparisonImage('${typeForFileName}', '${location}', '${model}')">${model}</button>`).join('')}
            </div>
        </div>
    `;
    document.body.appendChild(popup);
}

function changePredictionComparisonImage(type, location, model) {
    const imageSrc = `${location}/${type}_${location}_${model.replace(' ', '')}.png`;
    const popupImage = document.getElementById('popup-prediction-image');
    popupImage.src = imageSrc;
    popupImage.alt = `${type} Prediction Comparison for ${location} using ${model}`;

    console.log('Prediction Comparison Image Source:', imageSrc);
}

window.onclick = function(event) {
    if (event.target.className === 'popup') {
        if (event.target.querySelector('.heatmap-popup-content')) {
            closeHeatmapPopup();
        } else {
            event.target.remove();
        }
    }
}