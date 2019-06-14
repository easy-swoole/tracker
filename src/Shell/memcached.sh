memcached() {
  local ncCommand=$(type -P nc)

  echo "stats" \
    | $ncCommand -w 1 127.0.0.1 11211 \
    | grep 'bytes' \
    | awk 'BEGIN {print "{"} {print "\"" $2 "\": " $3 } END {print "}"}' \
    | tr '\r' ',' \
    | sed 'N;$s/,\n/\n/;P;D'
}


memcached