@echo off

for /F "tokens=1,2,3 delims=_" %%i in ('PowerShell -Command "& {Get-Date -format "MM_dd_yyyy"}"') do (
    set MONTH=%%i
    set DAY=%%j
    set YEAR=%%k
)



set dt=%DATE:~6,4%%DATE:~3,2%%DATE:~0,2%_%TIME:~0,2%_%TIME:~3,2%_%TIME:~6,2%


set name=%dt: =0%

cd\
c:
c:\xampp\mysql\bin\mysqldump --user=dts --password=1899Pr0v1nc30fB3ngu3t --result-file="D:\dts_files\dts_database\%name%_dts.sql" db_dts
cd\

exit