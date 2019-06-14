network_connections() {

  local netstatCmd=$(type -P netstat)
  local sortCmd=$(type -P sort)
  local uniqCmd=$(type -P uniq)

  $netstatCmd -ntu \
  | awk 'NR>2 {print $5}' \
  | $sortCmd \
  | $uniqCmd -c \
  | awk 'BEGIN {print "["} {print "{ \"connections\": " $1 ", \"address\": \"" $2 "\" }," } END {print "]"}' \
  | sed 'N;$s/},/}/;P;D'
}


network_connections