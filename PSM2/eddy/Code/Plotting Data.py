import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns

# Read the datasets
temperature_data = pd.read_csv("temperature_data.csv")
wind_data = pd.read_csv("wind_data.csv")
humidity_data = pd.read_csv("humidity_data.csv")
rainfall_data = pd.read_csv("rainfall_data.csv")

# Convert the data from wide format to long format for easier plotting and analysis
temperature_long = pd.melt(temperature_data, id_vars=['Year'], var_name='Month', value_name='Temperature')
wind_long = pd.melt(wind_data, id_vars=['Year'], var_name='Month', value_name='Wind Speed')
humidity_long = pd.melt(humidity_data, id_vars=['Year'], var_name='Month', value_name='Relative Humidity')
rainfall_long = pd.melt(rainfall_data, id_vars=['Year'], var_name='Month', value_name='Rainfall')

# Define the order for the months
month_order = ['January', 'February', 'March', 'April', 'May', 'June', 
               'July', 'August', 'September', 'October', 'November', 'December']

# Convert the 'Month' column to a categorical type with the specified order
temperature_long['Month'] = pd.Categorical(temperature_long['Month'], categories=month_order, ordered=True)
wind_long['Month'] = pd.Categorical(wind_long['Month'], categories=month_order, ordered=True)
humidity_long['Month'] = pd.Categorical(humidity_long['Month'], categories=month_order, ordered=True)
rainfall_long['Month'] = pd.Categorical(rainfall_long['Month'], categories=month_order, ordered=True)

# Merge the long format dataframes on Year and Month
merged_data = pd.merge(temperature_long, wind_long, on=['Year', 'Month'])
merged_data = pd.merge(merged_data, humidity_long, on=['Year', 'Month'])
merged_data = pd.merge(merged_data, rainfall_long, on=['Year', 'Month'])

# Scatter plot of temperature vs. relative humidity
plt.figure(figsize=(10, 6))
plt.scatter(merged_data['Temperature'], merged_data['Relative Humidity'])
plt.xlabel('Temperature')
plt.ylabel('Relative Humidity')
plt.title('Temperature vs. Relative Humidity')
plt.show()

# Scatter plot of rainfall vs. relative humidity
plt.figure(figsize=(10, 6))
plt.scatter(merged_data['Rainfall'], merged_data['Relative Humidity'])
plt.xlabel('Rainfall')
plt.ylabel('Relative Humidity')
plt.title('Rainfall vs. Relative Humidity')
plt.show()

# Scatter plot of rainfall vs. temperature
plt.figure(figsize=(10, 6))
plt.scatter(merged_data['Rainfall'], merged_data['Temperature'])
plt.xlabel('Rainfall')
plt.ylabel('Temperature')
plt.title('Rainfall vs. Temperature')
plt.show()

# Correlation matrix
corr_matrix = merged_data.corr()
plt.figure(figsize=(10, 8))
sns.heatmap(corr_matrix, annot=True, cmap='coolwarm')
plt.title('Correlation Matrix')
plt.show()

# Anomaly plots for temperature
plt.figure(figsize=(10, 6))
for year in temperature_data['Year'].unique():
    yearly_data = temperature_long[temperature_long['Year'] == year]
    plt.plot(yearly_data['Month'], yearly_data['Temperature'], alpha=0.3)
plt.xlabel('Month')
plt.ylabel('Temperature')
plt.title('Temperature Anomaly Plot')
plt.show()

# Trend plots for wind speed
plt.figure(figsize=(10, 6))
for year in wind_data['Year'].unique():
    yearly_data = wind_long[wind_long['Year'] == year]
    plt.plot(yearly_data['Month'], yearly_data['Wind Speed'], alpha=0.3)
plt.xlabel('Month')
plt.ylabel('Wind Speed')
plt.title('Wind Speed Trend Plot')
plt.show()

# Anomaly plots for relative humidity
plt.figure(figsize=(10, 6))
for year in humidity_data['Year'].unique():
    yearly_data = humidity_long[humidity_long['Year'] == year]
    plt.plot(yearly_data['Month'], yearly_data['Relative Humidity'], alpha=0.3)
plt.xlabel('Month')
plt.ylabel('Relative Humidity')
plt.title('Relative Humidity Anomaly Plot')
plt.show()

# Anomaly plots for rainfall
plt.figure(figsize=(10, 6))
for year in rainfall_data['Year'].unique():
    yearly_data = rainfall_long[rainfall_long['Year'] == year]
    plt.plot(yearly_data['Month'], yearly_data['Rainfall'], alpha=0.3)
plt.xlabel('Month')
plt.ylabel('Rainfall')
plt.title('Rainfall Anomaly Plot')
plt.show()

# Overall trend lines
# Temperature trend line
avg_temp = temperature_long.groupby('Month')['Temperature'].mean()
plt.figure(figsize=(10, 6))
plt.plot(avg_temp.index, avg_temp.values, marker='o')
plt.xlabel('Month')
plt.ylabel('Average Temperature')
plt.title('Average Monthly Temperature Trend')
plt.xticks(rotation=45)
plt.show()

# Wind speed trend line
avg_wind = wind_long.groupby('Month')['Wind Speed'].mean()
plt.figure(figsize=(10, 6))
plt.plot(avg_wind.index, avg_wind.values, marker='o')
plt.xlabel('Month')
plt.ylabel('Average Wind Speed')
plt.title('Average Monthly Wind Speed Trend')
plt.xticks(rotation=45)
plt.show()

# Relative humidity trend line
avg_humidity = humidity_long.groupby('Month')['Relative Humidity'].mean()
plt.figure(figsize=(10, 6))
plt.plot(avg_humidity.index, avg_humidity.values, marker='o')
plt.xlabel('Month')
plt.ylabel('Average Relative Humidity')
plt.title('Average Monthly Relative Humidity Trend')
plt.xticks(rotation=45)
plt.show()

# Rainfall trend line
avg_rainfall = rainfall_long.groupby('Month')['Rainfall'].mean()
plt.figure(figsize=(10, 6))
plt.plot(avg_rainfall.index, avg_rainfall.values, marker='o')
plt.xlabel('Month')
plt.ylabel('Average Rainfall')
plt.title('Average Monthly Rainfall Trend')
plt.xticks(rotation=45)
plt.show()

# Saving the merged dataset to a CSV file for further analysis
merged_data.to_csv('merged_climate_data.csv', index=False)