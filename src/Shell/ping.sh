ping() {

	# get absolute path to config file
    local SCRIPTPATH=$(dirname $(readlink -f $0))
	local CONFIG_PATH=$SCRIPTPATH"/config/ping_hosts"

    local pingCmd=$(type -P ping)
    local numOfLinesInConfig=$(sed -n '$=' $CONFIG_PATH)
	local result='['

	cat $CONFIG_PATH \
	|  while read output
		do
		   	singlePing=$($pingCmd -qc 2 $output \
		    | awk -F/ 'BEGIN { endLine="}," } /^rtt/ { if ('$numOfLinesInConfig'==1){endLine="}"} print "{" "\"host\": \"'$output'\", \"ping\": " $5 " " endLine }' \
		    )
		    numOfLinesInConfig=$(($numOfLinesInConfig-1))
		    result=$result$singlePing
			if [ $numOfLinesInConfig -eq 0 ]
				then
					echo $result"]"
			fi
		done \
	| sed 's/\},]/}]/g'
}


ping