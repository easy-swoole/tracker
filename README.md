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
$tracker = new \EasySwoole\Tracker\Tracker();
$point = $tracker->addPoint('func1','call arg');
//do func1
$point->end();

echo $tracker;
```
> 可以利用Context管理器，实现任意位置获取当前请求的tracker ,然后任意添加追踪点。