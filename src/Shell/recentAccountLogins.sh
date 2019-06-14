recent_account_logins() {

  local lastLogCommand=$(type -p lastlog)

  result=$($lastLogCommand -t 365 \
        | awk 'NR>1 {\
          print "{ \
            \"user\": \"" $1 "\", \
            \"ip\": \"" $3 "\","" \
            \"date\": \"" $5" "$6" "$7" "$8" "$9 "\"},"
          }'
      )
  echo [ ${result%?} ]
}


recent_account_logins