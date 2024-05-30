import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor
from xgboost import XGBRegressor
from sklearn.metrics import mean_squared_error, r2_score, mean_absolute_error

# Read the dataset with column names specified
data = pd.read_csv("rainfall_data.csv")

# Separate data into features and target based on year
# Assuming the dataset has columns: 'Year', 'Rainfall_Jan', 'Rainfall_Feb', ..., 'Temperature', 'WindSpeed', 'Humidity'
# Select all columns except 'Year' for features (X) and the first 12 columns for monthly rainfall target (y)
X = data[data['Year'] != 2024].iloc[:, 1:]  # Features for all years except 2024
y = data[data['Year'] != 2024].iloc[:, 1:13]  # Target (monthly rainfall) for all years except 2024

# Initialize dictionaries to store models, predictions, and accuracy scores for each month
models = {}
predictions_2024 = {}
accuracies = {}

# Train models for each month using the data from all years except 2024
for month in range(12):
    y_train_month = y.iloc[:, month]

    # Split the data into training and testing sets
    X_train, X_test, y_train, y_test = train_test_split(X, y_train_month, test_size=0.2, random_state=42)

    # Train Random Forest model
    rf_model = RandomForestRegressor(random_state=42)
    rf_model.fit(X_train, y_train)
    models[f"RF_{month+1}"] = rf_model

    # Train XGBoost model
    xgb_model = XGBRegressor(random_state=42)
    xgb_model.fit(X_train, y_train)
    models[f"XGB_{month+1}"] = xgb_model

    # Make predictions on the test set
    rf_predictions = rf_model.predict(X_test)
    xgb_predictions = xgb_model.predict(X_test)

    # Calculate RMSE, MAE, and R² for each model
    rf_rmse = mean_squared_error(y_test, rf_predictions, squared=False)
    xgb_rmse = mean_squared_error(y_test, xgb_predictions, squared=False)
    rf_mae = mean_absolute_error(y_test, rf_predictions)
    xgb_mae = mean_absolute_error(y_test, xgb_predictions)
    rf_r2 = r2_score(y_test, rf_predictions)
    xgb_r2 = r2_score(y_test, xgb_predictions)

    # Store accuracies
    accuracies[f"RF_{month+1}"] = {'RMSE': rf_rmse, 'MAE': rf_mae, 'R²': rf_r2}
    accuracies[f"XGB_{month+1}"] = {'RMSE': xgb_rmse, 'MAE': xgb_mae, 'R²': xgb_r2}

    # Print accuracy metrics
    print(f"Month {month+1} - Random Forest RMSE: {rf_rmse}, MAE: {rf_mae}, R²: {rf_r2}")
    print(f"Month {month+1} - XGBoost RMSE: {xgb_rmse}, MAE: {xgb_mae}, R²: {xgb_r2}")


