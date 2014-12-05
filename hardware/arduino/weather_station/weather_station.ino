/* 
*  Simple WiFi weather station with Arduino, the DHT11 sensor & the CC3000 chip
*  Part of the code is based on the work done by Adafruit on the CC3000 chip & the DHT11 sensor
*  Writtent by Marco Schwartz for Open Home Automation
*/

// Include required libraries
#include <Adafruit_CC3000.h>
#include <SPI.h>
#include <CC3000_MDNS.h>
#include <aREST.h>

// Define CC3000 chip pins
#define ADAFRUIT_CC3000_IRQ   3
#define ADAFRUIT_CC3000_VBAT  5
#define ADAFRUIT_CC3000_CS    10

// WiFi network (change with your settings !)
#define WLAN_SSID       "StarWarsSanctum"
#define WLAN_PASS       "littlewind113"
#define WLAN_SECURITY   WLAN_SEC_WPA2

// Create CC3000 & DHT instances
Adafruit_CC3000 cc3000 = Adafruit_CC3000(ADAFRUIT_CC3000_CS, 
ADAFRUIT_CC3000_IRQ, ADAFRUIT_CC3000_VBAT, SPI_CLOCK_DIV2);
                                         
// Create aREST instance
aREST rest = aREST();

// The port to listen for incoming TCP connections 
#define LISTEN_PORT           80

// Server instance
Adafruit_CC3000_Server restServer(LISTEN_PORT);

// DNS responder instance
MDNSResponder mdns;

// Variables to be exposed to the API
//float Rsensor_f;
int sensorValue, Rsensor_i;
                             
void setup(void)
{   
  // Start Serial
  Serial.begin(115200);
  
  // Expose variables to REST API
  rest.variable("analog",&sensorValue);
  rest.variable("sensor",&Rsensor_i);
  
  // Set name
  rest.set_id("1");
  rest.set_name("weather_station");
    
  // Initialise the CC3000 module
  if (!cc3000.begin())
  {
    while(1);
  }

  // Connect to  WiFi network
  cc3000.connectToAP(WLAN_SSID, WLAN_PASS, WLAN_SECURITY);
    
  // Check DHCP
  while (!cc3000.checkDHCP())
  {
    delay(100);
  }  
  
   // Start multicast DNS responder
  if (!mdns.begin("arduino", cc3000)) {
    while(1); 
  }
  
  // Start server
  restServer.begin();

  displayConnectionDetails(); 
}

void loop(void)
{
  // Measure from DHT
  sensorValue = analogRead(0);
  Rsensor_i = (1023-sensorValue)*10/sensorValue;
  //Rsensor_i = (int)Rsensor_f;
  
  // Handle any multicast DNS requests
  mdns.update();
  
  // Handle REST calls
  Adafruit_CC3000_ClientRef client = restServer.available();
  rest.handle(client);
}

bool displayConnectionDetails(void)
{
  uint32_t ipAddress, netmask, gateway, dhcpserv, dnsserv;
  
  if(!cc3000.getIPAddress(&ipAddress, &netmask, &gateway, &dhcpserv, &dnsserv))
  {
    return false;
  }
  else
  {
    Serial.println(F("\nIP Addr: ")); cc3000.printIPdotsRev(ipAddress);
    return true;
  }
}
