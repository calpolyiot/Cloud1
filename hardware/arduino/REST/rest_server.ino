/* 
*  Arduino REST Server to share sensor data over internet.
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

// WiFi network (change with your settings!)
#define WLAN_SSID       ""
#define WLAN_PASS       ""
#define WLAN_SECURITY   

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

// define variables for sensors to expose
int light, temperature; //temperature2;
                             
void setup(void)
{   
  // Start Serial
  Serial.begin(115200);
  
  // Expose variables to REST API
  rest.variable("light",&light);
  rest.variable("temperature", &temperature);
  //rest.variable("temperature2", &temperature2);
  
  // Set name
  rest.set_id("1");
  rest.set_name("Device1");
    
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
  light = analogRead(0);
  temperature = analogRead(1);
  temperature /= 8;
  //temperature2 = analogRead(2);
  
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
