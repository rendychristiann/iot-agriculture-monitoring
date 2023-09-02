# Smart-IoT-Agriculture-Monitoring-System-using-ESP32-and-Websocket

This is a project for developing an IoT system for monitoring data on plant parameters. The data acquired include air humidity and temperature readings from the DHT11 sensor, solar exposure readings from the LDR sensor module, and soil moisture readings from the FC28 sensor. The data collected from the system is saved in the mySQL database. Data from the mySQL database will be presented in real time on the web socket.
![image](https://github.com/rendychristiann/iot-agriculture-monitoring/assets/78911479/f91768d7-6fac-43c4-9f6b-f10503c769ce)
The front-end application for showing sensor data monitoring is stored in the progres.php file. On the back end, the kirimdata.php file contains a program that retrieves data from the ESP32 and inserts it into the mySQL database. To get data for each parameter, the files cekkelembaban.php, ceksuhu.php, cekldr.php, and cektanah.php are needed.

The styles.css file stores front-end UI appearance modifications. Meanwhile, the progress bar modification mechanism for showing sensor data is built on Bootstrap 4.

