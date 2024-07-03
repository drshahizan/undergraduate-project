import numpy as np
import glob
import matplotlib.pyplot as plt
from mpl_toolkits.basemap import Basemap, cm
import matplotlib.colors as mcol
import matplotlib as mpl
import os
import warnings

warnings.filterwarnings("ignore")

# Get the current working directory
path0 = os.getcwd()
print(path0)

# Define the year to be processed
tahun = '2019'

# Define the folder path for the year
datefolder = tahun

# Define and create the necessary directories
path2 = path0 + '/20-Extract/' + datefolder + '/'
os.makedirs(os.path.dirname(path2), exist_ok=True)

path3 = path0 + '/54-Plot-Monthly/' + datefolder + '/'
os.makedirs(os.path.dirname(path3), exist_ok=True)

# Additional directory for saving heatmap images
heatmap_dir = 'C:/Users/MSI/Documents/PSM/TRAINING/TRAINING/Dashboard/Heatmap/'
os.makedirs(heatmap_dir, exist_ok=True)

# Search for all files in the directory that match the pattern 'Extract*.dat'
folder = glob.glob(path2 + 'Extract*.dat')

# Process each file found
for files in folder:
    print(files)
    
    # Extract the filename and date information
    nama_file = files[-10:-4]
    print(nama_file)
    dates = files[-10:-6]
    print(dates)

    # Load the data from the file
    data = np.genfromtxt(files)

    # Extract latitude, longitude, and wind speed
    lat = data[:, 0]
    lat = [float(i) for i in lat]
    print(type(lat[0]))
    
    lon = data[:, 1]
    lon = [float(i) for i in lon]
    
    wind_rate = data[:, 2]
    wind_rate = [float(i) for i in wind_rate]
    
    print(max(wind_rate))
    print(wind_rate[10])
    print(lat[0])
    print(max(wind_rate))
    
    # Get unique latitude and longitude values and their index positions
    lat_uniq, lat_idx = np.unique(lat, return_inverse=True)
    lon_uniq, lon_idx = np.unique(lon, return_inverse=True)
    
    # Create 2D array necessary for the contour plot
    X, Y = np.meshgrid(lon_uniq, lat_uniq)
    Z = np.full(X.shape, np.nan)
    
    # Fill the 2D array with the wind rate data
    Z[lat_idx, lon_idx] = wind_rate
    print(Z.shape)
    
    # Setting up the plot for wind speed
    fig = plt.figure(figsize=(8, 10))
    fig.subplots_adjust(left=0.05, right=0.95, top=0.90, bottom=0.1, wspace=0.15, hspace=0.10)
    
    plt.subplot(111)
    
    # Create a Basemap instance
    m = Basemap(projection='merc', llcrnrlat=0., llcrnrlon=95.,
                urcrnrlat=10., urcrnrlon=120., resolution='l')
    m.drawparallels(np.arange(-90, 91, 5), labels=[1, 0, 0, 0], color='0.25',
                    linewidth=0.1, fontsize=10)
    m.drawmeridians(np.arange(-180, 180, 5), labels=[0, 0, 0, 1], color='0.25',
                    linewidth=0.1, fontsize=10)
    m.drawcountries()
    m.drawstates()
    m.drawcoastlines(linewidth=0.5)

    # Path to shapefiles for drawing boundaries
    path = 'C:/Users/MSI/Documents/PSM/TRAINING/TRAINING/Data-GADM/Data-GADM/'
    m.readshapefile(path + 'gadm36_MYS_shp/gadm36_MYS_1', name='NAME_1', drawbounds=True)  # NEGERI ONLY
    m.readshapefile(path + 'gadm36_MYS_shp/gadm36_MYS_2', name='NAME_2', drawbounds=True)  # DAERAH
    
    # Define colormap and contour levels
    cmap = cm.s3pcpn_l
    clevprecip = np.arange(0, 10, 0.1)
    norm1 = mpl.colors.BoundaryNorm(clevprecip, cmap.N)
    
    # Create the contour plot
    cf = m.contourf(X, Y, Z, clevprecip, cmap=cmap, norm=norm1, latlon=True)
    cbar = m.colorbar(cf, location='bottom', pad="12%")
    cbar.ax.tick_params(labelsize=10)
    cbar.set_label('Monthly Accumulated Wind Speed', fontsize=10)
    
    # Add title to the plot
    title1 = 'ERA5-Monthly Accumulated Wind Speed for ' + nama_file
    plt.title(title1)
    
    # Adjust the naming convention for the saved images
    save_name = f'Wind Speed {nama_file}.png'
    
    # Save the plot as a PNG file
    plt.savefig(os.path.join(path3, save_name), dpi=500, bbox_inches='tight')
    
    # Save the plot in the additional heatmap directory
    plt.savefig(os.path.join(heatmap_dir, save_name), dpi=500, bbox_inches='tight')
    