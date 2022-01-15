@ECHO OFF
ECHO Welcome, Billing software opening soon...
ECHO Please wait... Checking system information.
:: Section 1: Windows 10 information
ECHO ==========================
ECHO ============================
ECHO NETWORK INFO
ECHO ============================
ipconfig | findstr IPv4
ipconfig | findstr IPv6
C:\xampp\xampp_start.exe
START http://localhost:3100/restaurant-billing/food/control/pages/dashboard/
PAUSE
C:\xampp\xampp_stop.exe