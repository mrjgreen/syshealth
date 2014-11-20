##System Monitor for App Monitor

###Installation

Use the phar archive directly

    wget https://github.com/mrjgreen/syshealth/raw/master/build/appmonitor-agent.phar -O appmonitor-agent.phar
    chmod a+x appmonitor-agent.phar
    
Call directly

    ./appmonitor-agent.phar serverid hostendpoint --options
    
Optionally make the command available globally

    sudo mv appmonitor-agent.phar /usr/bin/appmonitor-agent
    #Call from anywhere using:
    appmonitor-agent serverid hostendpoint --options
