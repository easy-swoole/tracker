redis() {

  ########### Enter Your Redis Password  HERE #########
  local redisPassword=''
  ########### Enter Your Redis Password  HERE #########

  local redisCommand=$(type -P redis-cli);

  if [ -n "$redisPassword" ]; then
    redisCommand="$redisCommand -a $redisPassword"
  fi

  result=$($redisCommand INFO \
        | grep 'redis_version\|connected_clients\|connected_slaves\|used_memory_human\|total_connections_received\|total_commands_processed' \
        | awk -F: '{print "\"" $1 "\":" "\"" $2 }' \
        | tr '\r' '"' | tr '\n' ','
      )
  echo { ${result%?} }
}


redis