# -*- coding: utf-8 -*-

import numpy as np
import netCDF4 as nc
from netCDF4 import num2date
import os
from calendar import monthrange

# Get the current folder path
current_path = os.getcwd()
print(current_path)

# Define the raw data directory
data_raw = '../Data-RAW-WIND/'

# Define the months for which data files will be processed
files_month = ['Jan', 'Feb', 'Mac', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

# Loop through each month
for month in files_month:
    filename = f'Monthly-Wind-{month}-1940-2024.nc'
    dataset = nc.Dataset(data_raw + filename)
    
    # Extract variables
    variables = dataset.variables
    data = {key: np.squeeze(variables[key][:]) for key in variables.keys()}
    
    lat = data['latitude']
    lon = data['longitude']
    wind = data['si10']
    
    # Convert time variable to readable dates
    times = variables['time'][:]
    units = variables['time'].units
    ptime = num2date(times[:], units, calendar='gregorian')
    
    print('Available Time Observation to Plot : (index, date) ')
    for index, date in enumerate(ptime):
        print(index, date)
        
        # Format date strings
        date_str = str(date)
        year = date_str[:4]
        month_num = int(date_str[5:7])
        
        # Create folder to keep extracted data
        save_path = os.path.join(current_path, '20-Extract', year)
        os.makedirs(save_path, exist_ok=True)
        
        # Get the number of days in the current month
        _, days_in_month = monthrange(int(year), month_num)
        
        # Ensure wind data is reshaped to match the lat/lon grid
        if wind.ndim == 3:
            wind_data = wind[index, :, :]
        elif wind.ndim == 2:
            wind_data = wind
        else:
            raise ValueError("Unexpected wind data dimensions")
        
        lon_grid, lat_grid = np.meshgrid(lon, lat)
        
        # Prepare data for saving
        extracted_data = np.column_stack((lat_grid.ravel(), lon_grid.ravel(), wind_data.ravel()))
        
        # Save data to file
        np.savetxt(os.path.join(save_path, f'Extract-{year}{date_str[5:7]}.dat'), extracted_data, fmt='%9.3f')
