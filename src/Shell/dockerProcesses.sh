docker_processes() {

  local result=""
  local dockerCommand=$(type -P docker)
  local containers="$($dockerCommand ps | awk '{if(NR>1) print $NF}')"

  for i in $containers; do
  result="$result $($dockerCommand top $i axo pid,user,pcpu,pmem,comm --sort -pcpu,-pmem \
        | head -n 15 \
        | awk -v cnt="$i" 'BEGIN{OFS=":"} NR>1 {print "{ \"cname\": \"" cnt \
                "\", \"pid\": " $1 \
                ", \"user\": \"" $2 "\"" \
                ", \"cpuPercent\": " $3 \
                ", \"memPercent\": " $4 \
                ", \"cmd\": \"" $5 "\"" "},"\
              }')"
  done

  echo "[" ${result%?} "]"
}


docker_processes