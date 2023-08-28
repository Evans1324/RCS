@echo off

for /F "tokens=1,2,3 delims=_" %%i in ('PowerShell -Command "& {Get-Date -format "MM_dd_yyyy"}"') do (
    set MONTH=%%i
    set DAY=%%j
    set YEAR=%%k
)

set name=%YEAR%%MONTH%%DAY%
cd\
c:
c:\xampp\mysql\bin\mysqldump --user=dts --password=1899Pr0v1nc30fB3ngu3t --result-file="D:\rcs_files\rcs_database\%name%_rcs.sql" rcs-app
cd\

exit