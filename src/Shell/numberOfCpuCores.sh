number_of_cpu_cores() {

  local numberOfCPUCores=$(grep -c 'model name' /proc/cpuinfo)

  if [ -z $numberOfCPUCores ]; then
    echo "cannnot be found";
  fi
}


number_of_cpu_cores