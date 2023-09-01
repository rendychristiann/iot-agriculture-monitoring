

// Final Project EdSpert Bootcamp IoT
// Judul    : Smart IoT Farming Automation and Monitoring System 
// Kelompok : 5

// Referensi kebutuhan cahaya tanaman : 
// https://sustainablecampus.unimelb.edu.au/__data/assets/pdf_file/0005/2839190/Indoor-plant-workshop-Light-and-Moisture-Requirements.pdf

#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include "DHT.h"
#include "WiFi.h"
#include "HTTPClient.h"

#define LED_as_relay 18
#define ldrPin 35
#define DHT_PIN 13
#define DHTTYPE DHT11
#define LED_PIN 5
DHT dht(DHT_PIN, DHT11);
LiquidCrystal_I2C lcd(0x3F,16,2);

// Representasi sensor FC28 dengan menggunakan potentiometer
#define moisturePin 34 
float soil_moisture; 

unsigned long prevMillis = 0;
const long interval = 1000;
const float gama = 0.7;
const float rl10 = 50;

// Variabel untuk WIFi hotspot dan password
const char* ssid = "rendey";
const char* pass = "300402si";

// Variabel host/server yang menampung aplikasi web dan database
const char* host = "192.168.0.102";

void setup() {
  Serial.begin(115200);
  Serial.flush();
  pinMode(moisturePin, INPUT);
  pinMode(ldrPin, INPUT);
  pinMode(DHT_PIN, INPUT);
  pinMode(LED_PIN, OUTPUT);
  pinMode(LED_as_relay, OUTPUT);

  // Koneksi ke WiFi
  WiFi.begin(ssid, pass);
  Serial.println("Connecting...");
  while(WiFi.status() != WL_CONNECTED){
    Serial.print(".");
    delay(500);
  }
  // Jika berhasil terkoneksi
  Serial.println("Connected");
  
  Serial.println("Smart Farming System");
  dht.begin();
  lcd.init();
  lcd.backlight();
  lcd.setCursor(0,0);
  lcd.print("Final Project");
  lcd.setCursor(0,1);
  lcd.print("IoT Bootcamp Edspert");
  lcd.setCursor(0,2);
  lcd.print("Smart Farming and");
  lcd.setCursor(0,3);
  lcd.print("Monitoring System");
  delay(2000);
  lcd.clear();
}

void loop() {
  // RTC serial print untuk menampilkan waktu
    //DateTime now = rtc.now();
    //int tahun = now.year() % 100;
    //Serial.println("Tanggal             : " + String() + now.day() + "/" + now.month() + "/" + tahun);
    //Serial.println("Waktu               : " + String() + now.hour() + ":" + now.minute() + ":" + now.second());

  // Data sensor DHT22
    float hum = dht.readHumidity();
    float temp = dht.readTemperature();

  // Data sensor LDR
    int lux = analogRead(ldrPin);
    String luxmsg = lux < 500 ? "Kurang" : lux > 500 && lux < 1000? "Medium" : "Tinggi";

  // Data sensor Soil Moisture FC28 
    soil_moisture = ( 100 - ( (analogRead(moisturePin) / 1023.00) * 100 ) );
    String msg = soil_moisture < 33.33 ? "Basah" : soil_moisture > 66.66 ? "Kering" : "Normal";
    
  // Relay untuk membuka jalur air ke tanaman berdasarkan kondisi kelembaban tanah
  if((soil_moisture > 66.66)){
    digitalWrite(LED_as_relay, HIGH);
  }
  else{
    digitalWrite(LED_as_relay, LOW);
  }

  // Output LCD untuk monitoring kondisi tumbuhan
    // Kondisi Tanah
    lcd.setCursor(0,0);
    lcd.print("Tanah      :");
    lcd.setCursor(13,0);
    lcd.print(msg);

    // Kondisi kecerahan dan terang nyala LED
    if (lux < 807){
      digitalWrite(LED_PIN, HIGH);
      lcd.setCursor(0,1);
      lcd.print("Kecerahan  : ");
      lcd.setCursor(13,1);
      lcd.print(luxmsg);
    }
    else if (lux > 808 && lux < 1614){
      digitalWrite(LED_PIN, LOW);
      lcd.setCursor(0,1);
      lcd.print("Kecerahan  : ");
      lcd.setCursor(13,1);
      lcd.print(luxmsg);
    }
    else{
      digitalWrite(LED_PIN, LOW);
      lcd.setCursor(0,1);
      lcd.print("Kecerahan  : ");
      lcd.setCursor(13,1);
      lcd.print(luxmsg);
    }

   unsigned long currentMillis = millis();
   if (currentMillis - prevMillis >= interval){
      Serial.println("Humidity            : " + String(hum) + " %");
      //Serial.println(hum);
      Serial.println("Temperature         : " + String(temp) + " C");
      //Serial.println(temp);
      Serial.println("Kecerahan           : " + String(lux));
      //Serial.println(lux);
      Serial.println("Soil Moisture Value : " + String(soil_moisture));
      //Serial.println(soil_moisture);
   }
    // Suhu
    //lcd.setCursor(0,2);
    //lcd.print("Suhu       :");
    //lcd.setCursor(13,2);
    //lcd.print(temp);
    //lcd.setCursor(19,2);
    //lcd.print("C");

    // Kelembaban
    //lcd.setCursor(0,3);
    //lcd.print("Kelembaban :");
    //lcd.setCursor(13,3);
    //lcd.print(hum);
    //lcd.setCursor(19,3);
    //lcd.print("%");

  Serial.println("--------------");

  // Kirim data ke server
  WiFiClient client;
  // Inisialisasi port web server 80 (XAMPP)
  const int httpPort = 80;
  if (!client.connect(host, httpPort)){
    Serial.println("Connection Failed");
    return;
  }
  // Kondisi terkoneksi: Kirim data sensor ke database/web
  String Link;
  HTTPClient http;
  Link = "http://" + String(host) + "/multisensor/kirimdata.php?suhu=" + String(temp) + "&kelembaban=" + String(hum) + "&ldr=" + String(lux) + "&tanah=" + String(soil_moisture);
  // Eksekusi alamat link
  http.begin(Link);
  http.GET();
  // Baca respons setelah berhasil kirim nilai sensor
  String respon = http.getString();
  Serial.println(respon);
  http.end();
  delay(2000); 
  lcd.clear();
}
