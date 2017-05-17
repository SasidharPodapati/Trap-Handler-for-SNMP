***Assignment3***

The main aim of this assignment is to send traps to the manager of mangers when two or more devices are in danger state and atleat one device in fail state.
Results are displayed on web dashboard where we can enter the credentials of manager of managers.

***Software requirements and Basic Installations***

Operating System: Ubuntu 14.04 LTS.
Apache server, MySql, PHP

***Modules installed from CPAN***
Data::Dumper
DBD::Mysql
DBI
File::Basename
file::spec::Functions
Net::SNMP

Install snmpd by "apt-get install snmpd".
  
***Configuration file to be changed***

Add the following lines to the snmpdtrapd.conf file in the /etc/snmp/snmptrapd.conf:

	authCommunity log,execute,net public 
	disableAuthorization yes
	#doNotLogTraps yes
	snmpTrapdAddr udp:50162
	traphandle 1.3.6.1.4.1.41717.10.* perl /var/www/html/et2536-sapo15/assignment3/trapDaemon.pl 
																		
Open file snmpd from /etc/default/snmpd and change the line:

	 TRAPDRUN=no to TRAPDRUN=yes

Then, use the terminal command "sudo service snmpd restart".

***Steps to run the Assignment 3***

*Open a web browser and type the following URL: http://localhost/et2536-sapo15/assignment3
*Enter the credentials of the manager to which traps are to be sent.

*Give the following trap command:

sudo snmptrap -v 1 -c public 127.0.0.1:50162 .1.3.6.1.4.1.41717.10 10.2.3.4 6 247 '' .1.3.6.1.4.1.41717.10.1 s "" .1.3.6.1.4.1.41717.10.2 i 1
where "" is the FQDN name, 1 is an integer describing the status of device.(0="OK", 1="PROBLEM", 2="DANGER", 3="FAIL")

*The frontend web page also dispalys the status of all the devices. 
*The user can see the traps using "wireshark" or "tcpdump" command.
		
   tcpdump command:
	 sudo tcpdump -n -i wlan0 "dst host 192.168.1.1 and dst port 161"
	 where IP address and port number are of the manager of managers.

	 Wireshark:
   Apply filter as: "ip.addr==192.168.1.1" and start capture on the required interface, can be eth0 or wlan0.
	 where "ip.addr" is the IP address of managers of managers.








