import numpy as np
import glob
import os

# Get the current working directory
path0 = os.getcwd()
print(path0)

# Define locations with their respective latitudes and longitudes
# location=['Sultan Ibrahim Building']
# location_lat=[1.4578244507187395]
# location_lon=[103.76106062386076]
location = ['A Famosa']
location_lat = [2.191820511465901]
location_lon = [102.2503554946755]

# Define the years to be processed
# If you want to run manually each year, you can uncomment the line below and comment the 'tahun' list
# tahun = ['2021','2022'] 

tahun=[ '1940', '1941', '1942', '1943', '1944', '1945', '1946',
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
        '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024' ]

# Process each year
for year in tahun:
    try:
        for p,q,r in zip(location,location_lat,location_lon):
            
            # Define folder path for the year
            datefolder=year
            
             # Define and create the necessary directories for extraction and location selection
            path2=path0+'/20-Extract/'+datefolder+'/'
            os.makedirs(os.path.dirname(path2), exist_ok=True)
            
            path3=path0+'/60-Select-Location/'+p+'/'+datefolder+'/'
            os.makedirs(os.path.dirname(path3), exist_ok=True)
            
            
            # Search for all files in the directory that match the pattern 'Extract*.dat'
            folder=glob.glob(path2+'Extract*.dat')
            
            for files in folder:
                print (files)
                
                # Extract the filename and date information
                nama_file=files[-10:-4]
                print(nama_file)
                dates=files[-10:-4]
                print(dates)
            
                # Load the data from the file
                data=np.loadtxt(files,dtype='float')
            
                # Extract latitude, longitude, and wind
                lat=data[:,0]
                lon=data[:,1]
                wind_rate=data[:,2]
                
                # Define the target latitude and longitude (location to select data for)
                in_lats1=[q]
                in_lons1=[r]
            
                # Find the closest data point to the target location
                ind=[]
                combine=[]
                ind=[]
                for i in range(1):
                    dist=(lat-in_lats1[i])**2+(lon-in_lons1[i])**2
                    ind.append(np.where(dist==np.min(dist))[0][0])
                
                    lat2=lat[ind]
                    lon2=lon[ind]
                    wind_rate2=wind_rate[ind]  
            
                # Combine the date, target location, and selected data into an array
                data3=[np.array([dates]),in_lats1,in_lons1,lat2,lon2,wind_rate2]
                data3=np.transpose(data3)
            
                # Save the selected data to a new file
                fmt1='%s' # Format for saving data
                np.savetxt(path3+'Data-Location-'+dates+'.dat',data3,fmt=fmt1)
            
    except IOError:
        pass # Ignore any I/O errors and continue with the next year
        
        
