logged_in_users() {
  local whoCommand=$(type -P w)

  result=$(COLUMNS=300 $whoCommand -h | awk '{print "{\"user\": \"" $1 "\", \"from\": \"" $3 "\", \"when\": \"" $4 "\"},"}')

  echo [ ${result%?} ]
}


logged_in_users