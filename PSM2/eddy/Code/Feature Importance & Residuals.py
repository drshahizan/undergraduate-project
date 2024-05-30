import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor
from xgboost import XGBRegressor
from sklearn.metrics import mean_squared_error

# Read the dataset with column names specified
data = pd.read_csv("rainfall_data.csv")

# Remove decimal points from the data and treat values as integers
data = data.astype(int)

# Set the features as the monthly rainfall columns
X = data.iloc[:, 1:].values  # All columns except the 'year' column

# Set the target variable as the annual total rainfall
y = data.iloc[:, 1:].values.sum(axis=1)  # Sum of monthly rainfall values for each year

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Train Random Forest model
rf_model = RandomForestRegressor(random_state=42)
rf_model.fit(X_train, y_train)

# Make predictions using Random Forest model
rf_predictions = rf_model.predict(X_test)

# Evaluate Random Forest model
rf_rmse = mean_squared_error(y_test, rf_predictions, squared=False)
print("Random Forest RMSE:", rf_rmse)

# Train XGBoost model
xgb_model = XGBRegressor(random_state=42)
xgb_model.fit(X_train, y_train)

# Make predictions using XGBoost model
xgb_predictions = xgb_model.predict(X_test)

# Evaluate XGBoost model
xgb_rmse = mean_squared_error(y_test, xgb_predictions, squared=False)
print("XGBoost RMSE:", xgb_rmse)

# Scatter plot of actual vs predicted values
plt.figure(figsize=(10, 6))
plt.scatter(y_test, rf_predictions, alpha=0.5, label='Random Forest')
plt.scatter(y_test, xgb_predictions, alpha=0.5, label='XGBoost')
plt.xlabel('Actual Values')
plt.ylabel('Predicted Values')
plt.title('Actual vs Predicted Values')
plt.legend()
plt.show()

# Residual plots
plt.figure(figsize=(10, 6))
plt.subplot(1, 2, 1)
plt.scatter(rf_predictions, rf_predictions - y_test, alpha=0.5)
plt.axhline(y=0, color='r', linestyle='--')
plt.xlabel('Predicted Values')
plt.ylabel('Residuals')
plt.title('Random Forest Model Residuals')

plt.subplot(1, 2, 2)
plt.scatter(xgb_predictions, xgb_predictions - y_test, alpha=0.5)
plt.axhline(y=0, color='r', linestyle='--')
plt.xlabel('Predicted Values')
plt.ylabel('Residuals')
plt.title('XGBoost Model Residuals')
plt.tight_layout()
plt.show()

# Feature importance plots
plt.figure(figsize=(10, 6))
plt.subplot(1, 2, 1)
importances = rf_model.feature_importances_
indices = np.argsort(importances)[::-1]
plt.bar(range(X_train.shape[1]), importances[indices], align='center')
plt.xticks(range(X_train.shape[1]), np.array(data.columns[1:])[indices], rotation=90)
plt.xlabel('Features')
plt.ylabel('Importance')
plt.title('Random Forest Feature Importance')

plt.subplot(1, 2, 2)
importances = xgb_model.feature_importances_
indices = np.argsort(importances)[::-1]
plt.bar(range(X_train.shape[1]), importances[indices], align='center')
plt.xticks(range(X_train.shape[1]), np.array(data.columns[1:])[indices], rotation=90)
plt.xlabel('Features')
plt.ylabel('Importance')
plt.title('XGBoost Feature Importance')
plt.tight_layout()
plt.show()