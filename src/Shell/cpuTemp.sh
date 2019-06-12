cpu_temp() {
  local ID=*
  [ -f /etc/os-release  ] && source /etc/os-release
  case "$ID" in
    "raspbian")
      cpu=$(</sys/class/thermal/thermal_zone0/temp)
      echo "$((cpu/1000))"
    ;;
    *)
      if type -P sensors 2>/dev/null; then
        returnString=`sensors`
        #amd
        if [[ "${returnString/"k10"}" != "${returnString}" ]] ; then
          echo ${returnString##*k10} | cut -d ' ' -f 6 | cut -c 2- | cut -c 1-4
        #intel
        elif [[ "${returnString/"core"}" != "${returnString}" ]] ; then
          fromcore=${returnString##*"coretemp"}
          echo ${fromcore##*Physical}  | cut -d ' ' -f 3 | cut -c 2-5
        fi
      else
        echo "[]"
      fi
    ;;
  esac
}

cpu_temp