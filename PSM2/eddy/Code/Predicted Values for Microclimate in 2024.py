# -*- coding: utf-8 -*-
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from sklearn.ensemble import RandomForestRegressor
from xgboost import XGBRegressor

# Read the datasets with column names specified
rainfall_data = pd.read_csv("rainfall_data.csv")
temperature_data = pd.read_csv("temperature_data.csv")
humidity_data = pd.read_csv("humidity_data.csv")
wind_data = pd.read_csv("wind_data.csv")

# Function to train models and make predictions for a given dataset
def train_and_predict(data, data_type):
    # Separate data into features and target based on year
    X = data[data['Year'] != 2024].iloc[:, 1:]  # Features for all years except 2024
    y = data[data['Year'] != 2024].iloc[:, 1:]  # Target for all years except 2024

    # Initialize dictionaries to store models and predictions for each month
    models = {}
    predictions_2024 = {}

    # Train models for each month using the data from all years except 2024
    for month in range(12):
        y_train_month = y.iloc[:, month]

        # Train Random Forest model
        rf_model = RandomForestRegressor(random_state=42)
        rf_model.fit(X, y_train_month)
        models[f"RF_{month+1}"] = rf_model

        # Train XGBoost model
        xgb_model = XGBRegressor(random_state=42)
        xgb_model.fit(X, y_train_month)
        models[f"XGB_{month+1}"] = xgb_model

    # Prepare the features for 2024 (assuming there are no data points for 2024)
    X_2024 = np.zeros((1, X.shape[1]))

    # Make predictions for 2024
    for month in range(12):
        rf_predictions = models[f"RF_{month+1}"].predict(X_2024)
        xgb_predictions = models[f"XGB_{month+1}"].predict(X_2024)
        predictions_2024[f"RF_{month+1}"] = rf_predictions
        predictions_2024[f"XGB_{month+1}"] = xgb_predictions

        # Print predicted values for the month
        print(f"{data_type} - Month {month+1}: Random Forest Prediction - {rf_predictions[0]}, XGBoost Prediction - {xgb_predictions[0]}")

    # Visualize predictions for 2024 using a bar plot
    fig, ax = plt.subplots(figsize=(10, 6))
    months = [f"Month {i+1}" for i in range(12)]
    rf_predictions = [predictions_2024[f"RF_{i+1}"][0] for i in range(12)]
    xgb_predictions = [predictions_2024[f"XGB_{i+1}"][0] for i in range(12)]

    bar_width = 0.35
    index = np.arange(12)
    ax.bar(index, rf_predictions, bar_width, label='Random Forest')
    ax.bar(index + bar_width, xgb_predictions, bar_width, label='XGBoost')
    ax.set_xlabel('Month')
    ax.set_ylabel('Predicted Values')
    ax.set_title(f'Predicted Values for {data_type} in 2024')
    ax.set_xticks(index + bar_width / 2)
    ax.set_xticklabels(months)
    ax.legend()
    plt.show()

# Call the function for each type of data
train_and_predict(rainfall_data, "Rainfall")
train_and_predict(temperature_data, "Temperature")
train_and_predict(humidity_data, "Relative Humidity")
train_and_predict(wind_data, "Wind Speed")