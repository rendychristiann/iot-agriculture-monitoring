# iot-agriculture-monitoring


![image](https://github.com/rendychristiann/iot-agriculture-monitoring/assets/78911479/f91768d7-6fac-43c4-9f6b-f10503c769ce)
This is a project for developing an IoT system for monitoring data on plant parameters. The data acquired include air humidity and temperature readings from the DHT11 sensor, solar exposure readings from the LDR sensor module, and soil moisture readings from the FC28 sensor. The data collected from the system is saved in the mySQL database. Data from the mySQL database will be presented in real time on the web socket.

The front-end application for showing sensor data monitoring is stored in the progress.php file. On the back end, the senddata.php file contains a program that retrieves data from the ESP32 and inserts it into the mySQL database. To get data for each parameter, the files cekkelembaban.php, ceksuhu.php, cekldr.php, and cektanah.php are needed.
