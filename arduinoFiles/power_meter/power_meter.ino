////Final////

#include <Wire.h> /*Load the library for talking over I2C (by default already built-it with arduino solftware)*/
#include <SD.h>   /*Load the SD card Library (by default already built-it with arduino solftware)*/
#include <SPI.h>  /*Load the SPI of SPI communication Library (by default already built-it with arduino solftware)*/

#include <LiquidCrystal_I2C.h>
/* 0- General */

//////////////// serial communication //////////////////
#include <SoftwareSerial.h>

SoftwareSerial espSerial(5, 6);
//////////////// serial communication //////////////////

int decimalPrecision = 1;
// decimal places for large values such as voltage, wattage, apparent power, and frequency shown in LED Display & Serial Monitor
// decimal places for small values such as current, power factor and accumulate energy will be decimal places x 2.


/* 1- AC Voltage Measurement */

int VoltageAnalogInputPin = A2;  // Which pin to measure voltage Value
float voltageSampleRead = 0;     /* to read the value of a sample*/
float voltageLastSample = 0;     /* to count time for each sample. Technically 1 milli second 1 sample is taken */
float voltageSampleSum = 0;      /* accumulation of sample readings */
float voltageSampleCount = 0;    /* to count number of sample. */
float voltageMean;               /* to calculate the average value from all samples*/
float RMSVoltageMean;            /* square roof of voltageMean*/


/*1.1 Offset AC Voltage */

float voltageOffset1 = 5.123;  // to Offset deviation and accuracy. Offset any fake current when no current operates.
                               // Offset will automatically callibrate when SELECT Button on the LCD Display Shield is pressed.
                               // If you do not have LCD Display Shield, look into serial monitor to add or minus the value manually and key in here.
float voltageOffset2 = 0;      // to offset value due to calculation error from squared and square root.


/* 2- AC Current Measurement */

int CurrentAnalogInputPin = A3;  // Which pin to measure Current Value
float mVperAmpValue = 185;       //31.25;                      // If using ACS712 current module : for 5A module key in 185, for 20A module key in 100, for 30A module key in 66
                                 // If using "Hall-Effect" Current Transformer, key in value using this formula: mVperAmp = maximum voltage range (in milli volt) / current rating of CT
                                 /* For example, a 20A Hall-Effect Current Transformer rated at 20A, 2.5V +/- 0.625V, mVperAmp will be 625 mV / 20A = 31.25mV/A */
float currentSampleRead = 0;     /* to read the value of a sample*/
float currentLastSample = 0;     /* to count time for each sample. Technically 1 milli second 1 sample is taken */
float currentSampleSum = 0;      /* accumulation of sample readings */
float currentSampleCount = 0;    /* to count number of sample. */
float currentMean;               /* to calculate the average value from all samples*/
float RMSCurrentMean = 0;        /* square roof of currentMean*/
float FinalRMSCurrent;           /* the final RMS current reading*/


/*2.1 Offset AC Current */

float currentOffset1 = 6.25;  // to Offset deviation and accuracy. Offset any fake current when no current operates.
                              // Offset will automatically callibrate when SELECT Button on the LCD Display Shield is pressed.
                              // If you do not have LCD Display Shield, look into serial monitor to add or minus the value manually and key in here.
                              // 26 means add 26 to all analog value measured
float currentOffset2 = 0;     // to offset value due to calculation error from squared and square root.


/* 3- AC Power Measurement */

float sampleCurrent1;       /* use to calculate current*/
float sampleCurrent2;       /* use to calculate current*/
float sampleCurrent3;       /* use to calculate current*/
float apparentPower;        /* the apparent power reading (VA) */
float realPower = 0;        /* the real power reading (W) */
float powerSampleRead = 0;  /* to read the current X voltage value of a sample*/
float powerLastSample = 0;  /* to count time for each sample. Technically 1 milli second 1 sample is taken */
float powerSampleCount = 0; /* to count number of sample. */
float powerSampleSum = 0;   /* accumulation of sample readings */
float powerFactor = 0;      /* to display power factor value*/


/*3.1 Offset AC Power */

float powerOffset = 0;  // to Offset deviation and accuracy. Offset any fake current when no current operates.
                        // Offset will automatically callibrate when SELECT Button on the LCD Display Shield is pressed.
                        // If you do not have LCD Display Shield, look into serial monitor to add or minus the value manually and key in here.


/* 4 - Daily Energy Measurement*/

float dailyEnergy = 0;           /* recorded by multiplying RMS voltage and RMS current*/
float energyLastSample = 0;      /* Use for counting time for Apparent Power */
float energySampleCount = 0;     /* to count number of sample. */
float energySampleSum = 0;       /* accumulation of sample readings */
float finalEnergyValue = 0;      /* total accumulate energy */
float finalDailyEnergyValue = 0; /* total accumulate daily energy*/
float accumulateEnergy = 0;      /* accumulate of energy readings*/


/* 5- frequency measurement */

unsigned long startMicros;      /* start counting time for frequency (in micro seconds)*/
unsigned long currentMicros;    /* current counting time for frequency (in micro seconds) */
int expectedFrequency = 47;     // This is to collect number of samples. for 50Hz use 46 or below. For 60Hz use 54 or below.
                                // Use exact number of frequency number (50/60) will have calculation error
float frequencySampleCount = 0; /* count the number of sample, 1 sample equivalent to 1 cycle */
float frequency = 0;            /* shows the value of frequency*/
float a;                        /* use for calculation purpose*/
float switch01 = 9;             /* use for switching function */
float vAnalogRead = 0;          // read analog value, highly recommend AC voltage sensor
                                // Automatically bonded with "VoltageAnalogInputPin = A2" reading


/* 4 - LCD Display  */


LiquidCrystal_I2C LCD(0x27, 20, 4);    // set the LCD address to 0x27 for a 16 chars and 2 line display
unsigned long startMillisLCD;          /* start counting time for LCD Display */
unsigned long currentMillisLCD;        /* current counting time for LCD Display */
const unsigned long periodLCD = 1000;  // refresh every X seconds (in milli seconds) in LED Display. Default 1000 = 1 second


/* 5 - SD memory card shield, */

int chipSelect = 10;  // Select ChipSelect pin based on the Arduino Board. The pin is 10 on Arduino Uno and cannot be changed.
File mySensorData;    /* Variable for working with our file object*/



void setup() { /*codes to run once */

  /* 0- General */

  Serial.begin(115200); /* to display readings in Serial Monitor at 9600 baud rates */
  espSerial.begin(115200);
  /* 5- frequency measurement */

  startMicros = micros(); /* Start counting time for frequency measurement */

  /* 4 - LCD Display  */

  LCD.init();  // initialize the lcd
  LCD.init();  /* Tell Arduino that our LCD has 16 columns and 2 rows*/
  LCD.backlight();
  LCD.setCursor(0, 0);       /* Set LCD to start with upper left corner of display*/
  startMillisLCD = millis(); /* Start counting time for LCD display*/

  /* 5 - SD memory card shield */

  pinMode(chipSelect, OUTPUT); /* reserve pin 10 as an ouput by default. Pin 10 use during transfer data into SD card */
  Wire.begin();                /* Initiate I2C bus communication*/
  SD.begin(chipSelect);        /* Initiate the SD Card with chipSelect connected to pin 10 by default*/


  ///////////////////// SD initializing and reading the last kWh written /////////////////
  Serial.print("Initializing SD card...");
  if (!SD.begin(10)) {
    Serial.println("initialization failed!");
  } else {
    Serial.println("initialization done.");

    // open the file for reading:
    mySensorData = SD.open("kWh.txt", FILE_WRITE);
    if (mySensorData) {
      mySensorData.seek(0);  // Start at the end of the file

      char delimiter = '\n';  // Assuming newline as a delimiter
      String lastValue = "";

      while (mySensorData.available()) {
        char c = mySensorData.read();
        if (c == delimiter) {
          // Found a delimiter, update lastValue
          lastValue = "";
        } else {
          // Append character to lastValue
          lastValue += c;
        }
      }

      float floatValue = lastValue.toFloat();  // Convert the string to a float

      if (floatValue > 0) {
        finalEnergyValue = floatValue;
      }


      // Now lastValue should contain the last data entry
      Serial.println("Last Wh Value: " + lastValue);

      mySensorData.close();  // Close the file

    } else {
      // if the file didn't open, print an error:
      Serial.println("error opening kWh.txt");
    }
  }

  //
}


void loop() /*codes to run again and again */
{

  /* 1- AC Voltage Measurement */

  if (millis() >= voltageLastSample + 1) /* every 1 milli second taking 1 reading */
  {
    voltageSampleRead = 2 * (analogRead(VoltageAnalogInputPin) - 512) + voltageOffset1; /* read the sample value */
    voltageSampleSum = voltageSampleSum + sq(voltageSampleRead);                        /* accumulate value with older sample readings*/
    voltageSampleCount = voltageSampleCount + 1;                                        /* to move on to the next following count */
    voltageLastSample = millis();                                                       /* to reset the time again so that next cycle can start again*/
  }

  if (voltageSampleCount == 1000) /* after 1000 count or 1000 milli seconds (1 second), do the calculation and display value*/
  {
    voltageMean = voltageSampleSum / voltageSampleCount; /* calculate average value of all sample readings taken*/
    RMSVoltageMean = sqrt(voltageMean) + voltageOffset2; /* square root of the average value*/
    voltageSampleSum = 0;                                /* to reset accumulate sample values for the next cycle */
    voltageSampleCount = 0;                              /* to reset number of sample for the next cycle */
  }


  /* 2- AC Current Measurement */

  if (millis() >= currentLastSample + 1) /* every 1 milli second taking 1 reading */
  {
    currentSampleRead = analogRead(CurrentAnalogInputPin) - 512 + currentOffset1; /* read the sample value */
    currentSampleSum = currentSampleSum + sq(currentSampleRead);                  /* accumulate value with older sample readings*/
    currentSampleCount = currentSampleCount + 1;                                  /* to move on to the next following count */
    currentLastSample = millis();                                                 /* to reset the time again so that next cycle can start again*/
  }

  if (currentSampleCount == 1000) /* after 1000 count or 1000 milli seconds (1 second), do the calculation and display value*/
  {
    currentMean = currentSampleSum / currentSampleCount;                  /* calculate average value of all sample readings taken*/
    RMSCurrentMean = sqrt(currentMean) + currentOffset2;                  /* square root of the average value*/
    FinalRMSCurrent = (((RMSCurrentMean / 1024) * 5000) / mVperAmpValue); /* calculate the final RMS current*/
    currentSampleSum = 0;                                                 /* to reset accumulate sample values for the next cycle */
    currentSampleCount = 0;                                               /* to reset number of sample for the next cycle */
  }


  /* 3- AC Power with Direction */

  if (millis() >= powerLastSample + 1) /* every 1 milli second taking 1 reading */
  {
    sampleCurrent1 = analogRead(CurrentAnalogInputPin) - 512 + currentOffset1; /* create variable for formula purpose */
    sampleCurrent2 = (sampleCurrent1 / 1024) * 5000;
    sampleCurrent3 = sampleCurrent2 / mVperAmpValue;
    voltageSampleRead = 2 * (analogRead(VoltageAnalogInputPin) - 512) + voltageOffset1;  // the formula is times 2 so that the amplitude can be reduced by half to overcome wave limit cut near 250Vac
    powerSampleRead = voltageSampleRead * sampleCurrent3;                                /* real power sample value */
    powerSampleSum = powerSampleSum + powerSampleRead;                                   /* accumulate value with older sample readings*/
    powerSampleCount = powerSampleCount + 1;                                             /* to move on to the next following count */
    powerLastSample = millis();                                                          /* to reset the time again so that next cycle can start again*/
  }

  if (powerSampleCount == 1000) /* after 1000 count or 1000 milli seconds (1 second), do the calculation and display value*/
  {
    realPower = ((powerSampleSum / powerSampleCount) + powerOffset); /* calculate average value of all sample readings */
    apparentPower = FinalRMSCurrent * RMSVoltageMean;                /*Apparent power do not need to recount as RMS current and RMS voltage values available*/
    powerFactor = realPower / apparentPower;
    if (powerFactor > 1 || powerFactor < 0) /* if power factor more than 1 or less than 0, key in power factor = 0 */
    {
      powerFactor = 0;
    }
    powerSampleSum = 0;   /* to reset accumulate sample values for the next cycle */
    powerSampleCount = 0; /* to reset number of sample for the next cycle */
  }


  /* 4 - Accumulate & Daily Energy Measurement*/

  if (millis() >= energyLastSample + 1) /* every 1 milli second taking 1 reading */
  {
    energySampleCount = energySampleCount + 1;
    energyLastSample = millis();
  }
  if (energySampleCount == 1000) /* after 1000 count or 1000 milli seconds (1 second), do the calculation and display value*/
  {
    accumulateEnergy = apparentPower / 3600; /* daily and accumulative seperated*/
    finalEnergyValue = finalEnergyValue + accumulateEnergy;

    energySampleCount = 0; /* Set the starting point again for next counting time */
  }



  /* 5 - LCD Display & Serial Print  */

  currentMillisLCD = millis();                        /* Set current counting time */
  if (currentMillisLCD - startMillisLCD >= periodLCD) /* for every x seconds, run the codes below*/
  {

    /////////////////////////////////////////// LCD Dispaly ////////////////////////////////////////////////////////
    LCD.setCursor(0, 1);                                /* Set cursor to first colum 0 and second row 1  */
    LCD.print(FinalRMSCurrent, (decimalPrecision * 2)); /* display current value in LCD in first row  */
    LCD.print("A  ");

    LCD.setCursor(0, 0);
    LCD.print(RMSVoltageMean, (decimalPrecision * 2)); /* display 1 day energy value in LCD in first row  */
    LCD.print("V     ");

    LCD.setCursor(8, 0);
    LCD.print(apparentPower / 1000, (decimalPrecision * 3)); /* display power value in LCD in first row  */
    LCD.print("kW  ");

    LCD.setCursor(8, 1);
    LCD.print(finalEnergyValue / 1000, (decimalPrecision * 3)); /* display total energy value in LCD in first row  */
    LCD.print("kWh  ");
    /////////////////////////////////////////// LCD Dispaly ////////////////////////////////////////////////////////


    /////////////////////////////////////////// Serial Print ////////////////////////////////////////////////////////
    Serial.print(FinalRMSCurrent, (decimalPrecision * 2)); /* display current value in LCD in first row  */
    Serial.print("A  ");

    Serial.print(RMSVoltageMean, (decimalPrecision * 2)); /* display 1 day energy value in LCD in first row  */
    Serial.print("V  ");

    Serial.print(apparentPower / 1000, ((decimalPrecision * 3))); /* display power value in LCD in first row  */
    Serial.print("kW  ");

    Serial.print(finalEnergyValue / 1000, (decimalPrecision * 3)); /* display total energy value in LCD in first row  */
    Serial.println("kWh  ");
    /////////////////////////////////////////// Serial Print ////////////////////////////////////////////////////////

    startMillisLCD = currentMillisLCD; /* Set the starting point again for next counting time */
  }

  loopOne();  // loop for sending web request
  loopTwo();  // loop for saving data to SD
}



unsigned long previousMillisOne = 0;  // Previous time for loopOne
const long intervalOne = 10000;       // Interval for loopOne

// First loop
void loopOne() {

  unsigned long currentMillis = millis();

  if (currentMillis - previousMillisOne >= intervalOne) {

    // Update the previous time to current time
    previousMillisOne = currentMillis;

    espSerial.print(FinalRMSCurrent, (decimalPrecision * 2)); /* display current value in LCD in first row  */
    espSerial.print(",");

    espSerial.print(RMSVoltageMean, (decimalPrecision * 2)); /* display 1 day energy value in LCD in first row  */
    espSerial.print(",");

    espSerial.print(apparentPower / 1000, (decimalPrecision * 3)); /* display power value in LCD in first row  */
    espSerial.print(",");

    espSerial.print(finalEnergyValue / 1000, (decimalPrecision * 3)); /* display total energy value in LCD in first row  */

    /////////////////////////////////////////// Esp Print ////////////////////////////////////////////////////////
  }
}



unsigned long previousMillisTwo = 0;  // Previous time for loopTwo
const long intervalTwo = 60000;       // Interval for loopTwo

// Second loop
void loopTwo() {
  unsigned long currentMillis = millis();

  if (currentMillis - previousMillisTwo >= intervalTwo) {
    // Update the previous time to current time
    previousMillisTwo = currentMillis;

    //code for the second loop
    mySensorData = SD.open("kWh.txt", FILE_WRITE);  // Open or create kWh.txt on the SD card as a file to write to
    if (mySensorData)                               // only to do these if data file opened sucessfully
    {
      mySensorData.seek(0);  // Start at the end of the file
      mySensorData.print("\n");
      mySensorData.print(finalEnergyValue); /* print out accumulate energy reading (same as display reading*/

      mySensorData.close();                                /*close the file*/
      Serial.println("written to SD Card successfully !"); /*to confirm that data is written to SD card, inform in Serial monitoring*/
    }
  }

  //
}
