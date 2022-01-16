@ECHO OFF
ECHO Welcome, Billing software opening soon...
ECHO Please wait... Checking system information.
:: Section 1: Windows 10 information
ECHO ============================
ECHO NETWORK INFO
ECHO ============================
ipconfig | findstr IPv4
ipconfig | findstr IPv6
ECHO ==========================
C:\xampp\xampp_start.exe
for /f "tokens=1-2 delims=:" %%a in ('ipconfig^|find "IPv4"') do set ip=%%b
set ip=%ip:~1%
ECHO ==========Current IP================
ECHO %ip%
set "xamp_folder_name=restaurant-billing"
set "str0=http://"
set str1=%ip%
set "str2=:3100/%xamp_folder_name%/food/control/pages/dashboard/"
set "str3=&cs=This%%20Site&u=http%%3A%%2F%%2Fmyuti.eit.go2uti.com%%2Fowd%%2FITII"
set "newvar=%str0%%str1%%str2%
ECHO ============Dynamic link==============
ECHO "%newvar%"
START %newvar%
cmd /k "cd C:\xampp\htdocs\restaurant-billing\FrontEnd-App && npm start"
PAUSE
C:\xampp\xampp_stop.exe