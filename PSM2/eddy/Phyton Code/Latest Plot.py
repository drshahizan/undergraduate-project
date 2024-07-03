import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
import os

# Function to process data and create plots
def process_and_plot(location, temp_data, wind_data, humidity_data, rainfall_data, save_dir):
    # Mapping of abbreviated month names to full month names
    month_mapping = {
        'Jan': 'January', 'Feb': 'February', 'Mar': 'March', 'Apr': 'April',
        'May': 'May', 'Jun': 'June', 'Jul': 'July', 'Aug': 'August',
        'Sep': 'September', 'Oct': 'October', 'Nov': 'November', 'Dec': 'December'
    }

    # Convert the data from wide format to long format for easier plotting and analysis
    temperature_long = pd.melt(temp_data, id_vars=['Year'], var_name='Month', value_name='Temperature')
    wind_long = pd.melt(wind_data, id_vars=['Year'], var_name='Month', value_name='Wind Speed')
    humidity_long = pd.melt(humidity_data, id_vars=['Year'], var_name='Month', value_name='Relative Humidity')
    rainfall_long = pd.melt(rainfall_data, id_vars=['Year'], var_name='Month', value_name='Rainfall')

    # Inspect unique month values before mapping
    print("Unique months in temperature data:", temperature_long['Month'].unique())
    print("Unique months in wind data:", wind_long['Month'].unique())
    print("Unique months in humidity data:", humidity_long['Month'].unique())
    print("Unique months in rainfall data:", rainfall_long['Month'].unique())

    # Replace the abbreviated month names with full month names using map
    temperature_long['Month'] = temperature_long['Month'].map(month_mapping)
    wind_long['Month'] = wind_long['Month'].map(month_mapping)
    humidity_long['Month'] = humidity_long['Month'].map(month_mapping)
    rainfall_long['Month'] = rainfall_long['Month'].map(month_mapping)

    # Check if any NaN values remain after mapping
    print("NaN values in temperature data after mapping:", temperature_long['Month'].isna().sum())
    print("NaN values in wind data after mapping:", wind_long['Month'].isna().sum())
    print("NaN values in humidity data after mapping:", humidity_long['Month'].isna().sum())
    print("NaN values in rainfall data after mapping:", rainfall_long['Month'].isna().sum())

    # Define the order for the months
    month_order = ['January', 'February', 'March', 'April', 'May', 'June', 
                   'July', 'August', 'September', 'October', 'November', 'December']

    # Convert the 'Month' column to a categorical type with the specified order
    temperature_long['Month'] = pd.Categorical(temperature_long['Month'], categories=month_order, ordered=True)
    wind_long['Month'] = pd.Categorical(wind_long['Month'], categories=month_order, ordered=True)
    humidity_long['Month'] = pd.Categorical(humidity_long['Month'], categories=month_order, ordered=True)
    rainfall_long['Month'] = pd.Categorical(rainfall_long['Month'], categories=month_order, ordered=True)

    # Convert 'Month' from categorical to numeric
    month_to_num = {month: i+1 for i, month in enumerate(month_order)}
    temperature_long['Month_Num'] = temperature_long['Month'].apply(lambda x: month_to_num[x])
    wind_long['Month_Num'] = wind_long['Month'].apply(lambda x: month_to_num[x])
    humidity_long['Month_Num'] = humidity_long['Month'].apply(lambda x: month_to_num[x])
    rainfall_long['Month_Num'] = rainfall_long['Month'].apply(lambda x: month_to_num[x])

    # Filter out the year 2024
    temperature_long = temperature_long[temperature_long['Year'] != 2024]
    wind_long = wind_long[wind_long['Year'] != 2024]
    humidity_long = humidity_long[humidity_long['Year'] != 2024]
    rainfall_long = rainfall_long[rainfall_long['Year'] != 2024]

    # Merge the long format dataframes on Year and Month
    merged_data = pd.merge(temperature_long, wind_long, on=['Year', 'Month'])
    merged_data = pd.merge(merged_data, humidity_long, on=['Year', 'Month'])
    merged_data = pd.merge(merged_data, rainfall_long, on=['Year', 'Month'])

    # Create scatter plots
    scatter_plot_dir = os.path.join(save_dir, 'Scatter Plot')
    os.makedirs(scatter_plot_dir, exist_ok=True)

    scatter_plots = [
        ('Temperature', 'Relative Humidity'),
        ('Temperature', 'Rainfall'),
        ('Temperature', 'Wind Speed'),
        ('Rainfall', 'Relative Humidity'),
        ('Rainfall', 'Temperature'),
        ('Rainfall', 'Wind Speed'),
        ('Wind Speed', 'Relative Humidity'),
        ('Wind Speed', 'Temperature'),
        ('Wind Speed', 'Rainfall'),
        ('Relative Humidity', 'Wind Speed'),
        ('Relative Humidity', 'Temperature'),
        ('Relative Humidity', 'Rainfall')
    ]

    units = {
        'Temperature': '°C',
        'Relative Humidity': '%',
        'Wind Speed': 'km/h',
        'Rainfall': 'mm'
    }

    for x, y in scatter_plots:
        plt.figure(figsize=(10, 6))
        plt.scatter(merged_data[x], merged_data[y])
        plt.xlabel(f'{x} ({units[x]})')
        plt.ylabel(f'{y} ({units[y]})')
        plt.title(f'{x} vs {y} - {location}')
        plt.savefig(os.path.join(scatter_plot_dir, f'{x}_vs_{y}_{location}.png'))
        plt.close()

    # Correlation matrix
    corr_matrix = merged_data.corr()
    plt.figure(figsize=(10, 8))
    sns.heatmap(corr_matrix, annot=True, cmap='coolwarm')
    plt.title('Correlation Matrix')
    plt.show()

    # Anomaly plots for temperature
    anomaly_plot_dir = os.path.join(save_dir, 'Anomaly Plot')
    os.makedirs(anomaly_plot_dir, exist_ok=True)
    
    plt.figure(figsize=(10, 6))
    for year in temp_data['Year'].unique():
        if year != 2024:
            yearly_data = temperature_long[temperature_long['Year'] == year]
            plt.plot(yearly_data['Month_Num'], yearly_data['Temperature'], alpha=0.3)
    plt.xlabel('Month')
    plt.ylabel('Temperature (°C)')
    plt.title('Temperature (°C) Anomaly Plot')
    plt.xticks(ticks=range(1, 13), labels=month_order, rotation=45)
    plt.savefig(os.path.join(anomaly_plot_dir, f'Temperature_Anomaly_{location}.png'))
    plt.close()

    # Trend plots for wind speed
    trend_plot_dir = os.path.join(save_dir, 'Trend Plot')
    os.makedirs(trend_plot_dir, exist_ok=True)
    
    plt.figure(figsize=(10, 6))
    for year in wind_data['Year'].unique():
        if year != 2024:
            yearly_data = wind_long[wind_long['Year'] == year]
            plt.plot(yearly_data['Month_Num'], yearly_data['Wind Speed'], alpha=0.3)
    plt.xlabel('Month')
    plt.ylabel('Wind Speed (km/h)')
    plt.title('Wind Speed (km/h) Anomaly Plot')
    plt.xticks(ticks=range(1, 13), labels=month_order, rotation=45)
    plt.savefig(os.path.join(anomaly_plot_dir, f'Wind_Speed_Anomaly_{location}.png'))
    plt.close()

    # Anomaly plots for relative humidity
    plt.figure(figsize=(10, 6))
    for year in humidity_data['Year'].unique():
        if year != 2024:
            yearly_data = humidity_long[humidity_long['Year'] == year]
            plt.plot(yearly_data['Month_Num'], yearly_data['Relative Humidity'], alpha=0.3)
    plt.xlabel('Month')
    plt.ylabel('Relative Humidity (%)')
    plt.title('Relative Humidity (%) Anomaly Plot')
    plt.xticks(ticks=range(1, 13), labels=month_order, rotation=45)
    plt.savefig(os.path.join(anomaly_plot_dir, f'Relative_Humidity_Anomaly_{location}.png'))
    plt.close()

    # Anomaly plots for rainfall
    plt.figure(figsize=(10, 6))
    for year in rainfall_data['Year'].unique():
        if year != 2024:
            yearly_data = rainfall_long[rainfall_long['Year'] == year]
            plt.plot(yearly_data['Month_Num'], yearly_data['Rainfall'], alpha=0.3)
    plt.xlabel('Month')
    plt.ylabel('Rainfall (mm)')
    plt.title('Rainfall (mm) Anomaly Plot')
    plt.xticks(ticks=range(1, 13), labels=month_order, rotation=45)
    plt.savefig(os.path.join(anomaly_plot_dir, f'Rainfall_Anomaly_{location}.png'))
    plt.close()

    # Overall trend lines
    # Temperature trend line
    avg_temp = temperature_long.groupby('Month_Num')['Temperature'].mean()
    plt.figure(figsize=(10, 6))
    plt.plot(avg_temp.index, avg_temp.values, marker='o')
    plt.xlabel('Month')
    plt.ylabel('Average Temperature (°C)')
    plt.title('Average Monthly Temperature (°C) Trend')
    plt.xticks(ticks=range(1, 13), labels=month_order, rotation=45)
    plt.savefig(os.path.join(trend_plot_dir, f'Temperature_Trend_{location}.png'))
    plt.close()

    # Wind speed trend line
    avg_wind = wind_long.groupby('Month_Num')['Wind Speed'].mean()
    plt.figure(figsize=(10, 6))
    plt.plot(avg_wind.index, avg_wind.values, marker='o')
    plt.xlabel('Month')
    plt.ylabel('Average Wind Speed (km/h)')
    plt.title('Average Monthly Wind Speed (km/h) Trend')
    plt.xticks(ticks=range(1, 13), labels=month_order, rotation=45)
    plt.savefig(os.path.join(trend_plot_dir, f'Wind_Speed_Trend_{location}.png'))
    plt.close()

    # Relative humidity trend line
    avg_humidity = humidity_long.groupby('Month_Num')['Relative Humidity'].mean()
    plt.figure(figsize=(10, 6))
    plt.plot(avg_humidity.index, avg_humidity.values, marker='o')
    plt.xlabel('Month')
    plt.ylabel('Average Relative Humidity (%)')
    plt.title('Average Monthly Relative Humidity (%) Trend')
    plt.xticks(ticks=range(1, 13), labels=month_order, rotation=45)
    plt.savefig(os.path.join(trend_plot_dir, f'Relative_Humidity_Trend_{location}.png'))
    plt.close()

    # Rainfall trend line
    avg_rainfall = rainfall_long.groupby('Month_Num')['Rainfall'].mean()
    plt.figure(figsize=(10, 6))
    plt.plot(avg_rainfall.index, avg_rainfall.values, marker='o')
    plt.xlabel('Month')
    plt.ylabel('Average Rainfall (mm)')
    plt.title('Average Monthly Rainfall (mm) Trend')
    plt.xticks(ticks=range(1, 13), labels=month_order, rotation=45)
    plt.savefig(os.path.join(trend_plot_dir, f'Rainfall_Trend_{location}.png'))
    plt.close()

# Process Johor Bahru data
jb_temp = pd.read_csv("temperature_data_jb.csv")
jb_wind = pd.read_csv("wind_data_jb.csv")
jb_humidity = pd.read_csv("humidity_data_jb.csv")
jb_rainfall = pd.read_csv("rainfall_data_jb.csv")
jb_save_dir = r"C:\Users\MSI\Documents\PSM\TRAINING\TRAINING\Dashboard\Johor Bahru"
os.makedirs(jb_save_dir, exist_ok=True)
process_and_plot("Johor Bahru", jb_temp, jb_wind, jb_humidity, jb_rainfall, jb_save_dir)

# Process Melaka data
melaka_temp = pd.read_csv("temperature_data_melaka.csv")
melaka_wind = pd.read_csv("wind_data_melaka.csv")
melaka_humidity = pd.read_csv("humidity_data_melaka.csv")
melaka_rainfall = pd.read_csv("rainfall_data_melaka.csv")
melaka_save_dir = r"C:\Users\MSI\Documents\PSM\TRAINING\TRAINING\Dashboard\Melaka"
os.makedirs(melaka_save_dir, exist_ok=True)
process_and_plot("Melaka", melaka_temp, melaka_wind, melaka_humidity, melaka_rainfall, melaka_save_dir)

# Saving the merged dataset to a CSV file for further analysis
merged_data.to_csv('merged_climate_data.csv', index=False)

# Print the first few rows of the humidity_long DataFrame
print("Humidity Data Long Format:")
print(humidity_long.head())

# Print the first few rows of the rainfall_long DataFrame
print("Rainfall Data Long Format:")
print(rainfall_long.head())

# Print the average humidity and rainfall grouped by Month_Num
print("Average Monthly Humidity:")
print(humidity_long.groupby('Month_Num')['Relative Humidity'].mean())

print("Average Monthly Rainfall:")
print(rainfall_long.groupby('Month_Num')['Rainfall'].mean())
