# -*- coding: utf-8 -*-
import numpy as np
import os
import pandas as pd

# Get the current working directory
path0 = os.getcwd()
print("Current directory:", path0)

# Define the location with its latitude and longitude
location = ['Sultan Ibrahim Building']
location_lat = [1.4578244507187395]
location_lon = [103.76106062386076]
# location = ['A Famosa']
# location_lat = [2.191820511465901]
# location_lon = [102.2503554946755]

# Define the years to be processed
tahun = [
    '1940', '1941', '1942', '1943', '1944', '1945', '1946',
    '1947', '1948', '1949', '1950', '1951', '1952', '1953',
    '1954', '1955', '1956', '1957', '1958', '1959', '1960',
    '1961', '1962', '1963', '1964', '1965', '1966', '1967',
    '1968', '1969', '1970', '1971', '1972', '1973', '1974',
    '1975', '1976', '1977', '1978', '1979', '1980', '1981',
    '1982', '1983', '1984', '1985', '1986', '1987', '1988',
    '1989', '1990', '1991', '1992', '1993', '1994', '1995',
    '1996', '1997', '1998', '1999', '2000', '2001', '2002',
    '2003', '2004', '2005', '2006', '2007', '2008', '2009',
    '2010', '2011', '2012', '2013', '2014', '2015', '2016',
    '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024'
]

# Initialize an empty list to store accumulated wind data
accum = []

# Process each year
for year in tahun:
    
    # Process each location
    for p in location:
        
        # Define paths for the selected location data and merged data
        path3 = os.path.join(path0, '60-Select-Location', p, year)
        os.makedirs(path3, exist_ok=True)
        
        path4 = os.path.join(path0, '80-Merge-Data', p)
        os.makedirs(path4, exist_ok=True)
        
        # Initialize a list to store temperature data for the year
        wind_data = [year]
        
        # Process each month
        for month in range(1, 13):
            month_str = f'{month:02d}'
            file_path = os.path.join(path3, f'Data-Location-{year}{month_str}.dat')
            
            if os.path.exists(file_path):
                data = np.loadtxt(file_path, dtype='float')
                wind_data.append(data[5])
            else:
                # Set a placeholder value (e.g., None or 0) for missing data
                wind_data.append(0)
        
        # Append the combined data to the accum list
        accum.append(wind_data)
    
    # Print the accumulated data for verification
    print(accum)

# Convert the accumulated data to a pandas DataFrame
df = pd.DataFrame(accum, columns=['Year', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])

# Define file paths for saving the CSV file
csv_file_path_1 = os.path.join(path4, f'Data-Merge-{p}.csv')
csv_file_path_2 = r'C:\Users\MSI\Documents\PSM\TRAINING\TRAINING\Code\wind_data_jb.csv'

# Save the DataFrame to CSV files in both locations
df.to_csv(csv_file_path_1, index=False)
df.to_csv(csv_file_path_2, index=False)
print(f"Data saved to {csv_file_path_1}")
print(f"Data saved to {csv_file_path_2}")

