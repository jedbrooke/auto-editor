import os
import subprocess
import time
import datetime
import sys
import matplotlib.pyplot as plt

class DataEntry:
    def __init__(self,timestamp,cpu_data):
        timestruct = time.strptime(timestamp, "%m/%d/%Y %j:%M:%S %p")
        self.timestamp = time.mktime(timestruct)
        self.cpu_user,self.cpu_nice,self.cpu_system,self.cpu_iowait,self.cpu_steal,self.cpu_idle = [float(d) for d in cpu_data.split(" ") if len(d) > 0]
    def __str__(self):
        return f"{self.timestamp}\n{self.cpu_nice}"

def main():
    cpu_temp_file_path = "/tmp/cpu_activity.txt"
    if os.path.exists(cpu_temp_file_path):
        os.remove(cpu_temp_file_path)
    cpu_activity = open(cpu_temp_file_path,"w")
    monitor_cmd = "iostat -tc 1"

    monitor = subprocess.Popen(monitor_cmd, shell=True, stdout=cpu_activity)
    # execute the process to be analyzed
    process_cmd = " ".join(sys.argv[1:])
    print(f"Starting Process: {process_cmd}",file=sys.stderr)

    start_time = time.strptime(str(datetime.datetime.now()).split(".")[0],"%Y-%m-%d %H:%M:%S")
    process = subprocess.Popen(process_cmd, shell=True, stdout=subprocess.PIPE)
    
    process_output = process.stdout.read().decode('utf-8').strip()
    end_time = time.strptime(str(datetime.datetime.now()).split(".")[0],"%Y-%m-%d %H:%M:%S")
    start_time,end_time = time.mktime(start_time), time.mktime(end_time)
    print(start_time,end_time)
    print(process_output)

    monitor.terminate()
    cpu_activity.close()

    with open(cpu_temp_file_path,"r") as cpu_activity_file:
        lines = [line.strip() for line in cpu_activity_file if len(line.strip()) > 0]
    
    header,data = lines[0],lines[1:]
    print(header)
    print("-"*20)


    grouped_data = [data[3*i:3*(i+1)] for i in range(len(data) // 3)]
    entries = [DataEntry(timestamp.strip(),cpu_data) for timestamp,_,cpu_data in grouped_data]

    timestamps,usage = [e.timestamp for e in entries],[e.cpu_idle for e in entries]
    t0 = timestamps[0]
    timestamps = [t - t0 for t in timestamps]
    usage = [100 - u for u in usage]

    plt.plot(timestamps,usage)
    plt.savefig("usage.png")


    

    os.remove(cpu_temp_file_path)



 

if __name__ == '__main__':
    main()