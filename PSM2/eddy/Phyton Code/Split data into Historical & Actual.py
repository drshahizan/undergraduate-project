import pandas as pd

# Function to process and save data for a given location
def process_and_save_data(temperature_file, humidity_file, rainfall_file, wind_speed_file, historical_output_file, actual_output_file):
    # Load the data
    temperature_data = pd.read_csv(temperature_file)
    humidity_data = pd.read_csv(humidity_file)
    rainfall_data = pd.read_csv(rainfall_file)
    wind_speed_data = pd.read_csv(wind_speed_file)
    
    # Melt the dataframes to convert them to long format
    temperature_melted = temperature_data.melt(id_vars=['Year'], var_name='Month', value_name='Temperature')
    humidity_melted = humidity_data.melt(id_vars=['Year'], var_name='Month', value_name='Humidity')
    rainfall_melted = rainfall_data.melt(id_vars=['Year'], var_name='Month', value_name='Rainfall')
    wind_speed_melted = wind_speed_data.melt(id_vars=['Year'], var_name='Month', value_name='Wind Speed')
    
    # Month to numeric mapping
    month_mapping = {
        'January': 1, 'February': 2, 'March': 3, 'April': 4, 
        'May': 5, 'June': 6, 'July': 7, 'August': 8, 
        'September': 9, 'October': 10, 'November': 11, 'December': 12
    }
    
    # Apply month mapping
    temperature_melted['Month_Num'] = temperature_melted['Month'].map(month_mapping)
    humidity_melted['Month_Num'] = humidity_melted['Month'].map(month_mapping)
    rainfall_melted['Month_Num'] = rainfall_melted['Month'].map(month_mapping)
    wind_speed_melted['Month_Num'] = wind_speed_melted['Month'].map(month_mapping)
    
    # Merge all the dataframes on Year and Month_Num
    merged_data = pd.merge(temperature_melted, humidity_melted, on=['Year', 'Month', 'Month_Num'])
    merged_data = pd.merge(merged_data, rainfall_melted, on=['Year', 'Month', 'Month_Num'])
    merged_data = pd.merge(merged_data, wind_speed_melted, on=['Year', 'Month', 'Month_Num'])
    
    # Drop the 'Month_Num' column as it is no longer needed
    merged_data = merged_data.drop(columns=['Month_Num'])
    
    # Create historical data excluding 2023 and 2024
    historical_data = merged_data[(merged_data['Year'] < 2023)]
    
    # Create actual data for 2023
    actual_data_2023 = merged_data[(merged_data['Year'] == 2023)]
    
    # Save to CSV files
    historical_data.to_csv(historical_output_file, index=False)
    actual_data_2023.to_csv(actual_output_file, index=False)

# Process data for JB
process_and_save_data(
    'temperature_data_jb.csv',
    'humidity_data_jb.csv',
    'rainfall_data_jb.csv',
    'wind_data_jb.csv',
    'historical_data_jb_2022.csv',
    'actual_data_jb_2023.csv'
)

# Process data for Melaka
process_and_save_data(
    'temperature_data_melaka.csv',
    'humidity_data_melaka.csv',
    'rainfall_data_melaka.csv',
    'wind_data_melaka.csv',
    'historical_data_melaka_2022.csv',
    'actual_data_melaka_2023.csv'
)
