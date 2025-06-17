#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

const char* ssid = "Your Wifi Router SSID";
const char* password = "Your Wifi Router Password";

//Your Domain name with URL path or IP address with path
String serverName = "http://Your Web Url/processes/webRequest.php";  //web url
String data;
int wifiled = D5;
int webled = D6;

void setup() {
  Serial.begin(115200);
  pinMode(wifiled, OUTPUT);
  pinMode(webled, OUTPUT);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED) {  //wifi connection eka start krnne
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");  // connect una ip address showing
  Serial.println(WiFi.localIP());
  digitalWrite(wifiled, HIGH);

  Serial.println("Timer set to 5 seconds (timerDelay variable), it will take 5 seconds before publishing the first reading.");
}

void loop() {


  if (Serial.available()) {

    data = "";

    while (Serial.available()) {

      char c = Serial.read();
      delay(5);
      data += c;
    }

    int length = data.length();

    if (length < 12) {
      Serial.println("data String length = " + length);
    } else {
      Serial.println(data);
      loopOne();  // calle the loop req yqna eka
    }

    length = 0;
  }


  //
}

unsigned long previousMillisOne = 0;  // Previous time for loopOne
const long intervalOne = 100;         // Interval for loopOne

// First loop
void loopOne() {

  unsigned long currentMillis = millis();

  if (currentMillis - previousMillisOne >= intervalOne) {

    // Update the previous time to current time
    previousMillisOne = currentMillis;

    //Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {  // checking connectivity of wifi
      WiFiClient client;
      HTTPClient http;

      String serverPath = serverName + "?data=" + data;  // bining theata for url

      // Your Domain name with URL path or IP address with path
      http.begin(client, serverPath.c_str());

      Serial.println(serverPath.c_str());

      // If you need Node-RED/server authentication, insert user and password below
      //http.setAuthorization("REPLACE_WITH_SERVER_USERNAME", "REPLACE_WITH_SERVER_PASSWORD");

      // Send HTTP GET request
      int httpResponseCode = http.GET();

      if (httpResponseCode > 0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);

        if (httpResponseCode == 200) {
          loopTwo();
        }

        String payload = http.getString();
        Serial.println(payload);
      } else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    } else {
      Serial.println("WiFi Disconnected");
    }

    //
  }
}


unsigned long previousMillisTwo = 0;  // Previous time for loopTwo
const long intervalTwo = 100;         // Interval for loopTwo

// Second loop
void loopTwo() {
  unsigned long currentMillis = millis();

  if (currentMillis - previousMillisTwo >= intervalTwo) {
    // Update the previous time to current time
    previousMillisTwo = currentMillis;

    //code for the second loop
    digitalWrite(webled, HIGH);
    delay(500);
    digitalWrite(webled, LOW);
  }

  //
}
