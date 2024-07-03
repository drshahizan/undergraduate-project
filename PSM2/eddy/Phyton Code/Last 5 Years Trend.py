import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
import os

# Function to process data
def process_data(temperature_data, wind_data, humidity_data, rainfall_data, month_mapping):
    # Convert the data from wide format to long format for easier plotting and analysis
    temperature_long = pd.melt(temperature_data, id_vars=['Year'], var_name='Month', value_name='Temperature')
    wind_long = pd.melt(wind_data, id_vars=['Year'], var_name='Month', value_name='Wind Speed')
    humidity_long = pd.melt(humidity_data, id_vars=['Year'], var_name='Month', value_name='Relative Humidity')
    rainfall_long = pd.melt(rainfall_data, id_vars=['Year'], var_name='Month', value_name='Rainfall')

    # Replace the abbreviated month names with full month names using map
    temperature_long['Month'] = temperature_long['Month'].map(month_mapping)
    wind_long['Month'] = wind_long['Month'].map(month_mapping)
    humidity_long['Month'] = humidity_long['Month'].map(month_mapping)
    rainfall_long['Month'] = rainfall_long['Month'].map(month_mapping)

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

    # Filter out the year 2024 and keep the last 5 years
    last_five_years = temperature_long['Year'].unique()[-6:-1] # Adjust based on available years
    temperature_long = temperature_long[(temperature_long['Year'] != 2024) & (temperature_long['Year'].isin(last_five_years))]
    wind_long = wind_long[(wind_long['Year'] != 2024) & (wind_long['Year'].isin(last_five_years))]
    humidity_long = humidity_long[(humidity_long['Year'] != 2024) & (humidity_long['Year'].isin(last_five_years))]
    rainfall_long = rainfall_long[(rainfall_long['Year'] != 2024) & (rainfall_long['Year'].isin(last_five_years))]

    return temperature_long, wind_long, humidity_long, rainfall_long, month_order

# Function to plot data and save to file
def plot_data(site_name, temperature_long, wind_long, humidity_long, rainfall_long, month_order, save_path):
    # Ensure the save path exists
    if not os.path.exists(save_path):
        os.makedirs(save_path)

    # Plot Temperature
    plt.figure(figsize=(10, 6))
    sns.barplot(data=temperature_long, x='Month', y='Temperature', hue='Year')
    plt.xlabel('Month')
    plt.ylabel('Temperature (°C)')
    plt.title(f'Temperature (°C) Bar Graph - {site_name}')
    plt.xticks(rotation=45)
    plt.legend(title='Year')
    plt.savefig(os.path.join(save_path, f'{site_name}_Temperature_Bar_Graph.png'))
    plt.close()

    # Plot Wind Speed
    plt.figure(figsize=(10, 6))
    sns.barplot(data=wind_long, x='Month', y='Wind Speed', hue='Year')
    plt.xlabel('Month')
    plt.ylabel('Wind Speed (km/h)')
    plt.title(f'Wind Speed (km/h) Bar Graph - {site_name}')
    plt.xticks(rotation=45)
    plt.legend(title='Year')
    plt.savefig(os.path.join(save_path, f'{site_name}_Wind_Speed_Bar_Graph.png'))
    plt.close()

    # Plot Relative Humidity
    plt.figure(figsize=(10, 6))
    sns.barplot(data=humidity_long, x='Month', y='Relative Humidity', hue='Year')
    plt.xlabel('Month')
    plt.ylabel('Relative Humidity (%)')
    plt.title(f'Relative Humidity (%) Bar Graph - {site_name}')
    plt.xticks(rotation=45)
    plt.legend(title='Year')
    plt.savefig(os.path.join(save_path, f'{site_name}_Relative_Humidity_Bar_Graph.png'))
    plt.close()

    # Plot Rainfall
    plt.figure(figsize=(10, 6))
    sns.barplot(data=rainfall_long, x='Month', y='Rainfall', hue='Year')
    plt.xlabel('Month')
    plt.ylabel('Rainfall (mm)')
    plt.title(f'Rainfall (mm) Bar Graph - {site_name}')
    plt.xticks(rotation=45)
    plt.legend(title='Year')
    plt.savefig(os.path.join(save_path, f'{site_name}_Rainfall_Bar_Graph.png'))
    plt.close()

# Read Melaka data
temperature_data_melaka = pd.read_csv("temperature_data_melaka.csv")
wind_data_melaka = pd.read_csv("wind_data_melaka.csv")
humidity_data_melaka = pd.read_csv("humidity_data_melaka.csv")
rainfall_data_melaka = pd.read_csv("rainfall_data_melaka.csv")

# Mapping of abbreviated month names to full month names
month_mapping = {
    'Jan': 'January', 'Feb': 'February', 'Mar': 'March', 'Apr': 'April',
    'May': 'May', 'Jun': 'June', 'Jul': 'July', 'Aug': 'August', 'Sep': 'September', 'Oct': 'October', 'Nov': 'November', 'Dec': 'December'
}

# Process Melaka data
temperature_long_melaka, wind_long_melaka, humidity_long_melaka, rainfall_long_melaka, month_order_melaka = process_data(
    temperature_data_melaka, wind_data_melaka, humidity_data_melaka, rainfall_data_melaka, month_mapping
)

# Define the save path for Melaka
save_path_melaka = r'C:\Users\MSI\Documents\PSM\TRAINING\TRAINING\Dashboard\Melaka'

# Plot and save Melaka data
plot_data('Melaka', temperature_long_melaka, wind_long_melaka, humidity_long_melaka, rainfall_long_melaka, month_order_melaka, save_path_melaka)

# Read Johor Bahru data
temperature_data_jb = pd.read_csv("temperature_data_jb.csv")
wind_data_jb = pd.read_csv("wind_data_jb.csv")
humidity_data_jb = pd.read_csv("humidity_data_jb.csv")
rainfall_data_jb = pd.read_csv("rainfall_data_jb.csv")

# Process Johor Bahru data
temperature_long_jb, wind_long_jb, humidity_long_jb, rainfall_long_jb, month_order_jb = process_data(
    temperature_data_jb, wind_data_jb, humidity_data_jb, rainfall_data_jb, month_mapping
)

# Define the save path for Johor Bahru
save_path_jb = r'C:\Users\MSI\Documents\PSM\TRAINING\TRAINING\Dashboard\Johor Bahru'

# Plot and save Johor Bahru data
plot_data('Johor Bahru', temperature_long_jb, wind_long_jb, humidity_long_jb, rainfall_long_jb, month_order_jb, save_path_jb)

