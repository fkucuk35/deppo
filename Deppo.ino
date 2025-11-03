#define BLYNK_TEMPLATE_NAME "Deppo"
#define BLYNK_AUTH_TOKEN "RZD0NEwWh8BE1lDN3YhmGGRXlyFohHWA"
#define BLYNK_TEMPLATE_ID "Deppo"
#define BLYNK_DEVICE_NAME "Deppo"

#define BLYNK_PRINT Serial
#include <ESP8266WiFi.h> 
 
#include <BlynkSimpleEsp8266.h>
 

char auth[] = BLYNK_AUTH_TOKEN;

char ssid[] = "PhoenixNET";  // wifi ismi
char pass[] = "tb050608";  //  wifi şifresi

void setup()
{     
  int rolepin = D7;  //GPIO16 çıkışı hıgh a çekmek için tanımladık 
  Serial.begin(115200);
  Blynk.begin(auth, ssid, pass);    
  digitalWrite(D7,HIGH);             //rolenın ilk baştaki çekmesini engelliyoruz
  }

void loop()
{
  Blynk.run(); 
 }
