import numpy as np
import matplotlib.pyplot as plt
import os

##### searching current folder path 
path0 = os.getcwd()
print(path0)

plt.rcParams.update({'font.size':12,'font.family':'arial'})
fig = plt.figure(figsize=(10,12))
#fig.subplots_adjust(top=0.93)
fig.subplots_adjust(wspace=0.3)
fig.subplots_adjust(hspace=0.8)

path3=path0+'/100-Histogram/'
os.makedirs(os.path.dirname(path3), exist_ok=True)

location=['Sultan Ibrahim Building']
# location=['Museum-Padi','SK-Wan-Yahya','Pendang-Lake-Resort','Hotel-Seri-Malaysia']

for locations in location:
    
    path2=path0+'/80-Merge-Data/'+locations+'/'
    os.makedirs(os.path.dirname(path2), exist_ok=True)
    
    
    data1=np.loadtxt(path2+'Data-Merge-'+locations+'.dat')
    
   
    bulan=[1,2,3,4,5,6,7,8,9,10,11,12]
    frame=[1,2,3,4,5,6,7,8,9,10,11,12]
    
     
    for x,y in zip(bulan,frame):
        
        tahun=data1[:,0]
        tahun2=[int(i) for i in tahun]
        print(tahun2)
        jan=data1[:,x]
        
       
        ax = fig.add_subplot(6,2,y)
 
        # plotting a bar chart
        #plt.bar(tahun, jan, tick_label = tick_label, width = 0.8, color = ['red', 'blue'])
        plt.bar(tahun, jan, tick_label = tahun2, width = 0.8, color = 'cyan')
        
        plt.xticks(tahun[::2],rotation=70,ha='left',fontsize=6)
        
        plt.ylim(0,800)
        #plt.ylim(range(0,800,100))
        plt.yticks(np.arange(0,800,200),fontsize=10)
        plt.grid(color = 'red', linestyle = '--', linewidth = 0.1)

##### plotting trend line #######################
        #calculate equation for trendline
        z = np.polyfit(tahun, jan, 1)
        p = np.poly1d(z)
        
        #add trendline to plot
        plt.plot(tahun, p(tahun),color="red", linewidth=3, linestyle="--")
#########################################################        
        # naming the x-axis
        #plt.xlabel('Years',fontsize=10)
        # naming the y-axis
        plt.ylabel('Total (mm)',fontsize=10)
        # plot title
        plt.title('Rainfall Trend Month '+str(x),fontsize=10)
        plt.suptitle('Rainfall Trend for '+locations,fontsize=14,y=0.91)
    plt.savefig(path3+locations+".png",dpi=280, bbox_inches='tight')
    plt.clf()
        
     
    