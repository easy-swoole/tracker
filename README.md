# Tracker

## 安装

```
composer require easyswoole/tracker
```

## 基础服务器信息
通过执行shell获取基础的服务器状态信息，例如获取硬盘分区信息：
```
$list = \EasySwoole\Tracker\Shell\Shell::diskPartitions();
foreach ($list as $item){
   var_dump($item->toArray());
}
```
支持的方法列表如下：

- arpCache() 
- bandWidth() 
- cpuIntensiveProcesses() 
- diskPartitions() 
- currentRam() 
- cpuInfo() 
- generalInfo() 
- ioStats() 
- ipAddresses() 
- loadAvg() 
- memoryInfo() 
- ramIntensiveProcesses() 
- swap() 
- userAccounts()

> 注意，以上方法可能需要root权限，另外对mac不兼容 

## 追踪器的使用
```
$point = new \EasySwoole\Tracker\Point('p1');
$point->setStartArg([
    'p1Arg' => 'p1Arg'
]);
$sub1 = $point->appendChild('p1->1');
$sub1->setStartArg([
    'p1->1'=>'p1->1Arg'
]);
$sub1->end($sub1::END_FAIL);

$sub2 = $point->appendChild('p1->2');
$sub2->end();

$point2 = $point->next('p2');
$point2->end();
$point->end();

echo \EasySwoole\Tracker\Point::toString($point);
```